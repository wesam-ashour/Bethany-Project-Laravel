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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longText('description');
            $table->date('date');
            $table->time('time');
            $table->string('lat');
            $table->string('long');
            $table->string('address');
            $table->foreignId('added_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->tinyInteger('updated_by')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1:ACTIVE | 0:INACTIVE');
            $table->string('image');
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
};
