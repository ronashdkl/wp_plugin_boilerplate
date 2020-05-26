<?php


namespace Inc\base;

/**
 * Class GlobalConfig
 * do not change this config file time to time. Change it before publishing.
 * @package Inc\base
 */
class GlobalConfig
{
const PLUGIN_NAME = "ronash_plugin";
const PLUGIN_SUFFIX = "ronash_";

public static function generateName($name){
    return self::PLUGIN_SUFFIX.$name;
}

}