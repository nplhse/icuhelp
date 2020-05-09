<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('ssh-w00f7b8b@w00f7b8b.kasserver.com')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/www/htdocs/w00f7b8b/icuhelp')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:nplhse/icuhelp.git')
            // the repository branch to deploy
            ->repositoryBranch('master')
        ;
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        $this->log('Checking that the repository is in a clean state.');
        $this->runLocal('git diff --quiet');

        $this->log('Preparing the app');
        $this->runLocal('rm -fr ./var/cache/*');
        $this->runLocal('SYMFONY_ENV=prod ./bin/console setup');
        $this->runLocal('composer dump-autoload --optimize');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        $server = $this->getServers()->findAll()[0];

        $this->runLocal(sprintf('rsync --progress -crDpLt --force --delete ./ %s@%s:%s', $server->getUser(), $server->getHost(), $this->deployDir));
        $this->runRemote('SYMFONY_ENV=prod sudo -u www-data bin/console cache:warmup --no-debug');
    }
};
