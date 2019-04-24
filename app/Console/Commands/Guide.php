<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Guide extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guide {--act=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Guidance';

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
	
	private $arguments;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$this->arguments = $this->arguments();

		$act = $this->option('act');

		switch ( $act ) {
			case 'output':
				$this->_output();
				break;

			case 'table':
				$this->_table();
				break;

			case 'ask':
				$this->_ask();
				break;

			case 'secret':
				$this->_secret();
				break;

			case 'confirm':
				$this->_confirm();
				break;

			case 'anticipate':
				$this->_anticipate();
				break;

			case 'choice':
				$this->_choice();
				break;

			case 'progress':
				$this->_progress();
				break;
		}
	}
	
	private function _output() {
		$this->line('This is a `line` sample!');echo "\n";
		$this->info('This is a `info` sample!');echo "\n";
		$this->comment('This is a `comment` sample!');echo "\n";
		$this->question('This is a `question` sample!');echo "\n";
		$this->error('This is a `error` sample!');
	}
	
	private function _table() {
		$headers = ['Id', 'Firstname', 'Lastname', 'Email'];
		$users = \App\User::get(['id', 'firstname', 'lastname', 'email'])->take(5)->toArray();
		$this->table($headers, $users);
	}
	
	private function _ask() {
		$name = $this->ask('What is your name?');

		$this->info("Hello $name");
	}
	
	private function _secret() {
		$password = $this->secret('What is the password?');

		$this->info("Your password is: $password");
	}
	
	private function _confirm() {
		if ( $this->confirm('Do you wish to continue?') ) {
			$this->info('here you go!');
		} else {
			$this->error("we're done here!");
		}
	}
	
	private function _anticipate() {
		$name = $this->anticipate('What is your name?', ['Mohammad', 'Erfan']);

		$this->info("Hello $name");
	}
	
	private function _choice() {
		$defaultIndex = 0;
		$name = $this->choice('What is your name?', ['Mohammad', 'Erfan'], $defaultIndex);

		$this->info("Hello $name");
	}
	
	private function _progress() {
		$users = \App\User::limit(5)->get();

		$bar = $this->output->createProgressBar(count($users));

		$bar->start();

		foreach ($users as $user) {
			$this->performTask($user);

			$bar->advance();
		}

		$bar->finish();

		echo "\n\n";

		$this->info('Task Done Successfully!');
	}
	
	private function performTask() {
		sleep(2);
	}
}
