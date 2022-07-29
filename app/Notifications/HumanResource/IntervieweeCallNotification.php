<?php

namespace App\Notifications\HumanResource;

use App\Repositories\ProgramActivity\ProgramActivityRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IntervieweeCallNotification extends Notification
{
    use Queueable;

    protected $interview_call;
    protected $interviewCall;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($interviewCall, $user)
    {
        $this->interview_call =  $interviewCall;
        $this->user =  $user;

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
        //dd($notifiable);
        //dd($notifiable->interview_date);
        $schedules = $this->interview_call->InterviewSchedules;
        $interview_date  = '';
        $interview_type  = '';
        $interview_position  = '';

        $interview_position .= "<b>Interview Position:</b> ".$schedules[0]->interview->jobRequisition->designation->full_title."<br/>"." Interview Date: ".$schedules[0]->interview_date."<br/>"."Interview Type: ".$schedules[0]->interview->interviewType->name.", <br/><br/>";


        $string = htmlentities("Congratulations! You have been shortlisted to sit for interview ". "<br>". $interview_position);
//        dd($this->interview_call);
        return (new MailMessage)
            ->subject('Invited for Interview')
            ->markdown('mail.HumanResource.interviewcall',[
//                'link' => route('interviewconfirm.index', $this->interview_call->hr_requisition_job_id),
                'link' => route('interviewconfirm.index', [$notifiable->id,$schedules[0]->interview_id]),
                'fullname' => $notifiable->full_name,
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
