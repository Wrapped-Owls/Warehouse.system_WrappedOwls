<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInoutProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'inout_products', function (Blueprint $table) {
			$table->increments('code_inout');
			$table->dateTime('in_datetime')
			      ->nullable();
			$table->dateTime('out_datetime')
			      ->nullable();
			$table->unsignedInteger('quantity_received')
			      ->nullable();
			$table->integer("code_administrator")
			      ->unsigned();
			$table->integer("code_request")
			      ->unsigned();
			$table->foreign('code_administrator')
			      ->references('id')
			      ->on('users')
			      ->onDelete('cascade');
			$table->foreign('code_request')
			      ->references('code_request')
			      ->on('item_requests')
			      ->onDelete('cascade');
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
		Schema::dropIfExists('inout_products');
	}
}
