@props(['name','icon'=>'','items'=>[]])
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
<span class="menu-link">
     @if(filled($icon))
        <span class="menu-icon">
             <i class="{{ $icon }} fs-3"></i>
        </span>
    @endif
    <span class="menu-title">{{  $name  }}</span>
    <span class="menu-arrow"></span>
</span>
    {{--  //todo  menu-active-bg --}}
    <div class="menu-sub menu-sub-accordion ">

        @foreach($items as $item)
            <x-ui::sidebar.link
                    :name="$item['name']"
                    :icon="$item['icon']"
                    :url="$item['url']"
            />
        @endforeach
    </div>
</div>
