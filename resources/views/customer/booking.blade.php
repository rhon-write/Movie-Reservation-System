@extends('layouts.app')

@section('title', 'Book {{ $movie->title }} - MovieServe')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-purple-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('customer.dashboard') }}" class="text-white hover:bg-white/10 px-3 py-2 rounded">
                    ← Back
                </a>
                <h1 class="text-2xl font-bold">{{ $movie->title }}</h1>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <!-- Movie Info -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full rounded-lg">
                    </div>
                    <div class="md:col-span-2">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $movie->title }}</h2>
                        <p class="text-gray-600 mb-4">{{ $movie->description }}</p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-600">Price per seat:</span>
                                <span class="text-gray-900 font-semibold">₱{{ $movie->price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Booking Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Book Your Tickets</h3>

                <form method="POST" action="{{ route('booking.store') }}" id="bookingForm">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                    
                    <!-- Showtime Selection -->
                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Select Showtime</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
                            @foreach($movie->showtimes as $showtime)
                                <label class="cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="showtime" 
                                        value="{{ $showtime }}"
                                        class="hidden showtime-radio"
                                        required
                                    >
                                    <div class="showtime-option border-2 border-gray-300 rounded-lg p-4 text-center hover:border-purple-500 transition-all">
                                        <div class="text-lg font-semibold text-gray-900">{{ $showtime }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-sm text-red-600 mt-2 hidden" id="showtimeError">Please select a showtime</p>
                    </div>

                    <!-- Screen -->
                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Select Your Seats</h4>
                        <div class="mb-6">
                            <div class="bg-gray-800 text-white py-3 text-center rounded-t-3xl mx-auto max-w-2xl">
                                SCREEN
                            </div>
                        </div>

                        <!-- Seat Grid -->
                        <div class="mb-8">
                            <div class="flex justify-center">
                                <div class="inline-block" id="seatGrid">
                                    <p class="text-center text-gray-500 py-8">Please select a showtime first</p>
                                </div>
                            </div>
                        </div>

                        <!-- Legend -->
                        <div class="flex justify-center gap-8 mb-8">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-green-100 border-2 border-green-300 rounded-lg"></div>
                                <span class="text-gray-600">Available</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-purple-600 rounded-lg"></div>
                                <span class="text-gray-600">Selected</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-300 rounded-lg"></div>
                                <span class="text-gray-600">Booked</span>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Booking Summary</h4>
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Movie:</span>
                                <span class="text-gray-900 font-semibold">{{ $movie->title }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Selected Showtime:</span>
                                <span class="text-gray-900 font-semibold" id="selectedShowtime">Not selected</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Selected Seats:</span>
                                <span class="text-gray-900 font-semibold" id="selectedSeats">None</span>
                            </div>
                            <div class="flex justify-between items-center border-t pt-3">
                                <span class="text-gray-600">Total Price:</span>
                                <span class="text-2xl text-gray-900 font-bold" id="totalPrice">₱0</span>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    const pricePerSeat = {{ $movie->price }};
    const movieId = {{ $movie->id }};
    let selectedShowtime = null;
    let selectedSeatsArray = [];

    // Showtime selection
    document.querySelectorAll('.showtime-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            selectedShowtime = this.value;
            
            // Update UI
            document.querySelectorAll('.showtime-option').forEach(opt => {
                opt.classList.remove('border-purple-600', 'bg-purple-50');
                opt.classList.add('border-gray-300');
            });
            this.nextElementSibling.classList.remove('border-gray-300');
            this.nextElementSibling.classList.add('border-purple-600', 'bg-purple-50');
            
            document.getElementById('selectedShowtime').textContent = selectedShowtime;
            document.getElementById('showtimeError').classList.add('hidden');
            
            // Load seats for this showtime
            loadSeats(selectedShowtime);
            
            // Reset selected seats
            selectedSeatsArray = [];
            updateSummary();
        });
    });

    function loadSeats(showtime) {
        const seatGrid = document.getElementById('seatGrid');
        seatGrid.innerHTML = '<p class="text-center text-gray-500 py-4">Loading seats...</p>';
        
        // Fetch seats from API
        fetch(`/api/movies/${movieId}/seats/${encodeURIComponent(showtime)}`)
            .then(response => response.json())
            .then(seats => {
                renderSeatGrid(seats);
            })
            .catch(error => {
                console.error('Error loading seats:', error);
                seatGrid.innerHTML = '<p class="text-center text-red-500 py-4">Error loading seats. Please try again.</p>';
            });
    }

    function renderSeatGrid(bookedSeats) {
        const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        const cols = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        
        let gridHTML = '';
        
        rows.forEach(row => {
            gridHTML += '<div class="flex items-center gap-2 mb-2">';
            gridHTML += `<span class="w-8 text-center text-gray-600 font-semibold">${row}</span>`;
            
            cols.forEach(col => {
                const seatNumber = row + col;
                const seat = bookedSeats.find(s => s.seat_number === seatNumber);
                const isBooked = seat && seat.is_booked;
                
                if (isBooked) {
                    gridHTML += `
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-xs font-semibold bg-gray-300 cursor-not-allowed">
                            ${seatNumber}
                        </div>
                    `;
                } else {
                    gridHTML += `
                        <label class="cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="seats[]" 
                                value="${seatNumber}"
                                class="hidden seat-checkbox"
                            >
                            <div class="seat-box w-10 h-10 rounded-lg flex items-center justify-center text-xs font-semibold transition-all bg-green-100 border-2 border-green-300 hover:bg-green-200">
                                ${seatNumber}
                            </div>
                        </label>
                    `;
                }
            });
            
            gridHTML += '</div>';
        });
        
        document.getElementById('seatGrid').innerHTML = gridHTML;
        
        // Add event listeners to seat checkboxes
        document.querySelectorAll('.seat-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    this.nextElementSibling.classList.remove('bg-green-100', 'border-green-300');
                    this.nextElementSibling.classList.add('bg-purple-600', 'text-white');
                    selectedSeatsArray.push(this.value);
                } else {
                    this.nextElementSibling.classList.remove('bg-purple-600', 'text-white');
                    this.nextElementSibling.classList.add('bg-green-100', 'border-green-300');
                    selectedSeatsArray = selectedSeatsArray.filter(s => s !== this.value);
                }
                updateSummary();
            });
        });
    }

    function updateSummary() {
        document.getElementById('selectedSeats').textContent = 
            selectedSeatsArray.length > 0 ? selectedSeatsArray.join(', ') : 'None';
        document.getElementById('totalPrice').textContent = 
            '₱' + (selectedSeatsArray.length * pricePerSeat).toFixed(2);
    }

    // Form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        if (!selectedShowtime) {
            e.preventDefault();
            document.getElementById('showtimeError').classList.remove('hidden');
            alert('Please select a showtime');
            return false;
        }
        
        if (selectedSeatsArray.length === 0) {
            e.preventDefault();
            alert('Please select at least one seat');
            return false;
        }
        
        return true;
    });
</script>
@endsection
