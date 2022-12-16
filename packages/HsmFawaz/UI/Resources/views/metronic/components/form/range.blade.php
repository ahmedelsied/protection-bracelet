@props(['name','label'])
@php($from = optional(Form::getModel())->{$name}->from ?? old("{$name}.from"))
@php($to = optional(Form::getModel())->{$name}->to ?? old("{$name}.to"))
<div class="row">
    <div class="col-12 col-md-6">
        <x-ui::form.input :name="$name.'[from]'"
                      {{ $attributes }} :label="__ (':label From',['label'=>$label])"
                      :value="$from"/>
    </div>
    <div class="col-12 col-md-6">
        <x-ui::form.input :name="$name.'[to]'"
                      {{ $attributes }} :label="__ (':label To',['label'=>$label])"
                      :value="$to"/>
    </div>
</div>
