@props(['name','label','value'=>null])
<div class="row">
    <div class="col-12 col-md-6">
        <x-ui::form.input :name="$name.'[ar]'"
                      {{ $attributes }} :label="__ (':label Ar',['label'=>$label])"
                      :value="data_get($value,'ar') ?? locale_field($name)" {{$attributes}} />
    </div>
    <div class="col-12 col-md-6">
        <x-ui::form.input :name="$name.'[en]'"
                      {{ $attributes }} :label="__ (':label En',['label'=>$label])"
                      :value="data_get($value,'en') ?? locale_field($name,'en')" {{$attributes}}/>
    </div>
</div>
