<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ChangeDataController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$data = [];
		$data['id'] = Auth::user()->id;
		$data['email'] = Auth::user()->email;
		$data['name'] = Auth::user()->name;
		$data['password'] = Auth::user()->password;
		return view('layouts/change_data')->with('data', $data);
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
	 * @return Application|Factory|View|Response
	 */
	public function store(Request $request) {
		$user = Auth::user();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = Hash::make($request['password']);
		$user->save();
		$this->saveLog("Alterou informaçoes da conta");
		return view('collaborator/index');

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
		return view('collaborator/reset_password');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $request, int $id): Response {
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy(int $id): Response {
		//
	}

}
