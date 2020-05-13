@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('posts.store')}}" method="post" id="locationForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add new Advertisement</h3>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                @if ($errors->has('title'))
                                    <input type="text" name="title" id="title" class="form-control is-invalid" maxlength=100 placeholder="Appartment for rent" required>
                                    <div class="invalid-feedback">
                                        {{$errors->first('title')}}
                                    </div>
                                 @else
                                    <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control" maxlength=100 placeholder="Appartment for rent" required>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select name="country" class="form-control" id="country">
                                            <option>USA</option>
                                            <option>Russia</option>
                                            <option>Ukraine</option>
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
                                                    <input id="phone" type="tel" value="{{old('full_number')}}" class="form-control" maxlength="9" required>
                                                @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        @if ($errors->has('end_date'))
                                            <label for="end_date">End date</label>
                                            <input type='text' name='end_date' id='end_date' placeholder="YYYY-MM-DD" class="datepicker-here form-control is-invalid" data-position="right top" />
                                            <div class="invalid-feedback">
                                                {{$errors->first('end_date')}}
                                            </div>
                                        @else
                                            <label for="end_date">End date</label>
                                            <input type='text' name='end_date' id='end_date' placeholder="YYYY-MM-DD"  value="{{ old('end_date') }}" class="datepicker-here form-control" data-position="right top" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        @if ($errors->has('email'))
                                            <label for="title">Email</label>
                                            <input name="email" type="email" class="form-control is-invalid" placeholder="example@mail.com" required>
                                            <div class="invalid-feedback">
                                                {{$errors->first('email')}}
                                            </div>
                                        @else
                                            <label for="title">Email</label>
                                            <input name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="example@mail.com" required>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="description">Description</label>
                                @if ($errors->has('description'))
                                    <textarea name="description" class="form-control is-invalid" placeholder="Enter the description" required></textarea>
                                    <div class="invalid-feedback">
                                        {{$errors->first('description')}}
                                    </div>
                                @else
                                    <textarea name="description" class="form-control"  placeholder="Enter the description" required>{{ old('description') }}</textarea>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="image" value="{{ old('image') }}" class="custom-file-input" id="image" accept=".jpg, .jpeg, .png">
                                    <label class="custom-file-label" for="image">Load image</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Select the location</h3>
                            <button type="button" class="btn btn-success dropdown-toggle" id="addLocationButton" onclick="toggleMap()">@if (old('addLocation') == 'True') Don`t add location @else Add location @endif </button>
                        </div>
                        @if (old('addLocation') == 'True')
                            <div class="panel-body" id="location" style="display: block">
                                <div class="form-group">
                                    <div id="map"></div>
                                    <input type="hidden" id="la" name="latitude" value="{{old('latitude')}}">
                                    <input type="hidden" id="lo" name="longitude" value="{{old('longitude')}}">
                                    <input type="hidden" id="addLocation" name="addLocation" value="True">
                                </div>
                            </div>
                        @else
                        <div class="panel-body" id="location" style="display: none">
                            <div class="form-group">
                                <div id="map"></div>
                                <input type="hidden" id="la" name="latitude" value="47.818705">
                                <input type="hidden" id="lo" name="longitude" value="35.174291">
                                <input type="hidden" id="addLocation" name="addLocation" value="False">
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxuJt0FM7ceyYD6i5Y0XI_brWCTULYNd0&callback=initMap">
</script>
<script src="{{ URL::asset('js/intlTelInput.js') }}" defer></script>
<script src="{{ URL::asset('js/file_input.js') }}" defer></script>




@endsection
