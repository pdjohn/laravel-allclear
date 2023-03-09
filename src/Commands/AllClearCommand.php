<?php

namespace PDJohn\AllClear\Commands;

use Illuminate\Console\Command;

class AllClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'all:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clearing route, config, cache, view in one command';

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
        $this->call('optimize');

        $this->call('route:cache');
        $this->call('config:cache');
        $this->call('view:cache');

        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('view:clear');
        $this->call('cache:clear');
    }
}
