<?php

namespace Acelle\Plugin\Facebook\Controllers;

use Acelle\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Acelle\Plugin\Facebook\Main;
use Acelle\Model\SendingServer;

class MainController extends Controller
{
    /**
     * Facebook setting page.
     *
     * @return string
     **/
    public function index(Request $request)
    {
        $main = new Main();
        $record = $main->getDbRecord();
        $data = $record->getData();

        return view('facebook::index', [
            'plugin' => $record,
            'data' => $data,
        ]);
    }

    public function activate(Request $request)
    {
        $main = new Main();
        
        try {
            $main->saveAndActivate($request->app_id, $request->app_secret);
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->action('\Acelle\Plugin\Facebook\Controllers\MainController@index');
        }

        $request->session()->flash('alert-success', "Plugin activated!");
        return redirect()->action('Admin\PluginController@index');
    }
}
