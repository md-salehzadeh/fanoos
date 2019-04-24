<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Dev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev';

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
		
	}
}
