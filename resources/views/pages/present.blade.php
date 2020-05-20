@extends('layouts.app')
@push('title',$present->name)
@section('content')
    <div class="container">
        <input type="hidden" id="present_id" value="{{$present->id}}">
        <input type="hidden" id="main_slide_id_id" value="{{$present->mainSlide->id}}">
        <h2><a href="{{url('/')}}"><i class="material-icons">home</i></a> Main Slider <i>{{$present->name}}</i></h2>
        <a href="{{url("/present/{$present->url}")}}" target="_blank"><i class="material-icons">&#xe417;</i></a>
        <hr>
        <form id="main-slider-form">
            <div class="form-group">
                <label for="inputAddress">Slider Name</label>
                <input type="text" value="{{$present->mainSlide->main_name}}" name="main_name" class="form-control"
                       id="inputAddress">
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputName">@lang('front.topic')</label>
                    <input type="text" class="form-control" id="inputName" name="topic"
                           value="{{$present->mainSlide->topic}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputStudent">@lang('front.student')</label>
                    <input type="text" id="inputStudent" class="form-control" name="student"
                           value="{{$present->mainSlide->student}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputHead">@lang('front.head')</label>
                    <input type="text" class="form-control" id="inputHead" name="head"
                           value="{{$present->mainSlide->head}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputLogoUrl">University URL</label>
                    <input type="url" class="form-control" id="inputLogoUrl" name="logo_url"
                           value="{{$present->mainSlide->logo_url}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputColor">Color</label>
                    <input type="color" id="inputColor" class="form-control" name="color"
                           value="{{$present->mainSlide->color}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputBackgroundColor">Background Color</label>
                    <input type="color" id="inputBackgroundColor" class="form-control" name="background"
                           value="{{$present->mainSlide->background}}">
                </div>
            </div>
            <div class="form-row update-main-slide-images">
                <div class="form-group col-md-2">
                </div>
                <label class="form-group col-md-4" for="main_logo">
                    <img src="{{asset('/uploads/logo/'.$present->mainSlide->logo)}}" alt="logo-university">
                </label>
                <label class="form-group col-md-4" for="main_present_logo">
                    <img src="{{asset('/uploads/present_logo/'.$present->mainSlide->present_logo)}}"
                         alt="logo-present">
                </label>
                <input type="file" id="main_logo" hidden accept=".jpg, .jpeg, .png">
                <input type="file" id="main_present_logo" hidden accept=".jpg, .jpeg, .png">
            </div>

            <button type="button" class="btn btn-primary save-main-slide">Save</button>
        </form>
        <hr>
        <div class="col-12 mb-4">
            <button class="btn btn-primary add-new-sub-content">New Head Line</button>
        </div>
        <div class="sortable">
            @foreach ($orders as $order)
                <div class="card mt-2 main-div-content-sub" data-id="{{$order->subheadings->id}}">
                    <div class="card-body">
                        <h5 class="card-title text_header">{{$order->subheadings->text_header}}</h5>
                        <a class="update-head-line"><i class="material-icons">mode_edit</i></a>
                        @if (!empty(current($order->subheadings->many)))
                            <a href="{{url("/setting/{$present->id}/{$order->subheadings->id}")}}" class="ml-4"><i
                                    class="material-icons">@if(count(current($order->subheadings->many))>9)
                                        filter_9_plus @else
                                        filter_{{count(current($order->subheadings->many))}} @endif</i></a>
                        @else
                            <i class="material-icons ml-4">filter</i>
                        @endif
                        <a class="ml-4 icon-delete delete-present-sub"><i class="material-icons">delete_forever</i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
