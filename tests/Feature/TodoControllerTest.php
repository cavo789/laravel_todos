<?php

namespace Tests\Feature;

use Tests\TestCase;
use Auth;
use app\Todo;
use Faker;

class TodoControllerTest extends TestCase
{
	private $email = 'christophe@todos.com';
	private $password = 'admin';

	/**
	 * Test a few URLs as a guest
	 *
	 * @return boolean
	 */
	public function testGuestURLs() : bool
	{
		// To be sure, start the tests as guest
		if (Auth::check()) {
			Auth::logout();
		}

		// These routes are publicly available
		// The expected HTTP code is 200 ("Ok")
		$arr = ['todos.index', 'login', 'password.request'];

		foreach ($arr as $name) {
			$url = route($name);
			$this->output('Check 200 for ' . $url);

			$response = $this->call('GET', $url);
			$response->assertStatus(200);
		}

		// These routes are restricted to logged-in users
		// so the expected HTTP code is 302 ("HTTP redirection") and
		// should redirect to the login screen
		$uri = route('login');

		$arr = [
			'todos.create' => 'GET',
			'todos.edit' => 'GET',
			'todos.destroy' => 'DELETE',
			'todos.update' => 'PUT'
		];

		foreach ($arr as $name => $method) {
			// Except for create, we need to provide an ID
			if ($name == 'todos.create') {
				$url = route($name);
			} else {
				$url = route($name, '9999');
			}

			$this->output('Check 302 for [' . $method . '] ' . $url);

			$response = $this->call($method, $url);
			$response->assertRedirect($uri);
		}

		return true;
	}

	/**
	 * Try posting some data and check
	 *
	 * @return boolean
	 */
	public function testPosting() : bool
	{
		self::output('Connect as ' . $this->email . ' and ' .
			'post some data');

		// Connect
		$user = [
			'email' => $this->email,
			'password' => $this->password
		];

		if (Auth::attempt($user)) {
			// Ok, we're logged-in

			$faker = Faker\Factory::create('fr_FR');

			$postData = [
				'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
				'description' => 'Filled in by PHPUnit'
			];

			// Submit the record
			$response = $this->call('POST', route('todos.store'), $postData);

			// The response would be a redirection to the URL
			// for displaying the detail of the inserted record
			// 1. Retrieve the last inserted record; get his ID
			$id = Todo::max('id');

			// 2. Build the URI to that page
			// (f.i. http://127.0.0.1/todos/33
			$uri = route('todos.show', $id);

			self::output('Create new Todo #' . $id . ' and check returned URI');

			// And now assert that it's fine
			$response->assertRedirect($uri);
		}

		return true;
	}
}
