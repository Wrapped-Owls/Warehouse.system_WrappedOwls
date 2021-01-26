<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model {
	use SoftDeletes;

	protected $primaryKey;

	function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->primaryKey = 'code_area';
	}
}
