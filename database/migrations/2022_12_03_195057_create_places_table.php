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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('description');
            $table->string('lat');
            $table->string('long');
            $table->longText('location');
            $table->tinyInteger('type')->default(1)->comment('1:PLACES | 0:TOURIST-SITE');
            $table->foreignId('added_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->tinyInteger('updated_by')->nullable();
            $table->string('QRCode')->nullable();
            $table->bigInteger('scanned')->nullable();
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
        Schema::dropIfExists('places');
    }
};
