<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $setting;
    public function __construct(){
        $this->setting = new SettingModel();
    }
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = $this->setting->find(1);
        return view('dashboard.admin.settings.list',compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $settingone = $this->setting->find($id);
        return view('dashboard.admin.settings.update', compact('settingone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updateSetting = $request->except('_token','_method');
        $this->setting->find($request->id)->update($updateSetting);
        return redirect()->route('list_setting');
    }


}
