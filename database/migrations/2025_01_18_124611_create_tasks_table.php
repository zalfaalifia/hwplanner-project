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
         Schema::create(table: 'tasks', callback: function (Blueprint $table): void {
            $table->id(); // Primary key
            $table->string(column: 'title'); // Task title
            $table->text(column: 'description')->nullable(); // Optional task description
            $table->boolean(column: 'completed')->default(value:false); // Task completion status
            $table->timestamp(column: 'due_date')->nullable(); // Optional due date
            $table->string(column: 'image')->nullable(); // Image path (optional)
            $table->unsignedBigInteger(column: 'user_id'); // Foreign key to the user who created the task
            $table->timestamps(); // created_at and updated_at timestamps

            // Set up foreign key constraint with 'users' table
            $table->foreign(columns:'user_id')->references(columns:'id')->on(table: 'users')->onDelete(action: 'cascade');
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
