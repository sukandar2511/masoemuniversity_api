<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrasiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user  = $this->user;
        return $this->view('verification', compact('user'));
    //    return $this->from('pengirim@malasngoding.com')
    //                 ->view('emailku')
    //                 ->with(
    //                     [
    //                         'nama' => 'Diki Alfarabi Hadi',
    //                         'website' => 'www.malasngoding.com',
    //                     ]);
    }
}
