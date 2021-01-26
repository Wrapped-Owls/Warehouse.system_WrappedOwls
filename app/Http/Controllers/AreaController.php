<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class AreaController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('admin');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$areas = Area::paginate(10);
		return view('administrator/area_list', compact('areas'));
	}

	/**
	 * Load Create Area Form Page
	 *
	 * @return Application|Factory|View|Response
	 */
	public function create() {
		return view('administrator/register_area');
	}

	/**
	 * @param int $id
	 * @return Application|Factory|View|Response
	 */
	public function edit(int $id) {
		$area = Area::find($id);
		$collaborators = Collaborator::where('code_area', $id)->join('users', 'id', 'code_user')->where('access_level', 1)->get();
		return view('administrator/area_edit', compact('area', 'collaborators'));
	}

	/**
	 * @param $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$area = Area::find($id);
		$area->responsible = $request->input('responsible');
		$area->name = $request->input('name') ? $request->input('name') : $area->name;
		$area->save();
		return $this->edit($id);
	}

	/**
	 * Start register process
	 *
	 * @param Request $request
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function store(Request $request) {
		$area = new Area();
		$area->name = $request->input('name');
		$area->save();
		$this->saveLog("Criaçao da nova area " . $request->input('name'));
		return redirect('area');
	}

	public function remove(int $id): RedirectResponse {
		$data = Area::find($id);
		if ($data != null) {
	        $data->forceDelete();
	        return redirect()->route('area.index')->with(['message'=> 'Successfully deleted!!']);
	    }

    	return redirect()->route('area.index')->with(['message'=> 'Wrong ID!!']);
	}

}
