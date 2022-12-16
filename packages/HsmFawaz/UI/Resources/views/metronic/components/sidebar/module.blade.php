@props(['name','items'])
<div class="menu-item">
    <div class="menu-content pt-8 pb-2">
        <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ $name }}</span>
    </div>
</div>

@foreach($items as $item)
    @if(isset($item['items']))
        <x-ui::sidebar.menu
                :name="$item['name']"
                :icon="$item['icon']"
                :items="$item['items']"
        />
    @else
        <x-ui::sidebar.link
                :name="$item['name']"
                :icon="$item['icon']"
                :url="$item['url']"
        />
    @endif
@endforeach
