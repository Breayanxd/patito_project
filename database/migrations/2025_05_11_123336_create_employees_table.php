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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->foreignId('address_id')->nullable()->constrained()->onDelete('set null');
            $table->string('area_or_department');
            $table->string('position');
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');
            $table->date('date_entry');
            $table->enum('status',['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
