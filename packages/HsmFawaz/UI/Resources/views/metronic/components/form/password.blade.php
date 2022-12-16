@props(['name','placeholder','class'])
@php($type ??= 'text')
<div class="mb-5">
    <label class="font-medium {{ $errors->has($name) ? 'text-theme-6' : '' }}">
        {{__($placeholder ?? '')}}
    </label>
    {!!
    Form::password($name,[
        'class'=>($errors->has($name) ? 'border-theme-6' : '').' input w-full border  mt-2 '.
        ($class ?? ''),
        'placeholder'=>__($placeholder ?? ''),
    ])
    !!}
    @error($name)
    <div class="pristine-error text-theme-6 mt-2">{{ $message }}</div>
    @enderror
</div>
<div class="mb-5">
    <label class="font-medium">  {{__(($placeholder ?? '') . " Confirmation")}} </label>
    {!!
        Form::password($name.'_confirmation',[
            'class'=>' input w-full border  mt-2 '.
            ($class ?? ''),
            'placeholder'=>__($placeholder ?? '')
        ])
    !!}
</div>