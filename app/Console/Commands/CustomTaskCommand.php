<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CustomTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выполнение заданной функции в указанные временные интервалы';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ваша логика здесь
        Log::info('Custom task executed at ' . now());
        
    }
}

