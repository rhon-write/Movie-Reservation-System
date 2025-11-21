<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\User;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
    [
        'title' => 'Spider-Man: No Way Home',
        'description' => 'Peter Parker faces new challenges as his identity is revealed to the world.',
        'poster' => 'https://posterspy.com/wp-content/uploads/2024/11/Screenshot-2024-11-15-at-01.12.59.jpg',
        'showtimes' => ['9:00 AM', '12:00 PM', '3:00 PM', '6:00 PM', '9:00 PM'],
        'price' => 350.00,
        'is_active' => true,
    ],
    [
        'title' => 'The Dark Knight',
        'description' => 'A thrilling superhero movie featuring Batman as he faces the Joker.',
        'poster' => 'https://upload.wikimedia.org/wikipedia/en/1/1c/The_Dark_Knight_%282008_film%29.jpg',
        'showtimes' => ['10:00 AM', '1:00 PM', '4:00 PM', '7:00 PM', '10:00 PM'],
        'price' => 300.00,
        'is_active' => true,
    ],
    [
        'title' => 'Inside Out',
        'description' => 'A heartwarming animated movie exploring the emotions inside a young girl’s mind.',
        'poster' => 'https://lumiere-a.akamaihd.net/v1/images/p_insideout_19751_af12286c.jpeg',
        'showtimes' => ['10:30 AM', '1:30 PM', '4:30 PM', '7:30 PM', '10:30 PM'],
        'price' => 250.00,
        'is_active' => true,
    ],
    [
        'title' => 'The Conjuring',
        'description' => 'A horror story based on true events, involving paranormal investigators.',
        'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTo1w35AsAv2sISXApGQxf8hD_gO4d_A_ZC3Q&s',
        'showtimes' => ['11:00 AM', '2:00 PM', '5:00 PM', '8:00 PM', '11:00 PM'],
        'price' => 300.00,
        'is_active' => true,
    ],
    [
        'title' => 'Insidious',
        'description' => 'A family tries to prevent evil spirits from trapping their comatose child in a realm called The Further.',
        'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSa0z8OlHXs5jwZT9ugparfiZub07AC69xlvA&s',
        'showtimes' => ['9:30 AM', '12:30 PM', '3:30 PM', '6:30 PM', '9:30 PM'],
        'price' => 350.00,
        'is_active' => true,
    ],
    [
        'title' => 'My Hero Academia: Two Heroes',
        'description' => 'The movie follows the students of UA High as they fight against a mysterious enemy.',
        'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbMQ0uA9q3Ny1wL-xtwFMeNz8l0k3uWdnOvw&s',
        'showtimes' => ['10:00 AM', '1:00 PM', '4:00 PM', '7:00 PM'],
        'price' => 450.00,
        'is_active' => true,
    ],
    [
        'title' => 'Welcome to Waikiki',
        'description' => 'Comedy series about three friends running a guesthouse in Waikiki.',
        'poster' => 'https://upload.wikimedia.org/wikipedia/en/c/c1/Welcome_to_Waikiki_2.jpg',
        'showtimes' => ['11:00 AM', '2:00 PM', '5:00 PM'],
        'price' => 300.00,
        'is_active' => true,
    ],
    [
        'title' => 'The Heirs',
        'description' => 'A Korean drama about wealthy high school students navigating friendship, love, and family legacies.',
        'poster' => 'https://m.media-amazon.com/images/M/MV5BZTgwZjZmMGQtMmE0My00YmM1LWJhMTctYTFhY2Q1ZDNjNWUwXkEyXkFqcGc@._V1_.jpg',
        'showtimes' => ['7:00 PM', '9:00 PM'],
        'price' => 300.00,
        'is_active' => true,
    ],
    [
        'title' => 'Attack on Titan: Chronicle',
        'description' => 'Compilation movie summarizing the epic anime series Attack on Titan.',
        'poster' => 'https://m.media-amazon.com/images/M/MV5BMTcwMzNhYmEtOTVjNi00NDY1LTk2M2UtMzdiNDM5YzFiMDlhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
        'showtimes' => ['9:00 AM', '12:00 PM', '3:00 PM', '6:00 PM'],
        'price' => 400.00,
        'is_active' => true,
    ],
    [
        'title' => 'So Young 2',
        'description' => 'Romantic drama sequel exploring youth and first loves.',
        'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXd2R6N4HPMc65FKtYvWFWm5UApeBp9M-0UQ&s',
        'showtimes' => ['10:00 AM', '1:00 PM', '4:00 PM'],
        'price' => 400.00,
        'is_active' => true,
    ],
    [
        'title' => 'Train to Busan',
        'description' => 'A zombie outbreak threatens passengers on a train to Busan.',
        'poster' => 'https://m.media-amazon.com/images/M/MV5BMTkwOTQ4OTg0OV5BMl5BanBnXkFtZTgwMzQyOTM0OTE@._V1_FMjpg_UX1000_.jpg',
        'showtimes' => ['11:00 AM', '2:00 PM', '5:00 PM', '8:00 PM'],
        'price' => 300.00,
        'is_active' => true,
    ],
    [
        'title' => 'Demon Slayer: Mugen Train',
        'description' => 'Demon Slayer team boards a train to hunt a powerful demon.',
        'poster' => 'https://m.media-amazon.com/images/I/81YqQ0fB+0L._AC_SY679_.jpg',
        'showtimes' => ['10:30 AM', '1:30 PM', '4:30 PM', '7:30 PM'],
        'price' => 14.00,
        'is_active' => true,
    ],
    [
        'title' => 'Awakening',
        'description' => 'A supernatural thriller about uncovering dark secrets.',
        'poster' => 'https://m.media-amazon.com/images/I/51Bkoq9wWCL._AC_SY679_.jpg',
        'showtimes' => ['12:00 PM', '3:00 PM', '6:00 PM'],
        'price' => 11.00,
        'is_active' => true,
    ],
    [
        'title' => '2012',
        'description' => 'Disaster movie depicting the end of the world and survival.',
        'poster' => 'https://m.media-amazon.com/images/I/71v-G7qgBWL._AC_SY679_.jpg',
        'showtimes' => ['9:00 AM', '12:00 PM', '3:00 PM', '6:00 PM'],
        'price' => 10.00,
        'is_active' => true,
    ],
    [
        'title' => 'The Wave',
        'description' => 'A disaster movie about a tsunami hitting a Norwegian town.',
        'poster' => 'https://m.media-amazon.com/images/I/81ghIN2uAoL._AC_SY679_.jpg',
        'showtimes' => ['10:00 AM', '1:00 PM', '4:00 PM'],
        'price' => 11.00,
        'is_active' => true,
    ],
    [
        'title' => 'Temptation Island',
        'description' => 'Comedy about couples testing their relationships on an island.',
        'poster' => 'https://upload.wikimedia.org/wikipedia/en/9/97/Temptation_Island_film_poster.jpg',
        'showtimes' => ['11:00 AM', '2:00 PM', '5:00 PM'],
        'price' => 9.00,
        'is_active' => true,
    ],
    [
        'title' => 'The Lord of the Rings: The Fellowship of the Ring',
        'description' => 'A fantasy epic where a hobbit starts a quest to destroy a powerful ring.',
        'poster' => 'https://m.media-amazon.com/images/I/51Qvs9i5a%2BL._AC_SY679_.jpg',
        'showtimes' => ['9:00 AM', '12:00 PM', '3:00 PM', '6:00 PM', '9:00 PM'],
        'price' => 15.00,
        'is_active' => true,
    ],
    [
        'title' => 'The Hobbit: The Battle of the Five Armies',
        'description' => 'The epic conclusion to the Hobbit trilogy as armies clash for control.',
        'poster' => 'https://m.media-amazon.com/images/I/71zy-YA0RAL._AC_SY679_.jpg',
        'showtimes' => ['10:00 AM', '1:00 PM', '4:00 PM', '7:00 PM'],
        'price' => 14.00,
        'is_active' => true,
    ],
    [
        'title' => 'Kimi no Na wa (Your Name)',
        'description' => 'Two strangers mysteriously swap bodies and try to meet each other.',
        'poster' => 'https://m.media-amazon.com/images/I/81vlA84pg6L._AC_SY679_.jpg',
        'showtimes' => ['11:00 AM', '2:00 PM', '5:00 PM'],
        'price' => 12.00,
        'is_active' => true,
    ],
    [
        'title' => 'Weathering With You',
        'description' => 'A boy meets a girl who can control the weather in Tokyo.',
        'poster' => 'https://m.media-amazon.com/images/I/81lsqlydEDL._AC_SY679_.jpg',
        'showtimes' => ['9:30 AM', '12:30 PM', '3:30 PM', '6:30 PM'],
        'price' => 13.00,
        'is_active' => true,
    ],
];



        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }
    }
}
