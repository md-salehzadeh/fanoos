<?php

namespace Modules\Dev\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Dev extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Developing Operations';
	
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
		$this->test();
    }
	
	private function test() {
		// foreach ( \Module::scan() as $item ) {
		// 	dd($item->getScanPaths);
		// }
		dd(\Module::all());
	}

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
