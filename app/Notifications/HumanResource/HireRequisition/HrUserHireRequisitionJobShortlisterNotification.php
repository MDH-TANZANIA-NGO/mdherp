<?php

namespace App\Notifications\HumanResource\HireRequisition;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HrUserHireRequisitionJobShortlisterNotification extends Notification
{
    use Queueable;

    protected $jobs;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->resource->subject)
            ->markdown('mail.workflow.workflow', ['jobs' => $this->jobs, 'name' => $notifiable->fullname]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
