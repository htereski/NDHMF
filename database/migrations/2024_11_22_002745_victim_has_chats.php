<?php

use App\Models\Chat;
use App\Models\User;
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
        Schema::create('victim_has_chats', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'victim_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Chat::class, 'chat_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victim_has_chats');
    }
};