<?php


namespace Inc\base;

/**
 * Class Manager
 * @package Inc\base
 */
class Manager
{

    const CPT_MANAGER = 'cpt_manager';
    const TAXONOMY_MANAGER = 'taxonomy_manager';
    const WIDGET_MANAGER = 'widget_manager';
    const MEDIA_MANAGER = 'media_manager';
    const GALLERY_MANAGER = 'gallery_manager';
    const TESTIMONIAL_MANAGER = 'testimonial_manager';
    const TEMPLATES_MANAGER = 'templates_manager';
    const LOGIN_MANAGER = 'login_manager';
    const MEMBERSHIP_MANAGER = 'membership_manager';
    const CHAT_MANAGER = 'chat_manager';


    public static $list = [
        self::CPT_MANAGER => 'CPT',
        self::TAXONOMY_MANAGER => 'Taxonomy',
        self::WIDGET_MANAGER => 'Widget',
        self::MEDIA_MANAGER => 'Media',
        self::GALLERY_MANAGER => 'Gallery',
        self::TESTIMONIAL_MANAGER => 'Testimonial',
        self::TEMPLATES_MANAGER => 'Template',
        self::LOGIN_MANAGER => 'Login',
        self::MEMBERSHIP_MANAGER => 'Membership',
        self::CHAT_MANAGER => 'Chat'

    ];


   public  static function isActive($manager){
       $option = get_option('ronash_plugin');
       return  isset($option[$manager])?$option[$manager]:false;
    }
}