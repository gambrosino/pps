<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        abort_unless(Auth::user()->role->name == 'admin', 403);
        $setting = Setting::find(1);

        return view('settings.index', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        abort_unless(Auth::user()->role->name == 'admin', 403);
        $fields = $this->validate($request, [
            'solicitude_link' => 'required|string|URL',
            'revision_link' => 'required|string|URL',
            'report_link' => 'required|string|URL'
        ]);
        $setting->update($fields);

        return redirect()->route('settings.index', compact('setting'))->with('message','Configuraciones Actualizadas');
    }
}
