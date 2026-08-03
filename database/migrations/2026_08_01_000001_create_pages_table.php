<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_id')->nullable();
            $table->enum('theme', ['romantic_classic', 'playful', 'elegant_night'])->default('romantic_classic');
            $table->string('recipient_name');
            $table->string('title');
            $table->text('story');
            $table->dateTime('countdown_date')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->enum('status', ['draft', 'pending_payment', 'paid', 'expired'])->default('draft');
            $table->enum('package', ['basic', 'premium', 'exclusive'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
