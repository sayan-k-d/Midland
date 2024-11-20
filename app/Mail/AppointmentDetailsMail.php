<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentDetailsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {

        return $this->subject('Enquiry Details for ' . $this->data['name'])
            ->view('cms.layout.appoinment-email')
            ->with('data', $this->data);
    }
}
