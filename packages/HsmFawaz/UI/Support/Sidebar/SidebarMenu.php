<?php

namespace HsmFawaz\UI\Support\Sidebar;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class SidebarMenu implements Arrayable
{
    public function __construct(
        protected string $name,
        protected string $icon = '',
        protected string|bool $permission = true,
        protected array $items = [],
    ) {
    }

    public static function create(string $name, string $icon = '', string|bool $permission = true)
    {
        return new static($name, $icon, $permission);
    }

    public function addLink(string $name, string $url, string $icon = '', string|bool $permission = true): static
    {
        $this->items[] = SidebarLink::to($name, $url, $permission, $icon);

        return $this;
    }

    public function permission(string|bool $permission): static
    {
        $this->permission = $permission;

        return $this;
    }

    public function push(array|SidebarLink|SidebarMenu $items): static
    {
        $this->items = Arr::wrap($items);

        return $this;
    }

    public function toArray(): array
    {
        $items = $this->getFilteredItemsArray();
        if (count($items) === 0 || $this->permission === false || (is_string($this->permission) && ! auth()->user()->can($this->permission))) {
            return [];
        }

        return [
            'name' => $this->name,
            'permission' => $this->permission,
            'icon' => $this->icon,
            'items' => $items,
        ];
    }

    private function getFilteredItemsArray(): array
    {
        return array_filter(array_map(function ($instance) {
            throw_if(! ($instance instanceof SidebarLink));

            return $instance->toArray();
        }, $this->items), fn ($i) => count($i) > 0);
    }
}
