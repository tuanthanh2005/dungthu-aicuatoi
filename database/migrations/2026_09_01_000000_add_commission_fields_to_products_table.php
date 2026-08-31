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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'commission_percent')) {
                $table->decimal('commission_percent', 8, 2)->nullable()->default(0)->after('price');
            }
            if (!Schema::hasColumn('products', 'commission_amount')) {
                $table->decimal('commission_amount', 15, 2)->nullable()->default(0)->after('commission_percent');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'commission_percent')) {
                $table->dropColumn('commission_percent');
            }
            if (Schema::hasColumn('products', 'commission_amount')) {
                $table->dropColumn('commission_amount');
            }
        });
    }
};
