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
                'title' => 'PROGRAMMA CONTEXT',
                'items' => [
                    [
                        'name' => 'Programma Open Overheid',
                        'icon' => 'fa-chevron-down',
                        'route' => '#',
                        'hasSubmenu' => true,
                        'isSubmenuOpen' => false,
                        'submenu' => [
                            [
                                'name' => 'Subprogramma 1',
                                'icon' => 'fa-circle',
                                'route' => '#',
                                'isActive' => false,
                            ],
                            [
                                'name' => 'Subprogramma 2',
                                'icon' => 'fa-circle',
                                'route' => '#',
                                'isActive' => false,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'MIJN WERK',
                'items' => [
                    [
                        'name' => 'Mijn Taken',
                        'icon' => 'fa-clipboard-list',
                        'route' => 'admin.mijn-taken.index',
                        'isActive' => request()->routeIs('admin.mijn-taken.*'),
                    ],
                ],
            ],
            [
                'title' => 'PROGRAMMA OVERZICHT',
                'items' => [
                    [
                        'name' => 'Dashboard',
                        'icon' => 'fa-th',
                        'route' => 'admin.index',
                        'isActive' => request()->routeIs('admin.index'),
                    ],
                    [
                        'name' => 'Businessdoelen',
                        'icon' => 'fa-bullseye',
                        'route' => 'admin.businessdoelen.index',
                        'isActive' => request()->routeIs('admin.businessdoelen.*'),
                    ],
                    [
                        'name' => 'Risico\'s & Knelpunten',
                        'icon' => 'fa-exclamation-triangle',
                        'route' => 'admin.risicos-knelpunten.index',
                        'isActive' => request()->routeIs('admin.risicos-knelpunten.*'),
                    ],
                    [
                        'name' => 'Rapportages',
                        'icon' => 'fa-file-alt',
                        'route' => 'admin.rapportages.index',
                        'isActive' => request()->routeIs('admin.rapportages.*'),
                    ],
                ],
            ],
        ];

        return view('components.admin.sidebar', compact('sidebarMenus'));
    }
}
