@props(['placeholder'=>'Save','class','icon'=>'icon-filter3'])
<div class="col-xs-12">
    <button type="submit" class="{{ $class ?? 'btn btn-primary px-4' }}">
        <i class="{{ $icon }}"></i> {{ __($placeholder) }}
    </button>
</div>
