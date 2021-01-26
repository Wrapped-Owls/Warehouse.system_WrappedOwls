<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemRequest extends Model {
	protected $primaryKey;

	function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->primaryKey = 'code_request';
	}

	function inout(): BelongsTo {
		return $this->belongsTo('App\Models\InoutProduct', 'code_request', 'code_request');
	}

	function item(): HasOne {
		return $this->hasOne('App\Models\Item');
	}
}
