<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'inventory_products', function (Blueprint $table) {
			$table->increments('id');
			$table->integer("code_product")
			      ->unsigned();
			$table->integer("code_inventory")
			      ->unsigned();
			$table->integer("code_localization")
			      ->unsigned();
			$table->foreign('code_product')
			      ->references('code_product')
			      ->on('products')
			      ->onDelete('cascade');
			$table->foreign('code_inventory')
			      ->references('code_inventory')
			      ->on('inventories')
			      ->onDelete('cascade');
			$table->foreign('code_localization')
			      ->references('code_localization')
			      ->on('localizations')
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
		Schema::dropIfExists('inventory_products');
	}
}
