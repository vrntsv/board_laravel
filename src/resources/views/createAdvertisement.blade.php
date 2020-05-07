@extends('layouts.app')

@section('content')

    <br><br>
    <div class="container">
        <form action="submitAdCreation" method="post" id="locationForm" enctype="multipart/form-data">
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
                                <input type="text" name="title" id="title" class="form-control" maxlength=100 placeholder="Appartment for rent" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone: </label>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select id="country" class="form-control">
                                            <option value="ru"><img src="">Russia +7</option>
                                            <option value="ua">Ukraine +380</option>
                                            <option value="usa">USA +1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input id="phone" name="phone" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title">Country</label>
                                <input name="country" type="text" class="form-control" placeholder="Ukraine" required>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="end_date">End date</label>
                                        <input type='text' name='end_date' id='end_date' class="datepicker-here form-control" data-position="right top" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="title">Email</label>
                                        <input name="email" type="email" class="form-control" placeholder="example@mail.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter the description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Load image</label>
                                <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
                            </div>

                        </div>
                    </div>

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
                        <br>
                        <button class="btn btn-primary">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script src="{{ URL::asset('js/jquery.js') }}" defer></script>
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}" defer></script>
<script src="{{ URL::asset('js/masked_number_input.js') }}" defer></script>
<script src="{{ URL::asset('js/map_input.js') }}" defer></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxuJt0FM7ceyYD6i5Y0XI_brWCTULYNd0&callback=initMap">
</script>




@endsection
