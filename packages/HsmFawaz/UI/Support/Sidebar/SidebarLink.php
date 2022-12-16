<?php

namespace HsmFawaz\UI\Support\Sidebar;

use Illuminate\Contracts\Support\Arrayable;

class SidebarLink implements Arrayable
{
    public function __construct(
        protected string $name,
        protected string $url,
        protected string $icon = '',
        protected string|bool $permission = true,
    ) {
    }

    public static function to(
        string $name,
        string $url,
        string|bool $permission = true,
        string $icon = ''
    ): static
    {
        return new static($name, $url, $icon, $permission);
    }

    public function permission(string|bool $permission): static
    {
        $this->permission = $permission;

        return $this;
    }

    public function toArray(): array
    {
        if ($this->permission === false || (is_string($this->permission) && ! auth()->user()->can($this->permission))) {
            return [];
        }

        return [
            'name' => $this->name,
            'icon' => $this->icon,
            'permission' => $this->permission,
            'url' => $this->url,
        ];
    }
}
