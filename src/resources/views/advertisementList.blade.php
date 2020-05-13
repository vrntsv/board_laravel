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

        <div class="album py-5">
            <div class="container">
                @if (count($data) != 0)

                    <div class="row">
                        @foreach ($data as $post)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    @if ($post->image)
                                        <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="@php echo asset('storage/images/'.$post->image); @endphp">
                                    @else
                                        <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1280px-No_image_3x4.svg.png" alt="Card image cap">
                                    @endif
                                    <div class="card-body" style="height: 300px">
                                        <a href="{{ route('posts.show', $post->id) }}"> <h2 class="card-title">{{$post->title}}</h2></a>
                                        <p class="card-text">@php echo checkTextOverflow($post->description); @endphp</p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <small class="text-muted">Publication date: @php echo substr($post->date_posted, 0,  10); @endphp</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                        <ul class="pagination justify-content-center">
                            <li class="page-item @if ($data->currentPage() == 1) {{'disabled'}} @endif">
                                <a class="page-link" href="{{$data->previousPageUrl()}}">Предыдущая</a>
                            </li>
                            @for ($i = 1; $i < $last_page + 1; $i++)
                                <li class="page-item @if ($data->currentPage() == $i) @php echo "active"; @endphp @endif">
                                    <a class="page-link" href="{{$data->url($i)}}">@php echo $i; @endphp</a>
                                </li>
                            @endfor
                            <li class="page-item @if ($data->currentPage() == $data->lastPage()) @php echo "disabled"; @endphp @endif ">
                                <a class="page-link" href="{{$data->nextPageUrl()}}">Следующая</a>
                            </li>
                        </ul>
                    @else
                        <h1 class="my-4">Sorry, no resent posts:(
                            <p><a href="{{route('posts.create')}}"><small>Add new post</small></a></p>
                        </h1>
                    @endif
            </div>
        </div>



@endsection
