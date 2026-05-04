<?php

use App\Support\MoroccanCities;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();
        if (! in_array($driver, ['mysql', 'pgsql', 'sqlsrv'], true)) {
            return;
        }

        $cities = implode("','", array_map(
            static fn (string $city): string => str_replace("'", "''", $city),
            MoroccanCities::all()
        ));

        DB::statement("ALTER TABLE trajets ADD CONSTRAINT chk_trajets_departure_city CHECK (departure_city IN ('{$cities}'))");
        DB::statement("ALTER TABLE trajets ADD CONSTRAINT chk_trajets_arrival_city CHECK (arrival_city IN ('{$cities}'))");
        DB::statement('ALTER TABLE trajets ADD CONSTRAINT chk_trajets_different_cities CHECK (departure_city <> arrival_city)');
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if (! in_array($driver, ['mysql', 'pgsql', 'sqlsrv'], true)) {
            return;
        }

        DB::statement('ALTER TABLE trajets DROP CONSTRAINT chk_trajets_departure_city');
        DB::statement('ALTER TABLE trajets DROP CONSTRAINT chk_trajets_arrival_city');
        DB::statement('ALTER TABLE trajets DROP CONSTRAINT chk_trajets_different_cities');
    }
};
