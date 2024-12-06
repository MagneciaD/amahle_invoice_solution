<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('company_id');
        $table->decimal('amount', 8, 2);
        $table->enum('status', ['pending', 'completed', 'failed']);
        $table->timestamp('payment_date');
        $table->timestamp('next_payment_date')->nullable();
        $table->string('transaction_id')->unique();
        $table->timestamps();

        // Foreign key constraint
        $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
