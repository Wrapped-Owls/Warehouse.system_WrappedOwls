<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('items')
		  ->insert(
			  [
				  'code_product' => 1, 'code_area' => 1, 'total_inside' => 30, 'total_outside' => 0,
				  'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
				  'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
			  ]
		  );
	}
}
