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
                'title' => 'PROGRAMS',
                'items' => [
                    [
                        'name' => 'Programs',
                        'icon' => 'fa-building',
                        'route' => 'admin.access.programs.index',
                        'isActive' => request()->routeIs('admin.access.programs.*'),
                    ],
                    [
                        'name' => 'Business Goals',
                        'icon' => 'fa-bullseye',
                        'route' => 'admin.access.business-goals.index',
                        'isActive' => request()->routeIs('admin.access.business-goals.*'),
                    ],
                    [
                        'name' => 'Epics',
                        'icon' => 'fa-layer-group',
                        'route' => 'admin.access.epics.index',
                        'isActive' => request()->routeIs('admin.access.epics.*'),
                    ],
                    [
                        'name' => 'Features',
                        'icon' => 'fa-puzzle-piece',
                        'route' => 'admin.access.features.index',
                        'isActive' => request()->routeIs('admin.access.features.*'),
                    ],
                ],
            ],
            [
                'title' => 'AGILE MANAGEMENT',
                'items' => [
                    [
                        'name' => 'Sprints',
                        'icon' => 'fa-running',
                        'route' => 'admin.access.sprints.index',
                        'isActive' => request()->routeIs('admin.access.sprints.*'),
                    ],
                    [
                        'name' => 'Kanban Board',
                        'icon' => 'fa-columns',
                        'route' => 'admin.access.kanban.index',
                        'isActive' => request()->routeIs('admin.access.kanban.*'),
                    ],
                    [
                        'name' => 'User Stories',
                        'icon' => 'fa-tasks',
                        'route' => 'admin.access.user-stories.index',
                        'isActive' => request()->routeIs('admin.access.user-stories.*'),
                    ],
                    [
                        'name' => 'Testing',
                        'icon' => 'fa-vial',
                        'route' => 'admin.access.testing.index',
                        'isActive' => request()->routeIs('admin.access.testing.*'),
                    ],
                    [
                        'name' => 'Bugs',
                        'icon' => 'fa-bug',
                        'route' => 'admin.access.bugs.index',
                        'isActive' => request()->routeIs('admin.access.bugs.*'),
                    ],
                ],
            ],
            [
                'title' => 'DASHBOARDS',
                'items' => [
                    [
                        'name' => 'Stakeholder Dashboard',
                        'icon' => 'fa-chart-line',
                        'route' => 'admin.access.dashboard.stakeholder',
                        'isActive' => request()->routeIs('admin.access.dashboard.stakeholder'),
                    ],
                    [
                        'name' => 'Project Manager Dashboard',
                        'icon' => 'fa-chart-bar',
                        'route' => 'admin.access.dashboard.project-manager',
                        'isActive' => request()->routeIs('admin.access.dashboard.project-manager'),
                    ],
                    [
                        'name' => 'Team Dashboard',
                        'icon' => 'fa-users',
                        'route' => 'admin.access.dashboard.team',
                        'isActive' => request()->routeIs('admin.access.dashboard.team'),
                    ],
                ],
            ],
            [
                'title' => 'REPORTING',
                'items' => [
                    [
                        'name' => 'Sprint Reports',
                        'icon' => 'fa-calendar-week',
                        'route' => 'admin.access.reports.sprints',
                        'isActive' => request()->routeIs('admin.access.reports.sprints'),
                    ],
                    [
                        'name' => 'Quarterly Reports',
                        'icon' => 'fa-calendar-alt',
                        'route' => 'admin.access.reports.quarterly',
                        'isActive' => request()->routeIs('admin.access.reports.quarterly'),
                    ],
                    [
                        'name' => 'KPI Dashboard',
                        'icon' => 'fa-chart-pie',
                        'route' => 'admin.access.reports.kpi',
                        'isActive' => request()->routeIs('admin.access.reports.kpi'),
                    ],
                ],
            ],
        ];

        return view('components.admin.sidebar', compact('sidebarMenus'));
    }
}
