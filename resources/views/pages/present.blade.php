@extends('layouts.app')
@push('title',$present->name)
@section('content')
    <div class="container">
        <h2><a href="{{url('/')}}"><i class="fa fa-home"></i></a> Main Slider <i>{{$present->name}}</i></h2>
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
                    <select id="inputColor" class="form-control color-main-slide" name="color"
                            style="background-color: {{$present->mainSlide->color}}">
                        <option value="" selected disabled></option>
                        @foreach($colors as $color)
                            <option value="{{$color->code}}"
                                    style="background-color: {{$color->code}}"
                                    @if ($present->mainSlide->color === $color->code) selected @endif>{{$color->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputBackgroundColor">Background Color</label>
                    <select id="inputBackgroundColor" class="form-control color-main-slide" name="background"
                            style="background-color: {{$present->mainSlide->background}}">
                        <option value="" selected disabled></option>
                        @foreach($colors as $color)
                            <option value="{{$color->code}}"
                                    style="background-color: {{$color->code}}"
                                    @if ($present->mainSlide->background === $color->code) selected @endif>{{$color->name}}</option>
                        @endforeach
                    </select>
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
        <div class="col-12">
            <button class="btn btn-primary">New Head Line</button>
        </div>
    </div>
@endsection
