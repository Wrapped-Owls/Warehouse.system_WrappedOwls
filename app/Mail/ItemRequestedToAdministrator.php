<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItemRequestedToAdministrator extends Mailable {
	use Queueable, SerializesModels;

	private $item;

	/**
	 * Create a new message instance.
	 *
	 * @param $item
	 */
	public function __construct($item) {
		$this->item = $item;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(): ItemRequestedToAdministrator {
		return $this->view('mailable.requests', ['item' => $this->item]);
	}
}
