<?php

namespace App\ThirdParty;

use Attribute;
use ReflectionClass;
use ReflectionException;

/**
 * Attribut qui sert à marquer les méthodes
 */
#[Attribute(Attribute::TARGET_METHOD)]
final class CronJob {
	
	private static array $callables = [];
	
	public function __construct(private readonly string $class, private readonly string $method) {
	}
	
	public function getCallable(): array {
		return [$this->class, $this->method];
	}
	
	public static function getCallables(): array {
		return self::$callables;
	}
	
	/**
	 * @return void
	 * @throws ReflectionException
	 */
	public static function processCallables(): void {
		$files = scandir(APPPATH."Models/");
		foreach ($files as $file) {
			if (str_ends_with($file, ".php")) {
				$reflection = new ReflectionClass('App\Models\\' . str_replace(".php", "", basename($file)));
				foreach ($reflection->getMethods() as $method) {
					$attributes = $method->getAttributes(CronJob::class);
					if (count($attributes) > 0) {
						foreach ($attributes as $attribute) {
							$instance = $attribute->newInstance();
							if (get_class($instance) === 'App\ThirdParty\CronJob') {
								self::$callables[] = $instance->getCallable();
							}
						}
					}
				}
			}
		}
	}
	
}

CronJob::processCallables();
