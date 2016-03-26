<?php


use Robo\Tasks;

class RoboFile extends Tasks
{
    public function resetdb($env = 'dev')
    {
        $commands = [];

        $commands[] = 'app/console doctrine:database:drop --force';
        $commands[] = 'app/console doctrine:database:create --if-not-exists';
        $commands[] = 'app/console doctrine:schema:create';
        $commands[] = 'app/console fos:user:create admin hello@sourcebox.be admin';
        $commands[] = 'app/console fos:user:promote admin ROLE_ADMIN';

        foreach ($commands as $command) {
            $this->taskExec($command)->arg('--env=' . $env)->run();
        }

        $this->say('Done!');
    }
}