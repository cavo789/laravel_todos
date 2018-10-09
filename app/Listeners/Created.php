<?php

namespace App\Listeners;

use App\Events\TodoCreated;
use Session;

class Created
{
	public function handle(TodoCreated $event)
	{
		$arr = Session::get('message');
		$arr[] = [
			'type' => 'success',
			'message' => 'Todo ' . $event->todo->title . ' successfully created ' .
				'(#' . $event->todo->id . ')'
		];
		Session::flash('message', $arr);
	}
}
