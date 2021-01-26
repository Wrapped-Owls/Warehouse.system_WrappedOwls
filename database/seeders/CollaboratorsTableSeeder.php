<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollaboratorsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('collaborators')
		  ->insert(
			  [
				  'code_user' => 2, 'code_area' => 1, 'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
				  'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
			  ]
		  );
	}
}
