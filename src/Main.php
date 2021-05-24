<?php

namespace Acelle\Plugin\Facebook;

use Acelle\Model\Plugin as PluginModel;
use Aws\Route53\Route53Client;
use Aws\Route53Domains\Route53DomainsClient;
use Acelle\Library\Facades\Hook;
use Carbon\Carbon;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;

class Main
{
    const NAME = 'acelle/facebook';

    public function __construct()
    {
        //
    }

    public function getDbRecord()
    {
        return PluginModel::where('name', self::NAME)->first();
    }

    public function registerHooks()
    {
        Hook::register('activate_plugin_'.self::NAME, function () {
            $data = $this->getDbRecord()->getData();

            if (!array_key_exists('app_id', $data) || !array_key_exists('app_secret', $data)) {
                throw new \Exception('Plugin Facebook not configured yet');
            }
        });

        Hook::register('deactivate_plugin_'.self::NAME, function () {
            return true; // or throw an exception
        });

        Hook::register('delete_plugin_'.self::NAME, function () {
            return true; // or throw an exception
        });
    }

    public function activate()
    {
        $record = $this->getDbRecord();
        $record->activate();
    }
    
    public function saveAndActivate($appId, $appSecret)
    {
        $record = $this->getDbRecord();

        $record->updateData([
            'app_id' => $appId,
            'app_secret' => $appSecret,
        ]);

        // activate
        $record->activate();
    }
}
