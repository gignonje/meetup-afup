<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Context to reload fixtures before each test
 */
final class ReloadFixturesContext implements Context
{
    /** @BeforeFeature */
    public static function reloadFixtures(): void
    {
        print "Loading fixtures for app " . PHP_EOL;

        $command = [
            __DIR__ . "/../../bin/console",
            "doctrine:fixtures:load",
            "--quiet",
            "--purge-with-truncate",
        ];

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }
}
