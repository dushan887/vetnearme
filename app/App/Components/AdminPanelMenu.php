<?php

namespace App\App\Components;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

/**
 * This class will be used to build menu for admin panel based on the user role
 */
class AdminPanelMenu {

    static function menu($user)
    {

        if($user->hasRole('super_admin'))
            return self::superAdmin();

        if($user->hasRole('admin'))
            return self::admin();

        if($user->hasRole('user'))
            return self::user();

        return [];

    }

    private static function superAdmin()
    {
        \Event::listen('JeroenNoten\LaravelAdminLte\Events\BuildingMenu', function ($event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Blog',
                'url'  => 'admin/blog',
            ]);
        });
    }

    private static function admin()
    {
        \Event::listen('JeroenNoten\LaravelAdminLte\Events\BuildingMenu', function ($event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Blog',
                'url'  => 'admin/blog',
            ]);
        });
    }

    private static function user()
    {
        \Event::listen('JeroenNoten\LaravelAdminLte\Events\BuildingMenu', function ($event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Blog',
                'url'  => 'admin/blog',
            ]);
        });
    }

}
