@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4">{{ $ad[0]->title }}</h1>

            <!-- Author -->
            <p class="lead">
                {{ $ad[0]->country }}
            </p>

            <hr>

            <!-- Date/Time -->
            <p> Publication date: @php echo substr($ad[0]->date_posted, 0,  10)@endphp</p>

            <hr>

            @if ($ad[0]->image)
                <img class="card-img-top" src="@php echo '/images/'.$ad[0]->image; @endphp">
            @else
                <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1280px-No_image_3x4.svg.png" alt="Card image cap">
            @endif
            <hr>
            <br>
            <h3 class="mt-4">Description:  </h3>
            <p>{{ $ad[0]->description }}</p>
            <br>
            @if ($ad[0]->latitude != 0 and  $ad[0]->longitude != 0)
                <h3 class="mt-4">Location:  </h3>
                <div id="map"></div>
                <input type="hidden" id="la" value="{{$ad[0]->latitude}}"/>
                <input type="hidden" id="lo" value="{{$ad[0]->longitude}}"/>
            @endif
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <br>
            <br>
            @guest

            @else
                @if (auth()->user()->id == $ad[0]->user_id)
                    <h4> ✏️ <a href="/updateAd/{{$ad[0]->id}}">Edit </a></h4>
                @endif
            @endguest

        <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Contact Info</h5>
                <div class="card-body">
                    <p>📞 {{$ad[0]->phone}}</p>
                    <p>📧 {{$ad[0]->email}}</p>
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


