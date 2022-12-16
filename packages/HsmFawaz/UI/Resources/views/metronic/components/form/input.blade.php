@props([ 'name', 'type'=>'text', 'value'=>null, 'label'=>'', 'class'=>'', ])
@php
    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
    $splitAttributes = explode(' ',$attributes);
    $defaultPlaceHolder = __('Enter :name',['name'=>$label]);
    $properties = [
    'class'=>"{$invalidClass} form-control {$class}" ,
    'placeholder'=> $defaultPlaceHolder,
    ...$splitAttributes,
    ];
@endphp
<div class="col-sm-12">
    <div class="form-group row no-gutters">
        <label
            class="col-sm-12 col-form-label text-left {{ $errors->has(dotted_string($name)) ? 'text-danger' : '' }}">
            {{ $label }}
        </label>
        <div class="col-sm-12">
            @if(!in_array($type,['file','password']))
                {!! Form::$type($name,$value,$properties) !!}
            @else
                {!! Form::$type($name,$properties) !!}
            @endif
            {{ $slot }}
            @error(dotted_string($name))
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
