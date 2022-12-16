<?php

namespace HsmFawaz\UI\Support\Sidebar;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class SidebarModule implements Arrayable
{
    protected array $features = [];

    public function __construct(protected string $name, public int $order)
    {
    }

    public function push(string|array $feature): static
    {
        $this->features = array_merge($this->features, Arr::wrap($feature));

        return $this;
    }

    public function addLink(string $name, string $url, string $icon = '', string|bool $permission = ''): static
    {
        $this->features[] = SidebarLink::to($name, $url, $permission, $icon);

        return $this;
    }

    public function addMenu(
        string $name,
        string $icon = '',
        string|bool $permission = '',
        ?\Closure $links = null
    ): static
    {
        $menu = SidebarMenu::create($name, $icon, $permission);
        $links($menu);
        $this->features[] = $menu;

        return $this;
    }

    public function toArray()
    {
        $items = $this->getFilteredItemsArray();
        if (count($items) === 0) {
            return [];
        }

        return [
            'name' => $this->name,
            'order' => $this->order,
            'icon' => '',
            'items' => $items,
        ];
    }

    private function getFilteredItemsArray(): array
    {
        return array_filter(array_map(function ($instance) {
            throw_if(! ($instance instanceof SidebarLink) && ! ($instance instanceof SidebarMenu));

            return $instance->toArray();
        }, $this->features), fn ($i) => count($i) > 0);
    }
}
