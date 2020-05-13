@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1 class="mt-4">{{ $advertisementData[0]->title }}</h1>

                <!-- Author -->
                <p class="lead">
                    {{ $advertisementData[0]->country }}
                </p>

                <hr>

                <!-- Date/Time -->
                <p> Publication date: @php echo substr($advertisementData[0]->date_posted, 0,  10)@endphp</p>

                <hr>

                @if ($advertisementData[0]->image)
                    <img class="card-img-top" src="@php echo asset('storage/images/'.$advertisementData[0]->image); @endphp">
                @else
                    <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1280px-No_image_3x4.svg.png" alt="Card image cap">
                @endif
                <hr>
                <br>
                <h3 class="mt-4">Description:  </h3>
                <p>{{ $advertisementData[0]->description }}</p>
                <br>
                @if ($advertisementData[0]->latitude and  $advertisementData[0]->longitude)
                    <h3 class="mt-4">Location:  </h3>
                    <div id="map"></div>
                    <input type="hidden" id="la" value="{{$advertisementData[0]->latitude}}"/>
                    <input type="hidden" id="lo" value="{{$advertisementData[0]->longitude}}"/>
                @endif
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <br>
                <br>
                @guest

                @else
                    @if (auth()->user()->id == $advertisementData[0]->user_id)
                        <h4> ✏️ <a href="{{ route('posts.edit', $advertisementData[0]->id) }}">Edit </a></h4>
                @endif
            @endguest

            <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Contact Info</h5>
                    <div class="card-body">
                        <p>📞 {{$advertisementData[0]->phone}}</p>
                        <p>📧 {{$advertisementData[0]->email}}</p>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
        <br><br>

    </div>
    <!-- /.container -->



    <script src="{{ URL::asset('js/map_static.js') }}" defer></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxuJt0FM7ceyYD6i5Y0XI_brWCTULYNd0&callback=initMap">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
@endsection


