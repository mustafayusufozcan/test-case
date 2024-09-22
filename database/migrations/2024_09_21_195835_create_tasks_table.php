<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->string('provider');
            $table->unsignedBigInteger('foreign_id');
            $table->unsignedSmallInteger('difficulty');
            $table->unsignedSmallInteger('duration');
            $table->double('work_duration')->nullable();
            $table->double('delivery_duration')->nullable();
            $table->timestamps();

            $table->unique(['provider', 'foreign_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
