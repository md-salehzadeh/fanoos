<?php

namespace Modules\Feed\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Feed extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'feed';

    /**
     * The console command description.
     *
     * @var string
     */
	public $description = 'Gather feeds and insert them into database.';
	
	/**
	 * Default time periods between running this command as cron
	 *
	 * @var string
	 */
	// public $cron = '* * * * *';
	public $cron = false;

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
        $items_inserted = 5;
		$items_recategorized = 10;

		$this->comment(PHP_EOL.$items_inserted . ' New feed(s) inserted And '.$items_recategorized.' Item(s) has been recategorized.'.PHP_EOL);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            
        ];
    }
}
