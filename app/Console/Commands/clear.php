<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class clear extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'todos:clear';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clear todos app tables';

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
		\DB::table('todos')->truncate();

		\DB::table('users')->where('email', 'like', '%@todos.com')->delete();

		$this->info('>> Todos - Clear done <<');
	}
}
