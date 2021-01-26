<?php

namespace App\Http\Controllers\Auth;

use App\Models\Area;
use App\Models\Collaborator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/register';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm() {
		$areas = Area::all();
		return view('auth.register', ['data' => $areas]);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make(
			$data, [
			'name'     => 'required|string|max:255', 'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]
		);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param array $data
	 * @return \App\User
	 */
	protected function create(array $data) {
		$access_level = isset($data['accessLevel']) ? $data['accessLevel'] : 0;
		$user = User::create(
			[
				'name'         => $data['name'], 'email' => $data['email'], 'password' => Hash::make($data['password']),
				'access_level' => $access_level
			]
		);
		if($access_level >= 0) {
			Collaborator::create(['code_user' => $user->id, 'code_area' => $data['area']]);
		}
		return $user;
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request) {
		$this->validator($request->all())
		     ->validate();
		event(new Registered($user = $this->create($request->all())));
		// $this->guard()->login($user);
		return $this->registered($request, $user) ?: redirect($this->redirectPath());
	}

}
