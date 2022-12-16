@props(['route','name','id','parameters'=>[],'readOnly'=>false,'files'=>false,'breadcrumbs'=>null])
@php
    $routesList = is_array($route) ? $route : null;
    $model = Form::getModel();
    $title = $model ? __("Edit :name",['name'=>$name]) : __('Create :name',['name'=>$name]);
@endphp
<x-ui::layout :title="$title" :breadcrumbs="$breadcrumbs">
    {{ $prepend ?? '' }}

    <div class="card">
        <div id="{{ $id ?? $name.'-form' }}" class=" card-body ">
            @if($model)
                {!! Form::model(
                $model,
                    [
                        'id'=>'crud-modal-form',
                        'route' => $routesList['update'] ?? [$route.'.update', $model->{$model->getKeyName()}],
                        'method'=>'PUT',
                        'files'=>$files
                    ]
                 )!!}
            @else
                {!!
                    Form::open([ 'id'=>'crud-modal-form','route' => $routesList['create']?? $route.'.store', 'files'=>$files])
                !!}
            @endif
            <div class="">
                {{ $slot }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    {{ $append ?? '' }}

    <x-slot:actions>
        @isset($actions)
            {{ $actions }}
        @else
            @if(!$readOnly)
                <button form="crud-modal-form" type="submit" class="btn btn-success mx-2 px-5">
                    <i class="fa fa-save"></i> {{ __('Save Data') }}
                </button>
            @endif
            {{ $betweenActions ?? '' }}
            <a href="{{ route($routesList['index'] ?? $route.'.index',$parameters)}}"
               class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> {{ __('Go Back') }}
            </a>
        @endif
    </x-slot:actions>
    <x-slot:header>
        {{ $header ?? '' }}
    </x-slot:header>
    <x-slot:scripts>
        {{ $scripts ?? '' }}
    </x-slot:scripts>
</x-ui::layout>
