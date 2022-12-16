<?php

namespace HsmFawaz\UI\Support\Sidebar;

use Illuminate\Contracts\Support\Arrayable;

class SidebarGenerator implements Arrayable
{
    private array $items = [];

    private array $modules = [];

    public function addModule(string $name, int $order = 0): SidebarModule
    {
        return $this->modules[$name] = new SidebarModule($name, $order);
    }

    public static function create(): static
    {
        return new static();
    }

    public function toArray(): array
    {
        return collect($this->modules)
            ->sortBy(fn ($i) => $i->order)
            ->transform(fn (SidebarModule $i) => $i->toArray())
            ->filter(fn ($i) => count($i) > 0)
            ->all();
    }
}
