<?php

namespace csbans\config\app\bootstrap;

use csbans\config\app\bootstrap\exceptions\InstallRequiredException;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\db\Connection;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\web\Application;
use yii\base\BootstrapInterface;

class ConfigureFromConfigFile implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     * @throws ErrorException
     * @throws \yii\base\ExitException
     */
    public function bootstrap($app)
    {
        try {
            $this->configureDb();
            if(!$app->has('db')) {
                throw new ErrorException(Yii::t('app', 'CAN_NOT_CREATE_DB_CONNECTION'));
            }
        } catch(InstallRequiredException $e) {
            // App not installed
            if(Yii::$app->getRequest()->getIsConsoleRequest()) {
                // If is console app, return error in console
                Yii::$app->end(
                    Console::error(
                        Console::ansiFormat(
                            $e->getMessage(),
                            [Console::FG_RED, Console::BOLD]
                        )
                    )
                );
            }
            // If is web app, catch all request and redirect to install page
            Yii::$app->getSession()->setFlash('error', $e->getMessage());
            $app->catchAll = ['/main/default/install'];
        } catch(\Exception $e) {
            // Some another error
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * Configure a database connection from config file
     * @throws InstallRequiredException
     * @throws InvalidConfigException
     */
    private function configureDb()
    {
        // Config file path
        $configFile = Yii::getAlias('@app/config/config.php');

        // Check is file exist
        if(!is_file($configFile)) {
            throw new InstallRequiredException(Yii::t('app', 'NO_CONFIG_FILE_ERROR', ['configFile' => $configFile]));
        }
        $config = include $configFile;
        $dsn = "mysql:";

        // Configure DB component
        if(!empty($config['dbHost'])) {
            // Configuration by host and port
            $dsn .= "host={$config['dbHost']}";
            if(!empty($config['dbPort'])) {
                $dsn .=";port={$config['dbPort']}";
            }
        } elseif(!empty($config['dbUnixSocket'])) {
            // Configuration by unix socket (game server and mysql server can run on the same machine)
            $dsn .= "unix_socket={$config['dbUnixSocket']}";
        } else {
            // Connection type to a mysql server not set
            throw new InvalidConfigException(
                Yii::t(
                    'app',
                    'CONFIG_FILE_NO_HOST',
                    ['configFile' => $configFile]
                )
            );
        }
        // Check db name specified
        if(empty($config['dbName'])) {
            throw new InvalidConfigException(Yii::t('app', 'DB_NAME_NOT_SPECIFIED'));
        }
        // Check db user name specified
        if(empty($config['dbUser'])) {
            throw new InvalidConfigException(Yii::t('app', 'DB_USER_NOT_SPECIFIED'));
        }
        $dsn .= ";dbname={$config['dbName']}";
        $dbConfig = [
            'class' => Connection::class,
            'dsn' => $dsn,
            'username' => $config['dbUser'],
            'password' => $config['dbPassword'],
            'tablePrefix' => ArrayHelper::getValue($config, 'dbPrefix', 'amx_'),
            'charset' => 'utf8mb4',
            'enableSchemaCache' => true
        ];
        // Configure yii db component
        Yii::$app->set('db', Yii::createObject($dbConfig));
    }
}
