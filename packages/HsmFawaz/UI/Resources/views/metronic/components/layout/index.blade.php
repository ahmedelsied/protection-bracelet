@extends('ui::layout.master')
@props(['title'=>'','breadcrumbs'=>[]])
@section('title',$title)
@section('breadcrumbs')
    @foreach($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item @if($loop->last) text-dark  @else text-muted @endif">
            {{ $breadcrumb }}
        </li>
        @if(!$loop->last)
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
        @endif
    @endforeach
@endsection
@section('actions',$actions ?? '')
@section('content')
    {{ $slot }}
@endsection
@push('header')
    {{ $header ?? '' }}
@endpush
@push('scripts')
    {{ $scripts ?? '' }}
@endpush