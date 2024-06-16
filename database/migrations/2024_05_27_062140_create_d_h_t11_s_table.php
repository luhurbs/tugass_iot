<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('d_h_t11_s', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('suhu');
        $table->decimal('kelembapan');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('d_h_t11_s');
}

};
