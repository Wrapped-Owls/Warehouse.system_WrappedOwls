<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InoutProduct extends Model {
	protected $primaryKey;

	function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->primaryKey = 'code_inout';
	}

	public function getRequest(): HasOne {
		return $this->hasOne('App\Models\ItemRequest');
	}
}
