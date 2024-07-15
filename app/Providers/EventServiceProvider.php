<?php

namespace App\Providers;

use App\Models\JadwalOK;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        JadwalOK::saving(function ($data) {
            // List of columns to convert to uppercase
            $columnsToUppercase = [ 'tgl_operasi', 'jam_operasi', 'nama_pasien', 'usia', 'no_cm', 'diagnosa','tindakan', 'operator', 'ruang_operasi', 'jaminan', 'profilaksis', 'status'];

            foreach ($columnsToUppercase as $column) {
                if (isset($data->{$column})) {
                    $data->{$column} = strtoupper($data->{$column});
                }
            }
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
