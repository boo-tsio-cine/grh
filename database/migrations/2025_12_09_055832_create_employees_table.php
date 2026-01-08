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
            $table->string('last_name');
            $table->string('first_name');
            $table->enum('gender', ['M', 'F']);
            $table->date('ddn');
            $table->string('phone');
            $table->string('addresse');
            $table->string('mail');
            $table->foreignId('departement_id')
                    ->nullable()
                    ->constrained('departements')
                    ->nullOnDelete();
            $table->string('position');
            $table->string('salary_base');
            $table->date('hire_date');
            $table->string('photo');
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
