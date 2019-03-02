<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class RemoveOldMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:old-chat {count?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old chat messages from db';

    const MINIMUM_TO_KEEP = 30;

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
        $results = DB::table('messages')->count();

        $safeToDelete = $results >= self::MINIMUM_TO_KEEP ? true : false;

        $count = $this->setCount($results);

        if ($safeToDelete) {
            $this->deleteRecords($count);

            return;
        }

        $this->error('Not enough chat messages left to remove ' .
                        $count .
                        ' old chat messages!');
    }

    private function setCount($results) {
        if ($this->argument('count')) {
            $count = $this->argument('count');

            return $count;
        }

        $count = $results - self::MINIMUM_TO_KEEP;

        return $count;
    }

    /*
     * @param $count
    */
    private function deleteRecords($count) {
        DB::table('messages')->oldest()->limit($count)->delete();
        $this->info('removed' . $count . ' old chat messages!');
    }
}
