<?php

namespace App\Console\Commands;

use App\Story;
use \Carbon\Carbon;
use Illuminate\Console\Command;

class deleteStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deletestories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all stories past 24 hours';

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
     * @return mixed
     */
    public function handle()
    {
        $stories = Story::where('created_at', '<=', Carbon::now()->subDay())->delete();
        return true;
    }
}
