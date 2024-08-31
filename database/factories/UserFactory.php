<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Faker\Providers\KhmerNameProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Faker\Providers\KhmerNameProvider;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
               // Array of predefined image URLs
        $avatars = [
            'https://media.nngroup.com/media/people/photos/20211213_Vegas-garrett.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Evan_Headshot.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/IMG_6074.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Hayat_Sheikh.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2023-04-portraits--huei-hsin.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2022-portrait-page-3.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2023-04-portrait-megan-c.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/2023-04-portraits-raluca.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Tim-portrait-2022.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
            'https://media.nngroup.com/media/people/photos/Kate-Headshot-2022.jpg.600x600_q75_autocrop_crop-smart_upscale.jpg',
        ];

            $this->faker->addProvider(new KhmerNameProvider($this->faker));
            // Fetch the avatar from the URL
            $avatarContents = Http::get($avatars[array_rand($avatars)])->body();


            // Generate a unique file name for the avatar
            $avatarName = 'avatar_' . Str::random($length = 10) . '.jpg';

            // Define the storage path
            $path = 'public/avatars/' . $avatarName;

            // Store the avatar locally
            Storage::put($path, $avatarContents);

        return [
            'name' => $this->faker->khmerName(),
            'username' => $this->faker->unique()->username,
            'email' => $this->faker->unique()->userName . '@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('11112222'),
            'remember_token' => Str::random(10),
            'avatar' => 'storage/avatars/' . $avatarName,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}