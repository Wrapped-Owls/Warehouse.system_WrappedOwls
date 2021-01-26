<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('users')
		  ->insert(
			  [
				  'name' => 'Usuario Administrador', 'email' => 'admin@almoxarifado.com',
				  'password' => bcrypt('123456'), 'access_level' => 3,
				  'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
				  'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
			  ]
		  );
		DB::table('users')
		  ->insert(
			  [
				  'name' => 'Usuario Colaborador', 'email' => 'colaborador@almoxarifado.com',
				  'password' => bcrypt('123456'), 'access_level' => 0,
				  'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
				  'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
			  ]
		  );
	}
}
