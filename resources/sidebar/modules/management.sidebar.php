<?php

use App\Domain\Management\Enums\ManagementPermissions;
use HsmFawaz\UI\Support\Sidebar\SidebarGenerator;

return static function (SidebarGenerator $sidebar) {
    $sidebar
        ->addModule('Management', 10)
        ->addMenu(
            name: __('Managers'),
            icon: 'fas fa-cog',
            links: function ($menu) {
                $menu
                    ->addLink(
                        name: __('Users'),
                        url: route('dashboard.management.users.index'),
                        icon: 'fas fa-users',
                        permission: ManagementPermissions::users()->can('read')
                    )
                    ->addLink(
                        name: __('Roles and Permissions'),
                        url: route('dashboard.management.roles.index'),
                        icon: 'fas fa-key',
                        permission: ManagementPermissions::roles()->can('read')
                    );
            }
        );
};
