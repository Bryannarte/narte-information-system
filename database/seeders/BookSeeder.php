<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography', 'Technology', 'Philosophy', 'Literature', 'Mystery', 'Romance'];
        $publishers = ['Penguin Random House', 'HarperCollins', 'Simon & Schuster', 'Macmillan', 'Hachette Book Group', 'Scholastic', 'Oxford University Press', 'Cambridge University Press'];
        $statuses = ['available', 'borrowed', 'reserved'];
        
        // Book cover image URLs from Unsplash (book-related images)
        $bookImages = [
            'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=400&h=600&fit=crop',
            'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
        ];

        for ($i = 0; $i < 15; $i++) {
            Book::create([
                'title' => $faker->sentence(3, true),
                'author' => $faker->name(),
                'isbn' => $faker->unique()->isbn13(),
                'publication_year' => $faker->numberBetween(1900, date('Y')),
                'category' => $faker->randomElement($categories),
                'publisher' => $faker->randomElement($publishers),
                'status' => $faker->randomElement($statuses),
                'image_path' => $bookImages[$i % count($bookImages)],
            ]);
        }
    }
}
