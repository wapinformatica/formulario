<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // database/migrations/2023_01_01_create_forms_table.php
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // database/migrations/2023_01_01_create_form_questions_table.php
        Schema::create('form_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->enum('type', ['text', 'textarea', 'date', 'radio', 'checkbox', 'select', 'email', 'tel', 'number', 'cpf', 'phone', 'cellphone']);
            $table->boolean('is_required')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->text('options')->nullable(); // Para radio, checkbox e select
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // database/migrations/2023_01_01_create_form_responses_table.php
        Schema::create('form_responses', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('approval_notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // database/migrations/2023_01_01_create_form_response_answers_table.php
        Schema::create('form_response_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('response_id')->constrained('form_responses')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('form_questions')->onDelete('cascade');
            $table->text('answer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_errors');    
    }
};
