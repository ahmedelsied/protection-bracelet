@props(['id'=>'','name', 'value'=>1, 'label'=>'', 'class'=>'','checked'=>true ])
@php
    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
    $splitAttributes = explode(' ',$attributes);
    $id = 'toggle_'.dotted_string($name)."_".$id;
    $properties = [
    'class'=>"{$invalidClass} custom-control-input {$class}" ,
    ...$splitAttributes,
    'id'=>$id
    ];
@endphp
<div class="d-flex">
    <label for="{{ $id }}"
           class="mr-4 cursor-pointer text-left {{ $errors->has(dotted_string($name)) ? 'text-danger' : '' }}">
        {{ $label }}
    </label>
    <div
            class="custom-control custom-switch custom-switch-square custom-control-secondary mb-2">
        <input type="hidden" name="{{ $name }}" value="0">
        {!! Form::checkbox($name,$value,$checked,$properties) !!}
        <label for="{{ $id }}"
               class="custom-control-label"></label>
        @error(dotted_string($name))
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>
