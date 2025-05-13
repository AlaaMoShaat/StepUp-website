<?php

namespace App\Services\Dashboard;

use App\Utils\ImageManeger;
use App\Repositories\Dashboard\SettingRepository;

class SettingService
{
    protected $settingRepository, $imageManeger;
    public function __construct(SettingRepository $settingRepository, ImageManeger $imageManeger)
    {
        $this->settingRepository = $settingRepository;
        $this->imageManeger = $imageManeger;
    }

    public function getSetting($id) {
        $setting = $this->settingRepository->getSetting($id);
        return $setting?? abort(404);
    }

    public function updateSetting($id, $data) {
        $setting = self::getSetting($id);
        if(array_key_exists('logo', $data) && $data['logo'] != null) {
            if($setting->logo != 'uploads/settings/mainLogo.png') {
                $this->imageManeger->deleteImageFromLocal($setting->logo);
            }
            $file_name = $this->imageManeger->uploadSingleImage('/', $data['logo'],'settings');
            $data['logo'] = $file_name; //update logo value
        }
        if(array_key_exists('favicon', $data) && $data['favicon'] != null) {
            if($setting->favicon != 'uploads/settings/mainFavicon.ico') {
                $this->imageManeger->deleteImageFromLocal($setting->favicon);
            }

            $file_name = $this->imageManeger->uploadSingleImage('/', $data['favicon'],'settings');
            $data['favicon'] = $file_name; //update favicon value
        }
        return $this->settingRepository->updateSetting($setting, $data);
    }
}