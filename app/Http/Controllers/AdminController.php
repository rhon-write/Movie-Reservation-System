<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\BookingApproved;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->isAdmin()) {
                $request->session()->regenerate();
                return redirect('/admin/dashboard');
            }
            
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have admin access.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid admin credentials.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $pendingBookings = Booking::where('status', 'pending')
            ->with(['user', 'movie'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $approvedBookings = Booking::where('status', 'approved')
            ->with(['user', 'movie'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $stats = [
            'pending' => Booking::where('status', 'pending')->count(),
            'approved' => Booking::where('status', 'approved')->count(),
            'total' => Booking::count(),
        ];

        return view('admin.dashboard', compact('pendingBookings', 'approvedBookings', 'stats'));
    }

    public function approveBooking($id)
    {
        DB::beginTransaction();
        try {
            $booking = Booking::findOrFail($id);
            $booking->status = 'approved';
            $booking->save();

            // Send approval email
            try {
                Mail::to($booking->user->email)->send(new BookingApproved($booking));
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
            }

            DB::commit();

            return redirect()->back()->with('success', 'Booking approved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to approve booking.');
        }
    }

    public function rejectBooking($id)
    {
        DB::beginTransaction();
        try {
            $booking = Booking::findOrFail($id);
            
            // Free up the seats
            Seat::where('booking_id', $booking->id)
                ->update([
                    'is_booked' => false,
                    'booked_by' => null,
                    'booking_id' => null,
                ]);

            $booking->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Booking rejected and deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to reject booking.');
        }
    }
}

