<?php

namespace App\Console;

use App\Services\ModulesService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
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
        $modules    =   app()->make( ModulesService::class );

        collect( $modules->getEnabled() )->each( function( $module ) {
            $filePath   =   $module[ 'path' ] . DIRECTORY_SEPARATOR . 'Console' . DIRECTORY_SEPARATOR . 'Kernel.php';
            if ( is_file( $filePath ) ) {
                
                include_once( $filePath );
                
                $kernelClass    =   $entryClass . '\Console\Kernel';

                /**
                 * a kernel class should be defined
                 * on the module before it's initialized.
                 */
                if ( class_exists( $kernelClass ) ) {
                    $object     =   new $kernelClass;
                    $object->schedule( $schedule ); 
                }
            }
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        $modules    =   app()->make( ModulesService::class );

        collect( $modules->getEnabled() )->each( function( $module ) {
            if ( is_dir( $module[ 'path' ] . DIRECTORY_SEPARATOR . 'Commands' ) ) {
                $this->load( $module[ 'path' ] . DIRECTORY_SEPARATOR . 'Commands' );
            }
        });

        require base_path('routes/console.php');
    }
}
