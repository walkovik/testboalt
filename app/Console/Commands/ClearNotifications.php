<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserNotification;

class ClearNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-notifications:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all user notifications';

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
        UserNotification::query()->delete();
        $this->info('All notifications were cleared successfully!');
        return 1;
    }
}
