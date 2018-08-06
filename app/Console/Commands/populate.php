<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker;

class populate extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'todos:populate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add fake data\'s to tables';

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
		// First clear previous content
		$this->call('todos:clear');

		// Ask how many items to create, default 20
		$wNbr = $this->ask('How many todos do you want to create?', 20);

		// Create user Christophe
		\DB::table('users')->insert([[
			'name' => 'Christophe',
			'email' => 'christophe@todos.com',
			'password' => bcrypt('admin')
		]]);

		// Getting the ID of the user Christophe
		$user_id = \DB::table('users')->where('name', 'Christophe')->take(1)->value('id');

		// Use faker to get french dummy text
		// If needed, just run "composer require fzaninotto/faker" in
		// a DOS prompt
		$faker = Faker\Factory::create('fr_FR');

		// Insert a few items for him
		for ($i = 0; $i < $wNbr; $i++) {
			\DB::table('todos')->insert([
				[
					'title' => $faker->sentence($nbWords = 6, $variableNbWords = true) .
						' (todo #' . ($i + 1) . ')',
					'description' => $faker->realText($maxNbChars = 1000),
					'user_id' => $user_id,
					'completed' => $faker->boolean(),
					'created_at' => now(),
					'updated_at' => now()
				]
			]);
		}

		$this->info('>> Todos - Populating done <<');
	}
}
