<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodoControllerTest extends TestCase
{
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		// These routes are publicly available
		// The expected HTTP code is 200 ("Ok")
		$arr = ['todos.index',  'login', 'password.request'];
		foreach ($arr as $name) {
			$url = route($name);
			fwrite(STDERR, print_r('Check 200 for ' . $url . PHP_EOL, true));

			$response = $this->call('GET', $url);
			$response->assertStatus(200);
		}

		fwrite(STDERR, print_r(PHP_EOL, true));

		// These routes are publicly restricted to logged-in users
		// so the expected HTTP code is 302 ("HTTP redirection")
		$arr = ['todos.create', 'logout'];
		foreach ($arr as $name) {
			$url = route($name);
			fwrite(STDERR, print_r('Check 302 for ' . $url . PHP_EOL, true));
			$response = $this->call('GET', $url);
			$response->assertStatus(302);
		}

		fwrite(STDERR, print_r(PHP_EOL, true));

		// If not logged-in, the creation form should redirect (302)
		// to the login screen
		$url = route('todos.create');
		fwrite(STDERR, print_r('Check redirection for ' . $url . PHP_EOL, true));

		$response = $this->call('GET', $url);
		$response->assertStatus(302);
		$response->assertSee('<title>Redirecting to ' . route('login') . '</title>');
	}
}
