<?php

namespace App\Http\Controllers;

use App\Models\ItemRequest;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class CollaboratorController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct() {
		$this->middleware('collaborator');
	}


	/**
	 * Show the application dashboard.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		return view('home');
	}

	public function collaborator() {
		return view('collaborator/index');
	}

	public function approve($id) {
		$data = ItemRequest::find($id);
		$data->another_area = false;
		$data->save();
		return redirect('home');
	}

	public function refuse($id) {
		$data = ItemRequest::find($id);
		$data->delete();
		return redirect('home');
	}
}
