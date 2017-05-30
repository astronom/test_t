<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 30.05.17
 * Time: 12:36
 */

namespace AppBundle\Composer;

use Composer\Script\Event;

class ScriptHandler extends \Sensio\Bundle\DistributionBundle\Composer\ScriptHandler
{
    /**
     * Call the demo command of the Acme Demo Bundle.
     *
     * @param $event Event A instance
     */
    public static function prepareProject(Event $event)
    {
        $options = static::getOptions($event);
        $consoleDir = static::getConsoleDir($event, 'prepare project');

        if (null === $consoleDir) {
            return;
        }

        static::executeCommand($event, $consoleDir, 'doctrine:schema:drop --force');
        static::executeCommand($event, $consoleDir, 'doctrine:schema:update --force');
        static::executeCommand($event, $consoleDir, 'doctrine:fixtures:load -n');
    }
}