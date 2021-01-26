<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model {
	protected $primaryKey;

	function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->primaryKey = 'code_item';
	}

	public function product(): HasOne {
		return $this->hasOne('App\Models\Product', 'code_product');
	}

	public function area(): HasOne {
		return $this->hasOne('App\Models\Area', 'code_area');
	}

	public function itemRequests(): BelongsToMany {
		return $this->belongsToMany('App\Models\ItemRequest', 'items', 'code_item', 'code_item')
		            ->orderByDesc('request_datetime');
	}
}
