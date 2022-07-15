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
        $resource = (object)[
            'link' =>  route('hr.job.show',$this->jobs->uuid),
            'subject' => 'You have been selected as a shortlister',
            'message' => 'You have been selected as one of the shortlister in the following position advertised',
            'job' => $this->jobs->designation->full_title
        ];
        return (new MailMessage)
            ->subject($resource->subject)
            ->markdown('mail.HumanResource.HireRequisition.shortlister', ['resource' => $resource, 'name' => $notifiable->last_name. ' '.$notifiable->first_name]);
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
