<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class updatedRolesMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user, $designer, $developer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $designer, $developer)
    {
        $this->user = $user;
        $this->designer = $designer;
        $this->developer = $developer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $designer = $this->designer;
        $developer = $this->developer;
        return $this->view('emails.updatedRolesMail', compact('user', 'designer', 'developer'));
    }
}
