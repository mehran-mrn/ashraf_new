<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class payment_confirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $date;
    public $amount;
    public $ref_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name =$name;
        $this->date ="9/5/98";
        $this->amount ='90000000';
        $this->ref_id ='430495304-3453';
               //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mail.payment_confirmation');
    }
}
