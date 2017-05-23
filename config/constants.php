<?php
/**
 *
 * Purpose: Constants that are used in the project. Can be used to enumerate types.
 *
 * Notes: This file is loaded globally and the items are accessible from controllers
 *
 * @todo figure out a way to set these variables either from the database tables or seed file.
 * 
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
return[
        'role' => [
            'GUEST'=>2,
            'ADMINISTRATOR'=>3,
            'MASTER_TEACHER'=>4,
            'STUDENT_WORKER'=>5,
            'TEACHER'=>6,
            'APPLICATION'=>7
        ],
        'telephone_type'=>[
            'UNSPECIFIED'=>1
        ],
        'boolean'=>[
            'TRUE'=>1,
            'FALSE'=>0
        ],
        'user_status'=>[
            'UNSPECIFIED'=>1,
            'ACTIVE'=>2,
            'DORMANT'=>3,
            'PENDING'=>4,
            'NEW'=>5,
            'SHELVED'=>6,
            'INTERVIEW'=>7,
            'REJECTED'=>8
        ],
        'email'=>[
             'SIGNATURE_LINE'=>'With best regards,',
             'SENDER_NAME'=>'ETSU Child Study Center',
             'TITLE'=>'ETSU Child Study Center',
             'LOGIN'=>'Log in',
             'ACCEPTED_CONTENT'=>'Your application has been accepted. 
                                    <br>In order to complete the hiring process please login below with your ETSU credentials and complete the checklist.',
             'INTERVIEW_CONTENT'=>'We have so far been impressed with your application and would like to know more about you and maybe 
                                        show you around our facilities.<br>Please contact us to schedule a suitable time for an interview.',
             'DEFERRED_CONTENT'=>'We have decided you defer your application at this time.<br>Please 
                                feel free to give us a call if you have any questions.',
             'REJECTED_CONTENT'=>'While we are impressed with your application, we regret to inform you that your profile does not match
                                    what we need at this moment.<br>',
             'SUBMITTED_CONTENT' => 'You application has been submitted successfully. <br>.We will get back to you after your application is processed.'
        ],
];
