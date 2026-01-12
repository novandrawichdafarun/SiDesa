<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fund_transactions', function (Blueprint $table) {
            $table->id();
            // Relasi ke fund_categories
            $table->foreignId('fund_category_id')->constrained('fund_categories')->onDelete('cascade');

            // Relasi ke users (siapa yang membuat transaksi)
            $table->foreignId('user_id')->constrained('users');

            $table->date('transaction_date');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);

            // Bukti transaksi (path foto/pdf nota)
            $table->string('proof_file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_transactions');
    }
};
