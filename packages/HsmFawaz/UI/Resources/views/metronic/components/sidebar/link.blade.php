@props(['name','icon'=>'','url'])
<div class="menu-item">
    <a class="menu-link @if(request()->fullUrl() === $url) active @endif" href="{{ $url }}">
        @if(filled($icon))
            <span class="menu-bullet">
            <span class="{{ $icon }}"></span>
        </span>
        @endif
        <span class="menu-title">{{ $name }}</span>
    </a>
</div>