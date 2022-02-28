<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 15);
            $table->string('address', 255);
            // user_id è la foreign key per creare una relazione con altra tabella 
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // per indicare foreign key
            $table->foreign('user_id')
                // punta la colonna id
                ->references('id')
                // della tabella:
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_info');
    }
}
