<?php namespace Mkinternet\Cookiesalert\Components;

use Mkinternet\Cookiesalert\Models\Settings;
use Cms\Classes\ComponentBase;

class CookiesAlert extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Cookiesalert Component',
            'description' => 'Cookiesalert Component'
        ];
    }

    public function defineProperties()
    {
      return [];
    }

    public function onRun(){
		$this->addJs('assets/js/jquery.cookiesdirective.js');
    }

    
}
