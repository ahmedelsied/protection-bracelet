@props(['name','options'=>[],'label'=>'','class' => "",'selected'=>null,'multiple'=>null,'errorName'=>null])
@php
    $errorName ??= dotted_string($name);
    $splitAttributes = explode(' ',$attributes);
    $invalidClass =$errors->has($errorName) ? 'is-invalid' : '';
    $defaultPlaceHolder = !$multiple ? __('Select :name',['name'=>$label]) : null;

   $properties = [
     'class'=>"{$invalidClass} form-control {$class}" ,
     'placeholder'=> $defaultPlaceHolder,
     ...$splitAttributes,
     'multiple'=>$multiple
    ];
@endphp
<div class="col-sm-12">
    <div class="form-group row no-gutters">
        <label
                class="col-sm-12 col-form-label text-left {{ $errors->has($errorName) ? 'text-danger' : '' }}">
            {{ $label }}
        </label>
        <div class="col-sm-12">
            {!! !$slot->isEmpty() ?  $slot : Form::select($name,$options,$selected,$properties) !!}
            @error($errorName)
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
