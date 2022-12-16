@props(['model','route','name','id','parameters'=>[],'files'=>false])
@extends('layouts.app')
@php($model = Form::getModel())
@section('title',$name)
@push('styles')
    {{ $styles ?? '' }}
@endpush
@section('content')
    <div class="card">
        <div class="col-span-12 lg:col-span-12">
            <div id="{{ $id ?? $name.'-form' }}" class="card-body ">
                {!! Form::open(['route' => $route,'files'=>$files])!!}
                <div class="clearfix">
                    {{ $slot }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $footer ?? '' }}
@endpush
