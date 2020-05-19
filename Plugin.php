<?php namespace Mkinternet\Cookiesalert;

use Backend;
use System\Classes\PluginBase;
use Illuminate\Support\Facades\Event;
use Block;
use Mkinternet\CookiesAlert\Models\Settings;

/**
 * Cookiesalert Plugin Information File
 */
class Plugin extends PluginBase
{
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);
        $this->PluginPath = '/plugins/mkinternet/cookiesalert';
    }	
	
	
	
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Cookies alert',
            'description' => 'Cookies alert plugin',
            'author'      => 'Mkinternet',
            'icon'        => 'icon-legal'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        /** @var \Cms\Classes\Controller $controller  */
        Event::listen('cms.page.beforeDisplay', function($controller, $action, $params) {
            $controller->addJs($this->PluginPath . '/assets/js/jquery.cookiesdirective.js');


			$settings = new Settings();


			$initJS = "
$(document).ready(function() {
 
    $.cookiesDirective({
		privacyPolicyUri: '/polityka-prywatnosci',
	    position: 'bottom', //top
	    message: '{$settings::get('cookiealert_message')}',
		privacyPolicyUri: '{$settings::get('cookiealert_policyuri')}',
		privacyPolicyDescription: '{$settings::get('cookiealert_policydescription')}',		
		agreeButton: '{$settings::get('cookiealert_agreebutton')}',
		duration: 1000,
		
	});

});
";

			Block::append('scripts', '<script>'.$initJS.'</script>');



        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Mkinternet\Cookiesalert\Components\CookiesAlert' => 'CookiesAlert',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'mkinternet.cookiesalert.some_permission' => [
                'tab' => 'Cookiesalert',
                'label' => 'Manage cookie alert'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
        ];
    }
	
	
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Cookies alert',
                'description' => 'Settings for cookis alert, required by EU directive',
                'category'    => 'Cookies',
                'icon'        => 'icon-legal',
                'class'       => 'Mkinternet\CookiesAlert\Models\Settings',
                'order'       => 100,
                'permissions' => ['mkinternet.cookiesalert.settings']
            ]
        ];
    }	
	
}
