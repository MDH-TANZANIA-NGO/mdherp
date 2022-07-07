<?php

namespace App\Jobs\HumanResource\HireRequisition;

use App\Models\Auth\User;
use App\Notifications\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HrUserHireRequisitionJobShortlisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $job;
    /**
     * Create a new job instance.
     * @param User $user
     * @param mixed $job
     * @return void
     */
    public function __construct(User $user, $job)
    {
        $this->user = $user;
        $this->job = $job;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new HrUserHireRequisitionJobShortlisterNotification($this->job));
    }
}
