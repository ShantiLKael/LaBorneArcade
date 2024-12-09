<?php

namespace App\Controllers;

use App\ThirdParty\CronJob;

class ControleurCronJob extends BaseController {
	
	public function index(): void {
		$callables = CronJob::getCallables();
		foreach ($callables as $callable) {
			$instance = new $callable[0]();
			$instance->{$callable[1]}();
		}
	}
	
}
