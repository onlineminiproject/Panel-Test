<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('method'); // HTTP method
            $table->string('endpoint'); // API endpoint accessed
            $table->integer('response_code'); // HTTP status code
            $table->decimal('execution_time', 8, 3); // Time taken to process the request in seconds
            $table->string('token'); // API token accessed
            $table->timestamps(); // Created at and updated at timestamps
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_logs');
    }
};
