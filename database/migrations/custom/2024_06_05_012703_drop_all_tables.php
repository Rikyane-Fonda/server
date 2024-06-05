<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        $tables = DB::select('SHOW TABLES');
        $database = env('DB_DATABASE');
        $key = "Tables_in_$database";

        foreach ($tables as $table) {
            $tableName = $table->$key;
            Schema::drop($tableName);
        }

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        // Cette migration n'est pas réversible
    }
};
