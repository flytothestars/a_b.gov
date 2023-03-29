<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceOrder extends Mailable
{
    use Queueable, SerializesModels;

    protected $orderData;

    /**
     * Create a new message instance.
     *
     * @param array $orderData
     */
    public function __construct(array $orderData)
    {
        $this->orderData = $orderData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Обращение с портала - ' . $this->orderData['serviceName'])->view('emails.serviceOrder')
            ->with([
                'orderData' => $this->orderData
            ]);
    }
}
