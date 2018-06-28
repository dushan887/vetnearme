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
                'text' => 'Dashboard',
                'url'  => '/',
                'icon' => 'dashboard'
            ]);
            $event->menu->add([
                'text' => 'My Account',
                'url'  => 'admin/profile',
                'icon' => 'user'
            ]);
            $event->menu->add([
                'text' => 'My Clinic',
                'url'  => 'admin/my-clinic',
                'icon' => 'hospital-o'
            ]);
            $event->menu->add([
                'text' => 'Mailbox',
                'url'  => 'admin/mailbox',
                'icon' => 'envelope-o',
            ]);
            $event->menu->add([
                'text' => 'Notifications',
                'url'  => 'admin/notifications',
                'icon' => 'bell-o'
            ]);
            $event->menu->add('ADMIN NAVIGATION');
            $event->menu->add([
                'text' => 'Users',
                'icon' => 'users',
                'submenu' => [
                    [
                        'text' => 'All Users',
                        'url'  => 'admin/users',
                        'icon' => 'users',
                    ],
                    [
                        'text' => 'Create User',
                        'url'  => 'admin/users/create',
                        'icon' => 'user'
                    ]
                ]
            ]);
            $event->menu->add([
                'text' => 'Clinics',
                'url'  => 'admin/clinics',
                'icon' => 'hospital-o'
            ]);
            $event->menu->add([
                'text' => 'Services',
                'url'  => 'admin/services',
                'icon' => 'plus-square'
            ]);
            $event->menu->add([
                'text' => 'Media',
                'url'  => 'admin/media',
                'icon' => 'picture-o'
            ]);
            $event->menu->add([
                'text' => 'Post',
                'url'  => 'admin/posts',
                'icon' => 'newspaper-o'
            ]);
            $event->menu->add([
                'text' => 'Post Categories',
                'url'  => 'admin/post-categories',
                'icon' => 'list-ol'
            ]);
            $event->menu->add([
                'text' => 'Settings',
                'url'  => 'admin/settings',
                'icon' => 'cogs'
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
