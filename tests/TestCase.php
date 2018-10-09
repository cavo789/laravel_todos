<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	use CreatesApplication;

	public function setup()
	{
		parent::setup();

		// Get the name of the calling function (f.i. "testPostingData")
		$testName = '* Running unit test for: ' . $this->getName() . ' *';
		$box = str_repeat('*', strlen($testName)) . PHP_EOL;

		// Display the name in the CLI
		self::output(PHP_EOL . $box . $testName . PHP_EOL . $box . PHP_EOL);
	}

	/**
	 * Display information to the CLI
	 *
	 * @param  string $line Sentence to display
	 * @return bool
	 */
	public function output(string $line) : bool
	{
		echo $line . PHP_EOL;

		return true;
	}
}
