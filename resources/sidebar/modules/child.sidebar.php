<?php

use App\Domain\Child\Enums\ChildPermissions;
use HsmFawaz\UI\Support\Sidebar\SidebarGenerator;

return static function (SidebarGenerator $sidebar) {
    $sidebar
        ->addModule('Child', 10)
        ->addLink(
            name: __('Bracelets'),
            url: route('dashboard.child.bracelets.index'),
            icon: 'fas fa-users',
            permission: ChildPermissions::bracelets()->can('read')
        );
};
