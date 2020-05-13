@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/intlTelInput.css') }}" rel="stylesheet">

    <br><br>
    <div class="container">
        <form action="{{route('posts.update', $advertisementData[0]->id)}}" method="post" id="locationForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="row">
                <div class="col">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add new Advertisement</h3>
                        </div>
                        <input type="hidden" name="ad_id" value="{{$advertisementData[0]->id}}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                @if ($errors->has('title'))
                                    <input type="text" value="{{$advertisementData[0]->title}}" name="title" id="title" class="form-control is-invalid" maxlength=100 placeholder="Appartment for rent" required>
                                    <div class="invalid-feedback">
                                        {{$errors->first('title')}}
                                    </div>
                                @else
                                    <input type="text" value="{{$advertisementData[0]->title}}" name="title" id="title" class="form-control" maxlength=100 placeholder="Appartment for rent" required>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col">

                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select name="country" class="form-control" id="country">
                                            @if ($advertisementData[0]->country == 'Russia')
                                                <option selected>Russia</option>
                                            @else
                                                <option >Russia</option>
                                            @endif
                                            @if ($advertisementData[0]->country == 'Ukraine')
                                                <option selected>Ukraine</option>
                                            @else
                                                <option >Ukraine</option>
                                            @endif
                                            @if ($advertisementData[0]->country == 'USA')
                                                <option selected>USA</option>
                                            @else
                                                <option >USA</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="col">
                                    <label for="phone">Phone</label>
                                    <div class="form-group">
                                        @if ($errors->has('phone'))
                                            <input id="phone" type="tel" class="form-control is-invalid" maxlength="9"  required>
                                            <div class="invalid-feedback">
                                                {{$errors->first('phone')}}
                                            </div>
                                        @else
                                            <input id="phone" value="{{$advertisementData[0]->phone}}" type="tel" class="form-control" maxlength="9" required>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">

                                    <div class="form-group">

                                        <label for="end_date">End date</label>
                                        @if ($errors->has('end_date'))
                                            <input type='text' name='end_date' placeholder="YYYY-MM-DD" value="@php echo substr($advertisementData[0]->end_date, 0, 10); @endphp" id='end_date' class="datepicker-here form-control is-invalid" data-position="right top" />
                                            <div class="invalid-feedback">
                                                {{$errors->first('end_date')}}
                                            </div>
                                        @else
                                            <input type='text' name='end_date' placeholder="YYYY-MM-DD" value="@php echo substr($advertisementData[0]->end_date, 0, 10); @endphp" id='end_date' class="datepicker-here form-control" data-position="right top" />
                                        @endif
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="title">Email</label>
                                        @if ($errors->has('email'))
                                            <input name="email" type="email" value="{{$advertisementData[0]->email}}" class="form-control is-invalid" placeholder="example@mail.com" required>
                                            <div class="invalid-feedback">
                                                {{$errors->first('email')}}
                                            </div>
                                        @else
                                            <input name="email" type="email" value="{{$advertisementData[0]->email}}" class="form-control" placeholder="example@mail.com" required>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="description">Description</label>
                                @if ($errors->has('description'))
                                    <textarea name="description" class="form-control is-invalid" placeholder="Enter the description" required>{{$advertisementData[0]->description}}</textarea>
                                    <div class="invalid-feedback">
                                        {{$errors->first('description')}}
                                    </div>
                                @else
                                    <textarea name="description" class="form-control" placeholder="Enter the description" required>{{$advertisementData[0]->description}}</textarea>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    @if ($advertisementData[0]->image != null)
                                        <input type="hidden" name="saved_image"  value="{{$advertisementData[0]->image}}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" name="delete_image"  value="True">   Delete image
                                            </div>
                                        </div>
                                    @endif
                                    @if ($errors->has('image'))
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input is-invalid" id="image" accept=".jpg, .jpeg, .png">
                                            <label class="custom-file-label" for="image">Load new image</label>
                                            <div class="invalid-feedback">
                                                {{$errors->first('description')}}
                                            </div>
                                        </div>
                                    @else
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image" accept=".jpg, .jpeg, .png">
                                            <label class="custom-file-label" for="image">Load new image</label>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    @if ($advertisementData[0]->latitude == null and $advertisementData[0]->longitude == null)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the location</h3>
                                <button type="button" class="btn btn-success dropdown-toggle" id="addLocationButton" onclick="toggleMap()"> Add location </button>
                            </div>
                            <div class="panel-body" id="location" style="display: none">
                                <div class="form-group">
                                    <div id="map"></div>
                                    <input type="hidden" id="la" name="latitude" value="47.818705">
                                    <input type="hidden" id="lo" name="longitude" value="35.174291">
                                    <input type="hidden" id="addLocation" name="addLocation" value="False">
                                </div>
                            </div>
                            @else
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Select the location</h3>
                                        <button type="button" class="btn btn-success dropdown-toggle" id="addLocationButton" onclick="toggleMap()"> Don`t add location </button>
                                    </div>
                                    <div class="panel-body" id="location" style="display: block">
                                        <div class="form-group">
                                            <div id="map"></div>
                                            <input type="hidden" id="la" name="latitude" value="{{$advertisementData[0]->latitude}}">
                                            <input type="hidden" id="lo" name="longitude" value="{{$advertisementData[0]->longitude}}">
                                            <input type="hidden" id="addLocation" name="addLocation" value="True">
                                        </div>
                                    </div>
                                    @endif
                                    <br>
                                    <button class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                        </div>
                </div>
        </form>
    </div>

<script src="{{ URL::asset('js/map_input.js') }}" defer></script>
<script src="{{ URL::asset('js/intlTelInput.js') }}" defer></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxuJt0FM7ceyYD6i5Y0XI_brWCTULYNd0&callback=initMap">
</script>
<script src="{{ URL::asset('js/file_input.js') }}" defer></script>

<script src="{{ asset('js/datepicker/dist/js/datepicker.js') }}" defer></script>
<link href="{{ asset('js/datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">

@endsection
