<?php

use HsmFawaz\UI\Support\Sidebar\SidebarGenerator;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

$sidebar = new SidebarGenerator();
$sidebar->addModule('')
        ->addLink(
            name: __('Home'),
            url: route('dashboard.home'),
            icon: 'fas fa-chart-area'
        );

$modules = File::files(__DIR__.'/modules');
collect($modules)
    ->reject(fn (SplFileInfo $i) => ! str_contains($i->getFilename(), '.sidebar'))
    ->each(function (SplFileInfo $i) use ($sidebar) {
        $callable = require __DIR__.'/modules/'.$i->getFilename();
        $callable($sidebar);
    });

return $sidebar->toArray();
