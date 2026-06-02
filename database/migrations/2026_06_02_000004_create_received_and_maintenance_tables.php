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
        Schema::create('received_items_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('procurement_item_id')->constrained('procurement_items')->onDelete('cascade');
            $table->integer('quantity_received');
            $table->foreignId('received_by_id')->constrained('users')->onDelete('restrict');
            $table->timestamp('received_at')->useCurrent();
        });

        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->text('action_description');
            $table->enum('condition_before', ['Bagus', 'Rusak', 'Perbaikan']);
            $table->enum('condition_after', ['Bagus', 'Rusak', 'Perbaikan']);
            $table->foreignId('performed_by_id')->constrained('users')->onDelete('restrict');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('maintenance_bhp_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_log_id')->constrained('maintenance_logs')->onDelete('cascade');
            $table->foreignId('bhp_id')->constrained('bhps')->onDelete('restrict');
            $table->integer('quantity_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_bhp_usages');
        Schema::dropIfExists('maintenance_logs');
        Schema::dropIfExists('received_items_log');
    }
};
