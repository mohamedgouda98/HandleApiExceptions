<?php

namespace App\Console;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Kernel extends ConsoleKernel
{
    use ApiResponseTrait;

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
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


    public function render($request, Throwable $e)
    {

        if ($e instanceof NotFoundHttpException)
        {
            return $this->apiResponse(404,"error 404", $request->url() . ' Not Found, try with correct url');
        }
        if($e instanceof MethodNotAllowedHttpException)
        {
            return $this->apiResponse(404,"error 405",  $request->method() . ' method Not allow for this route, try with correct method');
        }
    }
}
