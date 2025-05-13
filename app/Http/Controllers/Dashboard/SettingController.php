<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\SettingService;
use App\Http\Requests\Dashboard\SettingRequest;

class SettingController extends Controller
{
    protected $settingService;
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index() {
        return view('dashboard.settings.index');
    }

    public function update(SettingRequest $request, $id) {
        $data = $request->except(['_token', '_method']);
        if (!$this->settingService->updateSetting($id, $data)) {
            return redirect()->back()->with('error', __('messages.failed_msg'));
        }
        return redirect()->route('dashboard.settings.index')->with('success', __('messages.success_msg'));
    }
}
