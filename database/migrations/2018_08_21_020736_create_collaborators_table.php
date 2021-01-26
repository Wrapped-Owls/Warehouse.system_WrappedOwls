<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollaboratorsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'collaborators', function (Blueprint $table) {
			$table->increments('code_user');
			$table->integer("code_area")
			      ->unsigned()
			      ->nullable();
			$table->foreign('code_area')
			      ->references('code_area')
			      ->on('areas')
			      ->onDelete('cascade');
			$table->foreign('code_user')
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
		Schema::dropIfExists('collaborators');
	}
}
