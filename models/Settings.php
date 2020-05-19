<?php namespace Mkinternet\Cookiesalert\Models;

use Model;

class Settings extends Model
{
    public $implement = [
      'System.Behaviors.SettingsModel',
      '@RainLab.Translate.Behaviors.TranslatableModel'
    ];

    public $translatable = [
      'cookie_notice_content',
      'button_text'
    ];

    // A unique code
    public $settingsCode = 'cookies_alert_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}
