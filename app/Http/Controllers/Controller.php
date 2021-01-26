<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function saveLog($action) {
		$activity = new Activity();
		$activity->userId = auth()->user()->id;
		$activity->action = $action;
		$activity->save();
	}
}
