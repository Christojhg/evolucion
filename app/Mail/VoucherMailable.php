<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\VoucherController;

class VoucherMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject="Envio de Boleta";

    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id=$id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link_id=VoucherController::voucher_generate_static($this->id);
        return $this->view('email.voucher')->with('link_id',$link_id);
    }
}
