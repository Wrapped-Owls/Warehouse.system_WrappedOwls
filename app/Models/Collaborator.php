<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Collaborator extends Model {
	protected $primaryKey;

	function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->primaryKey = 'code_user';
	}

	protected $fillable = ['code_user', 'code_area'];

	public function user(): HasOne {
		return $this->hasOne('App\User', 'id');
	}
}
