<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * 
     * 
     */
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id(); // Primary key

            $table->string('firstname')->notNull(); // Not null constraint
            $table->string('lastname')->notNull(); // Not null constraint
            $table->date('date_of_birth')->notNull(); // Not null constraint
            $table->string('education_qualification', 255)->notNull(); // Not null and max length constraint
            $table->text('address')->notNull(); // Not null constraint
            $table->string('email')->unique()->notNull(); // Unique and not null constraint
            $table->bigInteger('phone')->unsigned()->notNull(); // Not null constraint
            $table->string('photo_url')->nullable(); // Allow null values
            $table->string('resume_url')->nullable(); // Allow null values
    
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
