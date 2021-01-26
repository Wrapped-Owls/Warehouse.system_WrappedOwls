<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class UserManagement extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$users = User::where('deleted_at', null)
		             ->paginate(10);
		$suspended = User::onlyTrashed()
		                 ->paginate(10);
		return view('user.index', compact('users', 'suspended'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(): Response {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request): Response {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show(int $id): Response {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Application|Factory|View|Response
	 */
	public function edit(int $id) {
		$user = User::find($id);
		return view('user.update', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return RedirectResponse|Response
	 */
	public function update(Request $request, int $id) {
		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->access_level = $request['accessLevel'];
		$user->save();
		return redirect()->route('user.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function destroy(int $id) {
		$user = User::find($id);
		$user->delete();
		$this->saveLog("Usuário " . $user->name . " suspendido pelo administrador " . auth()->user()->name);
		return redirect("/user");
	}

	/**
	 * Restore the specified resource from storage.
	 *
	 * @param int $id
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function restore(int $id) {
		User::withTrashed()
		    ->find($id)
		    ->restore();
		$user = User::find($id);
		$this->saveLog("Usuário " . $user->name . " restaurado pelo administrador " . auth()->user()->name);
		return redirect("/user");
	}

}
