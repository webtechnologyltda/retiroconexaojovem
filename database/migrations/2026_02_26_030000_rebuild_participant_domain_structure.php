<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('phones');
        Schema::dropIfExists('guardians');
        Schema::dropIfExists('consents');
        Schema::dropIfExists('participant_health_profiles');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('referral_sources');
        Schema::dropIfExists('shirt_sizes');

        Schema::create('shirt_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('label', 20)->unique();
            $table->timestamps();
        });

        Schema::create('referral_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('birth_date');
            $table->string('sex', 10)->nullable();
            $table->string('cpf', 14)->unique();
            $table->string('community')->nullable();
            $table->foreignId('shirt_size_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('referral_source_id')->nullable()->constrained()->nullOnDelete();
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('street');
            $table->string('number', 30);
            $table->string('complement')->nullable();
            $table->string('district');
            $table->string('city');
            $table->string('state', 10);
            $table->string('zip_code', 20);
            $table->timestamps();
        });

        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedTinyInteger('priority')->default(1);
            $table->timestamps();

            $table->index(['participant_id', 'priority']);
        });

        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_id')->constrained()->cascadeOnDelete();
            $table->string('number', 30);
            $table->boolean('is_whatsapp')->default(false);
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create('participant_health_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->unique()->constrained()->cascadeOnDelete();
            $table->text('dietary_restrictions')->nullable();
            $table->text('medications')->nullable();
            $table->text('medication_frequency')->nullable();
            $table->text('allergies')->nullable();
            $table->boolean('pcd')->nullable();
            $table->text('pcd_details')->nullable();
            $table->timestamps();
        });

        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->unique()->constrained()->cascadeOnDelete();
            $table->boolean('accepted')->default(false);
            $table->dateTime('accepted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phones');
        Schema::dropIfExists('guardians');
        Schema::dropIfExists('consents');
        Schema::dropIfExists('participant_health_profiles');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('referral_sources');
        Schema::dropIfExists('shirt_sizes');

        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->date('data_nascimento');
            $table->string('cpf', 14)->unique();
            $table->text('endereco');
            $table->string('nome_responsavel');
            $table->string('telefone_responsavel', 20);
            $table->string('nome_outro_responsavel')->nullable();
            $table->string('telefone_outro_responsavel', 20)->nullable();
            $table->text('endereco_completo');
            $table->text('restricao_alimentar')->nullable();
            $table->text('medicamento_uso')->nullable();
            $table->text('alergia')->nullable();
            $table->text('pcd_laudo')->nullable();
            $table->boolean('autorizacao_uso_imagem')->default(false);
            $table->string('tamanho_camiseta', 10);
            $table->string('como_ficou_sabendo', 150)->nullable();
            $table->string('comunidade', 150)->nullable();
            $table->string('foto_passageiro')->nullable();
            $table->string('forma_pagamento', 50);
            $table->timestamps();
        });
    }
};
