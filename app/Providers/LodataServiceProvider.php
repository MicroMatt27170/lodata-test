<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Flat3\Lodata\EntityType;
use Flat3\Lodata\Drivers\SQLEntitySet;
use Flat3\Lodata\Facades\Lodata;
use Illuminate\Support\Facades\Schema;

class LodataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Get all table names
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        Log::info('Tables: ', $tables);

        foreach ($tables as $table) {
            // Get current DB Driver Name
            $conName = Schema::getConnection()->getName();

            // Create a new EntityType for each table
            $entityType = new EntityType($conName. '__' .$table);

            // Create a new SQLEntitySet for each EntityType
            $entitySet = (new SQLEntitySet($conName. '.' .$table, $entityType))
                ->setTable($table)
                ->discoverProperties();

            // Register the SQLEntitySet with LoData
            Lodata::add($entitySet); // Add the entity set to the Lodata service
        }
    }
}
