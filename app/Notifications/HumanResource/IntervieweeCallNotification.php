<?php

namespace App\Notifications\HumanResource;

use App\Repositories\ProgramActivity\ProgramActivityRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IntervieweeCallNotification extends Notification
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
        //dd($notifiable->interview_date);
        $schedules = $this->interview_call->InterviewSchedules;
        $interview_date  = '';
        $interview_type  = '';
        $interview_position  = '';

        $interview_position .= "<b>Interview Position:</b> ".$schedules[0]->interview->jobRequisition->designation->full_title."<br/>"." Interview Date: ".$notifiable->interview_date."<br/>"."Interview Type: ".$schedules[0]->interview->interviewType->name.", <br/><br/>";


        $string = htmlentities("Congratulations! You have been shortlisted to sit for interview ". "<br>". $interview_position);
//        dd($this->interview_call->InterviewType);
        return (new MailMessage)
            ->subject('Invited for Interview')
            ->markdown('mail.HumanResource.interviewcall',[
                'link' => $this->interview_call,
                'fullname' => $notifiable->fullname,
                'message' => html_entity_decode($string)
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
