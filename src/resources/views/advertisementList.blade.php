@extends('layouts.app')

@section('content')


    @php
    function checkTextOverflow($text)
    {
        if (strlen($text) > 255){
            return substr($text, 0, 255).'...';
        } else {
            return $text;
        }
    }
    @endphp

    <div class="container">

        <div class="row">
            <div class="col-md-8">
            @if (count($data) != 0)
                @foreach ($data->reverse() as $post)
                    <div class="card mb-4">
                        @if ($post->image)
                            <img class="card-img-top" src="@php echo '/images/'.$post->image; @endphp">
                        @else
                            <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1280px-No_image_3x4.svg.png" alt="Card image cap">
                        @endif
                            <div class="card-body">
                                <a href="/ad/{{$post->id}}"> <h2 class="card-title">{{$post->title}}</h2></a>
                                <p class="card-text">@php echo checkTextOverflow($post->description); @endphp</p>
                            </div>
                            <div class="card-footer text-muted">
                                Publication date:  @php echo substr($post->date_posted, 0,  10); @endphp
                            </div>
                    </div>

                @endforeach
                        <ul class="pagination justify-content-center">
                            <li class="page-item @if ($current_page == '1') {{'disabled'}} @endif">
                                <a class="page-link" href="/page/@php echo strval((int)$current_page-1); @endphp">Предыдущая</a>
                            </li>
                            @for ($i = 1; $i < $last_page + 1; $i++)
                                <li class="page-item @if ((int)$current_page == $i) @php echo "active"; @endphp @endif">
                                    <a class="page-link" href="/page/<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            @endfor
                            <li class="page-item @if ((int)$current_page ==  (int)$last_page) @php echo "disabled"; @endphp @endif ">
                                <a class="page-link" href="/page/@php echo strval((int)$current_page+1); @endphp">Следующая</a>
                            </li>
                        </ul>
            @else
                <h1 class="my-4">Sorry, no resent posts:(
                    <p><a href="/createAd"><small>Add new post</small></a></p>
                </h1>
            @endif
        </div>



    </div>

<script src="public/assets/vendor/jquery/jquery.min.js"></script>
<script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

@endsection
