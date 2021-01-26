<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model {
	use SoftDeletes;

	protected $primaryKey;

	function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->primaryKey = 'code_product';
	}

	/**
	 * @return HasMany
	 */
	public function item(): HasMany {
		return $this->hasMany('App\Models\Item', 'code_product');
	}
}
