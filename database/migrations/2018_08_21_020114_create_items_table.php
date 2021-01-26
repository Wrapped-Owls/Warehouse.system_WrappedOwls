<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'items', function (Blueprint $table) {
			$table->increments('code_item');
			$table->integer("code_product")
			      ->unsigned();
			$table->integer("code_area")
			      ->unsigned();
			$table->unsignedInteger('total_inside');
			$table->unsignedInteger('total_outside');
			$table->foreign('code_product')
			      ->references('code_product')
			      ->on('products')
			      ->onDelete('cascade');
			$table->foreign('code_area')
			      ->references('code_area')
			      ->on('areas')
			      ->onDelete('cascade');
			$table->timestamps();
			$table->softDeletes();
		}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('items');
	}
}
