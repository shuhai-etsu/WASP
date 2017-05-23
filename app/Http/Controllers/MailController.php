<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{

    public function basic_email(){
        //These variables are found in a view and we're populating them here
        $data = array('first_name'=>"FIRST NAME",
            'last_name'=>"LAST NAME");

        Mail::send(['text'=>'pages.mail'], $data, function($message) {
            $message->to('etsuwasp@gmail.com', 'etsuwasp')->subject
            ('This is the subject');
            $message->from('bob@gmail.com','bob');
        });
        echo "Basic Email Sent";
    }

    public function html_email(){
        $data = array('first_name'=>"FIRST NAME",
            'last_name'=>"LAST NAME");

        Mail::send('pages.mail', $data, function($message) {
            $message->to('etsuwasp@gmail.com', 'etsuwasp')->subject
            ('This is the subject');
            $message->from('bob@gmail.com','bob');
        });
        echo "HTML Email Sent";
    }

    public function attachment_email(){
        $data = array('first_name'=>"FIRST NAME",
            'last_name'=>"LAST NAME");

        Mail::send('mail', $data, function($message) {
            $message->to('etsuwasp@gmail.com', 'etsuwasp')->subject
            ('This is the subject');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('bob@gmail.com','bob');
        });
        echo "Email Sent with attachment.";
    }
}