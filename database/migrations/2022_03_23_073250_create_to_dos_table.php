<?php

use App\Models\User;
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
        Schema::create('todos', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignIdFor(User::class, "user_id");
            $table->string("title", "500");
            $table->string("description", "5000")->nullable()->default(NULL);
            $table->boolean("done")->default(false);
            $table->timestamp("deadline")->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('to_dos');
    }
};
