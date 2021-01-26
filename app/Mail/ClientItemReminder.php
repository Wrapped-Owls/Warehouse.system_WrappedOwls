<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientItemReminder extends Mailable {
	use Queueable, SerializesModels;

	private $inout;

	/**
	 * Create a new message instance.
	 *
	 * @param $inout
	 */
	public function __construct($inout) {
		$this->inout = $inout;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(): ClientItemReminder {
		return $this->view('mailable.item_reminder', ['inout' => $this->inout]);
	}
}
