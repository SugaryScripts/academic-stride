<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ref_master_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->string('code', 4);
            $table->string('type', 50);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ref_master_types');
    }
};
