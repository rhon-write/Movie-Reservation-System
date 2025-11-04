<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Movie;
use App\Models\ShowTime;
use App\Models\Seat;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@cinebook.com',
            'password' => Hash::make('admin123'),
        ]);

        // Create Users
        User::create([
            'name' => 'Sarah Johnson',
            'email' => 'customer@cinebook.com',
            'phone' => '555-0101',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'John Smith',
            'email' => 'john@cinebook.com',
            'phone' => '555-0102',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Emily Davis',
            'email' => 'emily@cinebook.com',
            'phone' => '555-0103',
            'password' => Hash::make('password123'),
        ]);

        // Create Movies
        $movies = [
            [
                'title' => 'The Dark Universe',
                'description' => 'An epic space adventure that takes you through distant galaxies. Join the crew as they face unknown dangers and discover the secrets of the universe.',
                'genre' => 'Sci-Fi, Action',
                'duration' => '148 min',
                'rating' => 9.2,
                'image_url' => 'https://images.unsplash.com/photo-1440404653325-ab127d49abc1?w=800',
                'status' => 'active',
            ],
            [
                'title' => 'Love in Paris',
                'description' => 'A heartwarming romance set in the beautiful streets of Paris. Follow two strangers as they discover love in the most unexpected places.',
                'genre' => 'Romance, Drama',
                'duration' => '126 min',
                'rating' => 8.7,
                'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800',
                'status' => 'active',
            ],
            [
                'title' => 'Quantum Shadows',
                'description' => 'A mind-bending thriller that explores the nature of reality. When a scientist discovers a way to manipulate time, nothing is what it seems.',
                'genre' => 'Thriller, Mystery',
                'duration' => '134 min',
                'rating' => 8.9,
                'image_url' => 'https://images.unsplash.com/photo-1509281373149-e957c6296406?w=800',
                'status' => 'active',
            ],
            [
                'title' => 'Dragon Warriors',
                'description' => 'An epic fantasy adventure featuring brave warriors and mythical dragons. Experience breathtaking battles and stunning visual effects.',
                'genre' => 'Fantasy, Adventure',
                'duration' => '156 min',
                'rating' => 8.5,
                'image_url' => 'https://images.unsplash.com/photo-1518676590629-3dcbd9c5a5c9?w=800',
                'status' => 'active',
            ],
        ];

        foreach ($movies as $movieData) {
            $movie = Movie::create($movieData);

            // Create showtimes for each movie
            $dates = [
                now()->addDays(1)->format('Y-m-d'),
                now()->addDays(2)->format('Y-m-d'),
                now()->addDays(3)->format('Y-m-d'),
            ];

            $times = ['13:00:00', '16:30:00', '19:00:00', '21:30:00'];
            $prices = [12.00, 14.00, 15.00, 18.00];

            foreach ($dates as $dateIndex => $date) {
                foreach ($times as $timeIndex => $time) {
                    $showTime = ShowTime::create([
                        'movie_id' => $movie->id,
                        'show_date' => $date,
                        'show_time' => $time,
                        'price' => $prices[$timeIndex],
                        'total_seats' => 80,
                        'available_seats' => 80,
                    ]);

                    // Create seats for this showtime
                    $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                    foreach ($rows as $row) {
                        for ($seatNum = 1; $seatNum <= 10; $seatNum++) {
                            Seat::create([
                                'show_time_id' => $showTime->id,
                                'seat_row' => $row,
                                'seat_number' => $seatNum,
                                'seat_type' => (in_array($row, ['F', 'G', 'H']) && $seatNum >= 4 && $seatNum <= 7) ? 'vip' : 'regular',
                                'is_available' => true,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
