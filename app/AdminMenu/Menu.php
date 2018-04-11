<?php

namespace App\AdminMenu;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

/**
 * This class will be used to build menu for admin panel based on the user role
 */
class Menu {

    static public function superAdmin($events){

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('MAIN NAVIGATION');

            $event->menu->add([
                'text' => 'Profile',
                'url' => 'user/',
            ]);
        });

    }

    static public function admin($events)
    {
       $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('MAIN NAVIGATION');

            $event->menu->add([
                'text' => 'Profile',
                'url' => 'user/',
            ]);
        });

    }

    static public function user($events){

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $event->menu->add('MAIN NAVIGATION');

            $event->menu->add([
                'text' => 'Profile',
                'url' => 'user/',
            ]);
        });

    }

}
