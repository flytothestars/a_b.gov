<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DistributorTempl extends Mailable
{
    use Queueable, SerializesModels;

    protected $distributorData;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $distributorData)
    {
        $this->distributorData = $distributorData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Портал Almatybusiness: уведомление о поступлении новых обращений  - ' . date('Y-m-d H:i:'))->view('emails.distributorTempl')
            ->with([
                'distributorData' => $this->distributorData
            ]);
    }
}
