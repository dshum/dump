<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class AdminRegister extends Mailable
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
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = Config::get('mail.from.address');
        $name = Config::get('mail.from.name');

        return $this->
            to($address, $name)->
            subject('Новый пользователь')->
            view('mails.adminRegister')->with([
			    'user' => $this->user
		    ]);
    }
}