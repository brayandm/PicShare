<?php

namespace App\Console;

use App\Models\User;
use App\Services\PostService;
use App\Services\WeatherService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('backup:clean')->daily()->at('04:00');
        $schedule->command('backup:run')->daily()->at('04:30');
        $schedule->call(function () {

            $weatherUser = User::where('email', 'weather@example.com')->first();

            Auth::login($weatherUser);

            $service = new PostService();

            $weather = new WeatherService();

            $country = fake()->country();

            $temperature = $weather->temperature($country);
            $condition = $weather->condition($country);

            $post = $service->create([
                'header' => 'Weather News in ' . $country,
                'text' => $condition['text'] . ' with ' . $temperature . '°C',
                'tags' => 'weather']);

            $picture = file_get_contents($condition['icon']);
            $info = pathinfo($condition['icon']);
            $file = '/tmp/' . $info['basename'];
            file_put_contents($file, $picture);
            $uploaded_file = new UploadedFile($file, $info['basename'], 200);

            $service->savePicture($post->id, $uploaded_file);

        })->everyFourHours();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
