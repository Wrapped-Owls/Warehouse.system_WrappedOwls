<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRequestsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'item_requests', function (Blueprint $table) {
			$table->increments('code_request');
			$table->date('return_date');
			$table->boolean('another_area');
			$table->dateTime('request_datetime');
			$table->integer('quantity')
			      ->unsigned();
			$table->integer("code_item")
			      ->unsigned();
			$table->integer("code_user")
			      ->unsigned();
			$table->integer('responsible');
			$table->foreign('code_item')
			      ->references('code_item')
			      ->on('items')
			      ->onDelete('cascade');
			$table->foreign('code_user')
			      ->references('code_user')
			      ->on('collaborators')
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
		Schema::dropIfExists('item_requests');
	}
}
