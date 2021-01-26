<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'products', function (Blueprint $table) {
			$table->increments('code_product');
			$table->string('name', 40)
			      ->unique();
			$table->string('material_description', 260);
			$table->string('image_path', 180)
			      ->nullable();
			$table->float('price', 10, 3);
			$table->float('previous_price', 10, 3)
			      ->nullable();
			$table->boolean('disposable');
			$table->softDeletes();
			$table->timestamps();
		}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('products');
	}
}
