<?php

namespace App\Notifications\HumanResource;

use App\Repositories\ProgramActivity\ProgramActivityRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InterviewCallNotification extends Notification
{
    use Queueable;

    protected $interview_call;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($programActivity)
    {
        $this->program_activity =  $programActivity;
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
            ->subject('Invited for Interview')
            ->markdown('mail.HumanResource.interviewcall',['link' => $this->program_activity, 'name' => $notifiable->first_name. ' '.$notifiable->last_name, 'email' => $notifiable->email]);
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
