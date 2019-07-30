<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;

class CreateCalendarEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendar:make {month} {day} {hour} {minutes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create google calendar event';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $event = new Event();
        $event->name = 'Curso de Laravel Avanzado: Preguntas y Respuestas';
        $event->description = "Recibiste esta invitación por estar regitrado en el curso de Laravel Avanzado http://phpacademy.co";
        $event->startDateTime = Carbon::create(2019, $this->argument('month'), $this->argument('day'), $this->argument('hour'), $this->argument('minutes'), 00);
        $event->endDateTime = Carbon::create(2019, $this->argument('month'), $this->argument('day'), $this->argument('hour') + 2, $this->argument('minutes'), 00);

        $users = \App\User::all('email');

        $users->each(function ($user) use ($event) {
            $event->addAttendee([
                'email' => $user->email,
            ]);
        });
        $event->save(null ,['sendUpdates' => 'all']);
    }
}
