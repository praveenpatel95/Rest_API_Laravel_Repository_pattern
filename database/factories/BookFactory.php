<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $image = UploadedFile::fake()->image('photo1.jpg');
        $isbn = fake()->isbn10();
        $filename = $isbn .'.'. $image->getClientOriginalExtension();
        $path = $image->storeAs('books', $filename);

        $auhtors = [
            'Zelda Okuneva',
            'Ut Molestiae',
            'Vero Corporis',
            'Doloribus Optio',
            'Sapiente Autem'
        ];

        $genre = [
            'CMS',
            'Ecommerce',
            'Software Development',
            'Website Design',
            'SEO',
            'Wordpress',
        ];

        $publishers = [
            'Wrox',
            'Packt',
            'Shim Publisher',
        ];

        return [
            'title' => fake()->realText(30),
            'author' => fake()->randomElement($auhtors),
            'genre' => fake()->randomElement($genre),
            'description' => fake()->paragraph,
            'isbn' => $isbn,
            'image' => $path,
            'published' => fake()->dateTimeThisCentury,
            'publisher' => fake()->randomElement($publishers)
        ];
    }
}
