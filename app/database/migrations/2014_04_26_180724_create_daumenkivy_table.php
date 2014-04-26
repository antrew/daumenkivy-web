<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateDaumenkivyTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'daumenkivies', function ($table) {
			$table->increments ( 'id' );
			$table->string ( 'caption' );
			$table->string ( 'username' );
			$table->string ( 'email' );
			$table->timestamps ();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'daumenkivys' );
	}
}
