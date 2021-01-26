<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use ErrorException;
use Tests\TestCase;

class TestRegister extends RegisterController {
	public function newCreate(array $data) {
		$this->create($data);
	}
}

class CollaboratorTest extends TestCase {

	public function testRegisterCollaborator() {
		$request = ['name' => 'Mayara', 'email' => 'may@gmail.com', 'password' => '123456', 'access_level' => 0];
		try {
			(new TestRegister())->newCreate($request);
		} catch(ErrorException $e) {
			$e->getMessage();
		}
		$this->assertEquals(
			User::where('email', 'may@gmail.com')
			    ->first()->name, 'Mayara'
		);
	}
}
