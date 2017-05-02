<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Auth;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientEmail extends Mailable
{

    use Queueable, SerializesModels;

    public $content;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$title)
    {
        //
        $this->content = $content;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email)
                        ->subject($this->title)
                        ->view('email.body_email');


    }
}
