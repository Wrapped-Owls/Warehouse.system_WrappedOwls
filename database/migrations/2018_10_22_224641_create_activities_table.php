<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'activities', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('userId')
			      ->unsigned();
			$table->string('action');
			$table->foreign('userId')
			      ->references('id')
			      ->on('users')
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
		Schema::dropIfExists('activities');
	}
}
