<?php 

/**
 * @package RonashPlugin
 */

 namespace Inc;

use Inc\base\CustomPostTypeController;
use Inc\base\Enqueue;
use Inc\base\SettingLinks;
use Inc\base\TaxonomyController;
use Inc\base\WidgetController;
use Inc\pages\Dashboard;

final class Init{

    /**
     * Stored all the class inside an array 
     * @var array full list of classes
     */
    public static $services = [
         Dashboard::class,
         Enqueue::class,
         SettingLinks::class,
         CustomPostTypeController::class,
        TaxonomyController::class,
        WidgetController::class

     ]; 

     /**
      * loop through the classes, initialize them,
      * and call register method if exists
      *
      * @return void
      */
    public static function registerServices(){
        foreach(self::$services as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     *
     * @param class  $class class from the service array
     * @return  instance new instance of the class
     */
    private static function instantiate($class){
            return new $class();
    }
 }
