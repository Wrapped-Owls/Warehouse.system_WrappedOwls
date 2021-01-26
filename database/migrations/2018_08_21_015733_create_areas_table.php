<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'areas', function (Blueprint $table) {
			$table->increments('code_area');
			$table->string('name', 35)
			      ->unique();
			$table->unsignedInteger('responsible')
			      ->nullable();
			$table->foreign('responsible')
			      ->references('id')
			      ->on('users')
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
		Schema::dropIfExists('areas');
	}
}
