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
    protected $interviewCall;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($interviewCall)
    {
        $this->interview_call =  $interviewCall;
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
            ->markdown('mail.HumanResource.interviewcall',[
                'link' => $this->interview_call,
                'fullname' => $this->interview_call->user,
                'message' => 'You have been called as a panelist for an interview scheduled on'
                ]);
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
