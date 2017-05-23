<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;
use App\User;

/**
 * Class: StudentApplication
 *
 * Purpose: Class extends the Mailable interface and builds email template from views located in the views/emails folder
 *          Whenever the status of an application is changed by the administrator.
 *
 *
 *
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * @package App\Mail\
 */

class StudentApplication extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * Build the message depending on the status of an application.
     *
     * @return $this
     */
    public function build()
    {
        if($this->user->role_id==config('constants.role.APPLICATION')) {
            //application submitted email
            if($this->user->user_status_id==config('constants.user_status.NEW')) {
                return $this->view('emails.application.change')
                    ->with('title', config('constants.email.TITLE'))
                    ->with('recepient_name', $this->user->first_name)
                    ->with('content', config('constants.email.SUBMITTED_CONTENT'))
                    ->with('signature_line', config('constants.email.SIGNATURE_LINE'))
                    ->with('sender_name', config('constants.email.SENDER_NAME'));
            }
            //application call for interview email
            //@todo have admin the option to select a date and time for an interview
            //@todo send a second email with the details for an interview
            elseif($this->user->user_status_id==config('constants.user_status.INTERVIEW')) {
                return $this->view('emails.application.change')
                    ->with('title', config('constants.email.TITLE'))
                    ->with('recepient_name', $this->user->first_name)
                    ->with('content', config('constants.email.INTERVIEW_CONTENT'))
                    ->with('signature_line', config('constants.email.SIGNATURE_LINE'))
                    ->with('sender_name', config('constants.email.SENDER_NAME'));
            }
            //application deferred email
            if($this->user->user_status_id==config('constants.user_status.SHELVED')) {
                return $this->view('emails.application.change')
                    ->with('title', config('constants.email.TITLE'))
                    ->with('recepient_name', $this->user->first_name)
                    ->with('content', config('constants.email.DEFERRED_CONTENT'))
                    ->with('signature_line', config('constants.email.SIGNATURE_LINE'))
                    ->with('sender_name', config('constants.email.SENDER_NAME'));
            }
            //application rejected email
            if($this->user->user_status_id==config('constants.user_status.REJECTED')) {
                return $this->view('emails.application.change')
                    ->with('title', config('constants.email.TITLE'))
                    ->with('recepient_name', $this->user->first_name)
                    ->with('content', config('constants.email.REJECTED_CONTENT'))
                    ->with('signature_line', config('constants.email.SIGNATURE_LINE'))
                    ->with('sender_name', config('constants.email.SENDER_NAME'));
            }
        }elseif($this->user->role_id==config('constants.role.STUDENT_WORKER')){
            //application accepted email
            if($this->user->user_status_id==config('constants.user_status.PENDING')) {
                return $this->view('emails.application.change')
                    ->with('title', config('constants.email.TITLE'))
                    ->with('recepient_name', $this->user->first_name)
                    ->with('button_url', URL::to('/'))
                    ->with('button_text', config('constants.email.LOGIN'))
                    ->with('content', config('constants.email.ACCEPTED_CONTENT'))
                    ->with('signature_line', config('constants.email.SIGNATURE_LINE'))
                    ->with('sender_name', config('constants.email.SENDER_NAME'));
            }
        }
    }
}
