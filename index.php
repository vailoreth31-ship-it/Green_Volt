<?php

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

spl_autoload_register(function ($class) {
	$prefixes = [
		'App\\' => __DIR__ . '/app/',
		'Config\\' => __DIR__ . '/config/'
	];

	foreach ($prefixes as $prefix => $basePath) {
		if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
			continue;
		}

		$relativeClass = substr($class, strlen($prefix));
		$file = $basePath . str_replace('\\', '/', $relativeClass) . '.php';

		if (!file_exists($file)) {
			$directory = dirname($file);
			$filename = basename($file);
			$classFilename = substr($filename, 0, -4);
			$file = $directory . '/' . $classFilename . 's.php';
		}

		if (file_exists($file)) {
			require_once $file;
		}

		return;
	}
});

require_once __DIR__ . '/app/Router.php';

new App\Router();