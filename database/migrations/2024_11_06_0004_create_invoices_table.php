<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Added client_id
            $table->string('invoice_type');
            $table->string('invoice_number')->unique();
            $table->integer('po')->nullable();
            $table->string('bill_to');
            $table->string('ship_to');
            $table->date('date'); 
            $table->json('qty')->nullable(); 
            $table->json('description')->nullable();
            $table->json('unit_price')->nullable(); 
            $table->decimal('amount', 10, 2)->nullable(); 
            $table->decimal('total_amount', 10, 2); 
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->date('due_date')->nullable();
            $table->text('signature')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->enum('status', ['paid', 'unpaid', 'overdue'])->default('unpaid');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
