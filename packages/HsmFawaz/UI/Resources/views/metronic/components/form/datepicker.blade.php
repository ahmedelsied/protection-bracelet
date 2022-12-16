@props(['name'=>'','value'=>null,'label'=>'','class'=>'','format'=>'Y-m-d'])
@php
    $splitAttributes = explode(' ',$attributes);
    $invalidClass =$errors->has(dotted_string($name)) ? 'is-invalid' : '';
    $properties = [
    'class'=>"{$invalidClass} form-control {$class}" ,
         'placeholder'=>__($label ?? ''),
         'data-format'=>$format,
         ...$splitAttributes
     ];

@endphp
<div class="col-sm-12">
    <div class="form-group row no-gutters">
        <label
            class="col-sm-12 col-form-label text-left  {{ $errors->has($name) ? 'text-danger' : '' }}">
            {{__($label ?? '')}}
        </label>
        <div class="col-sm-12">
            {!! Form::date($name,$value ?: null,$properties) !!}
            @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
