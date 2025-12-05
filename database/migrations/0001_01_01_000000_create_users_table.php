<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration {
    use SoftDeletes;
    /**
     *
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Cria o ID único (ex: 1, 2, 3)
            $table->string('name'); // Cria a coluna 'Nome'
            $table->string('email')->unique(); // Cria 'Email' (sem repetidos)

            // --- INÍCIO DA SUA ALTERAÇÃO ---
            // Adicione EXATAMENTE estas linhas:

            $table->enum('role', ['admin', 'professor', 'aluno'])
                ->default('aluno');

            // --- FIM DA SUA ALTERAÇÃO ---

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // Senha
            $table->rememberToken();
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
