<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Renombrar la tabla de status a statuses
        Schema::rename('status', 'statuses');
    }

    public function down(): void
    {
        Schema::rename('statuses', 'status');
    }
};

