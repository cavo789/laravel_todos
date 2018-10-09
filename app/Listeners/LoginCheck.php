<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Session;

class LoginCheck
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Handle the event.
	 *
	 * @param  Login $event
	 * @return void
	 */
	public function handle(Login $event)
	{
		$arr = Session::get('message');
		$arr[] = [
			'type' => 'warning',
			'message' => 'Really?'
		];
		Session::flash('message', $arr);
	}
}
