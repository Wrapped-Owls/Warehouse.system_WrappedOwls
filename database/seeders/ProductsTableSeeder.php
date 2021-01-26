<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('products')
		  ->insert(
			  [
				  'name' => 'ESP8266',
				  'material_description' => 'O ESP8266 é um microcontrolador do fabricante chinês Espressif que inclui capacidade de comunicação por Wi-Fi',
				  'image_path' => null, 'price' => 20, 'previous_price' => null, 'disposable' => false,
				  'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
				  'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
			  ]
		  );
	}
}
