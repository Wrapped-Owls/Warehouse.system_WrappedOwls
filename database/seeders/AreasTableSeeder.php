<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('areas')
		  ->insert(
			  [
				  'name' => 'Tecnologia de Informação', 'responsible' => null,
				  'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
				  'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
			  ]
		  );
	}
}
