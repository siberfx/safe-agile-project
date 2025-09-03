<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sidebarMenus = [
            [
                'title' => 'MAIN MENU',
                'items' => [
                    [
                        'name' => 'Dashboard',
                        'icon' => 'fa-chart-line',
                        'route' => 'admin.index',
                        'isActive' => request()->routeIs('admin.index'),
                    ],
                    [
                        'name' => 'Comments',
                        'icon' => 'fa-comments',
                        'route' => '#',
                        'hasSubmenu' => true,
                        'submenu' => [
                            [
                                'name' => 'All Comments',
                                'icon' => 'fa-comment',
                                'route' => '#',
                                'isActive' => false,
                            ],
                        ],
                    ],

                    [
                        'name' => 'Settings',
                        'icon' => 'fa-gear',
                        'route' => '#',
                        'hasSubmenu' => true,
                        'isSubmenuOpen' => request()->routeIs('admin.menu-builder.*') || request()->routeIs('admin.access.*'),
                        'submenu' => [
                            [
                                'name' => 'Menu Builder',
                                'icon' => 'fa-bars',
                                'route' => 'admin.menu-builder.index',
                                'isActive' => request()->routeIs('admin.menu-builder.*'),
                            ],
                            [
                                'type' => 'subsection',
                                'title' => 'ROLES & PERMISSIONS',
                                'items' => [
                                    [
                                        'name' => 'Users',
                                        'icon' => 'fa-user',
                                        'route' => 'admin.access.users.index',
                                        'isActive' => request()->routeIs('admin.access.users.*'),
                                    ],
                                    [
                                        'name' => 'Roles',
                                        'icon' => 'fa-users',
                                        'route' => 'admin.access.roles.index',
                                        'isActive' => request()->routeIs('admin.access.roles.*'),
                                    ],
                                    [
                                        'name' => 'Permissions',
                                        'icon' => 'fa-key',
                                        'route' => 'admin.access.permissions.index',
                                        'isActive' => request()->routeIs('admin.access.permissions.*'),
                                    ],
                                ],
                            ],
                            [
                                'type' => 'subsection',
                                'title' => 'SYSTEM',
                                'items' => [
                                                                [
                                'name' => 'General',
                                'icon' => 'fa-gear',
                                'route' => 'admin.settings.general.index',
                                'isActive' => request()->routeIs('admin.settings.general.*'),
                            ],
                                    [
                                        'name' => 'Home Setting',
                                        'icon' => 'fa-house',
                                        'route' => '#',
                                        'isActive' => false,
                                    ],
                                    [
                                        'name' => 'Social Setting',
                                        'icon' => 'fa-comments',
                                        'route' => '#',
                                        'isActive' => false,
                                    ],
                                    [
                                        'name' => 'Site settings',
                                        'icon' => 'fa-globe',
                                        'route' => '#',
                                        'isActive' => false,
                                    ],
                                    [
                                        'name' => 'Hero slider',
                                        'icon' => 'fa-images',
                                        'route' => '#',
                                        'isActive' => false,
                                    ],
                                    [
                                        'name' => 'Pagination',
                                        'icon' => 'fa-list',
                                        'route' => '#',
                                        'isActive' => false,
                                    ],
                                    [
                                        'name' => 'API Settings',
                                        'icon' => 'fa-wrench',
                                        'route' => 'admin.settings.api-settings.index',
                                        'isActive' => request()->routeIs('admin.settings.api-settings.*'),
                                    ],
                                    [
                                        'name' => 'Bestandsbeheer',
                                        'icon' => 'fa-book-open',
                                        'route' => '#',
                                        'isActive' => false,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return view('components.admin.sidebar', compact('sidebarMenus'));
    }
}
