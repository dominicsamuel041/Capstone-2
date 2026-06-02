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
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('creator_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['Draft', 'Reviewed', 'Locked'])->default('Draft');
            $table->timestamps();
        });

        Schema::create('procurement_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procurement_id')->constrained('procurements')->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['Asset', 'BHP']);
            $table->decimal('price', 12, 2);
            $table->integer('quantity');
            $table->string('purchase_link', 500)->nullable();
            // Optional replace_asset_id if it's replacing an old asset
            $table->foreignId('replace_asset_id')->nullable()->constrained('assets')->onDelete('set null');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->enum('delivery_status', ['Dipesan', 'Diterima Parsial', 'Diterima Lengkap'])->default('Dipesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_items');
        Schema::dropIfExists('procurements');
    }
};
