<?php

namespace App\Jobs;

use App\Mail\updatedRolesMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class updatedRolesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $userMail, $user, $designer , $developer;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userMail, $user, $designer, $developer)
    {
        $this->user = $user;
        $this->designer = $designer;
        $this->developer = $developer;
        $this->userMail = $userMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new updatedRolesMail($this->user, $this->designer, $this->developer);
        Mail::to($this->userMail)->send($email);
    }
}
