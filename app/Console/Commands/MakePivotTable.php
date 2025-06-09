<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakePivotTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-pivot-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $table1 = $this->argument('table1');
    $table2 = $this->argument('table2');
    $migrationName = "create_{$table1}_{$table2}_table";
    $pivotTable = "{$table1}_{$table2}";

    $this->call('make:migration', [
        'name' => $migrationName,
        '--create' => $pivotTable,
    ]);
}

}
