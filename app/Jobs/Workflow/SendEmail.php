<?php

namespace App\Jobs\Workflow;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\Workflow\WorkflowNotification;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $email_resource;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $email_resource)
    {
        //
        $this->users =  $users;
        $this->email_resource =  $email_resource;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->users->notify(new WorkflowNotification($this->email_resource));
    }
}
