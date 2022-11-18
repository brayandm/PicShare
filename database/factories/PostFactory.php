<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'header' => fake()->text(50),
            'text' => fake()->text(200),
            'picture' => $this->fakePicture(),
            'likes' => 0,
        ];
    }

    public function fakePicture()
    {
        $picture = file_get_contents('https://source.unsplash.com/random/300x300');

        $file = fopen('storage/app/private/temp/picture.jpg', 'w');

        fwrite($file, $picture);

        $file = new UploadedFile('storage/app/private/temp/picture.jpg', 'picture.jpg');

        $filename = Storage::putFile('private/pictures/', $file);

        unlink('storage/app/private/temp/picture.jpg');

        $dir = explode('/', $filename);

        return end($dir);
    }
}
