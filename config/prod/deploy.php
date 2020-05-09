<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\CustomDeployer;

return new class extends CustomDeployer
{
    private $deployDir = '/www/htdocs/w00f7b8b/icuhelp';

    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('ssh-w00f7b8b@w00f7b8b.kasserver.com')
        ;
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        $this->log('Checking that the repository is in a clean state.');
        $this->runLocal('git diff --quiet');

        $this->log('Preparing the app');
        $this->runLocal('rm -fr ./var/cache/*');
        $this->runLocal('yarn install');
        $this->runLocal('yarn encore production');
        $this->runLocal('composer dump-autoload --optimize --no-dev');
    }

    public function deploy()
    {
        $server = $this->getServers()->findAll()[0];

        $this->runLocal(sprintf('rsync --progress -crDpLt --force --delete ./ %s@%s:%s', $server->getUser(), $server->getHost(), $this->deployDir));
        $this->runRemote('SYMFONY_ENV=prod .bin/console cache:warmup --no-debug');
    }

    public function cancelDeploy()
    {
        // ...
    }

    public function rollback()
    {
        // ...
    }
};
