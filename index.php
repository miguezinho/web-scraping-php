<?php
ini_set('max_execution_time', '300');
require __DIR__ . "/vendor/autoload.php";

use Controller\ExtractProvider;

echo "\n------------------------------------------------------------------------------------------------------\n";
echo "Iniciando Web Scraping - One Provider...\n";
echo "------------------------------------------------------------------------------------------------------\n\n\n";

$loop = React\EventLoop\Factory::create();
$loop->addTimer(2, function () use ($loop) {
    $ExctractController = new ExtractProvider();
    $ExctractController->runExtract();
});
$loop->run();

echo "\n\n------------------------------------------------------------------------------------------------------\n";
echo "Fim do Web Scraping - One Provider...";
echo "\n------------------------------------------------------------------------------------------------------";
