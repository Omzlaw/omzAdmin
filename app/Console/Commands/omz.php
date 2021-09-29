<?php

namespace App\Console\Commands;

use App\Composer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class omz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'omz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First time setup for Omz Admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        app()->make(Composer::class)->run(['install']);
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        Artisan::call('storage:link');
    }
}
