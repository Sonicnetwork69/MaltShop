<?php

namespace App\Lib;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Facades\Module;

class DatabaseUpgrader
{
    /**
     * Run Migrate and seed
     */
    public static function run(string|array $versions): void
    {
        DB::beginTransaction();

        try {
            self::runMigrations();
            self::runSeeds($versions);

            DB::commit();

            Artisan::call('cache:clear');
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception('Database upgrades failed: ' . $e->getMessage());
        }
    }

    /**
     * Run Migration
     */
    private static function runMigrations(): void
    {
        Artisan::call('migrate');

        foreach (Module::getOrdered() as $module) {
            Artisan::call('module:migrate', ['module' => $module->getName()]);
        }
    }

    /**
     * Run seeds
     */
    private static function runSeeds(string|array $versions): void
    {
        if (is_string($versions)) {
            $versions = [$versions];
        }

        // Run version seeds of root database
        foreach ($versions as $version) {
            $versionClassName = 'v' . str_replace('.', '_', $version) . '\DatabaseSeeder';
            $versionSeederFile = database_path("seeders/versions/{$versionClassName}.php");
        
            if (file_exists($versionSeederFile) && class_exists("Database\\Seeders\\versions\\{$versionClassName}")) {
                $class = "Database\\Seeders\\versions\\{$versionClassName}";
                Artisan::call('db:seed', ['--class' => $class]);
            }
        }        

        // Run version seeds of modules
        $seedClasses = self::getSeedClasses($versions);

        foreach ($seedClasses as $class) {
            if (class_exists($class)) {
                Artisan::call('db:seed', ['--class' => $class]);
            }
        }
    }

    /**
     * Get seed classes
     */
    private static function getSeedClasses(array $versions): array
    {
        $seedClasses = [];

        foreach (Module::getOrdered() as $module) {
            foreach ($versions as $version) {

                $seederClassName = self::buildSeederClassName($module->getName(), $version);

                if (file_exists(base_path($seederClassName . '.php'))) {
                    $seedClasses[] = $seederClassName;
                }
            }
        }

        return $seedClasses;
    }

    /**
     * Build seeder class
     */
    private static function buildSeederClassName(string $moduleName, string $version): string
    {
        $version = 'v' . str_replace('.', '_', $version);

        return 'Modules\\' . $moduleName . '\\Database\\Seeders\\versions\\' . $version . '\\DatabaseSeeder';
    }
}
