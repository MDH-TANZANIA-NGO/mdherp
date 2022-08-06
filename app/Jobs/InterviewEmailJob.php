<?php

namespace App\Jobs;

use App\Notifications\HumanResource\InterviewCallNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InterviewEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $interview;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $interview)
    {
        $this->user = $user;
        $this->interview = $interview;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new InterviewCallNotification($this->interview));
//        $email = new TestMail();
//        Mail::to($this->details['email'])->send($email);
    }
}
