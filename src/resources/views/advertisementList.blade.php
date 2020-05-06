@extends('layouts.app')

@section('content')


    <?php

    function checkTextOverflow($text)
    {
        if (strlen($text) > 255){
            return substr($text, 0, 255).'...';
        } else {
            return $text;
        }
    }

    ?>

    <br>
    <br>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php if (count($data) != 0): ?>
            <?php foreach ($data->reverse() as $post): ?>
            <!-- Blog Post -->
                <div class="card mb-4">
                    <?php if ($post->image):?>
                    <img class="card-img-top" src="<?php echo '/images/'.$post->image; ?>">
                    <?php else: ?>
                    <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1280px-No_image_3x4.svg.png" alt="Card image cap">
                    <?php endif; ?>
                    <div class="card-body">
                        <a href="/ad/<?php echo $post->id; ?>"> <h2 class="card-title"><?php echo $post->title?></h2></a>
                        <p class="card-text"><?php echo checkTextOverflow($post->description)?></p>
                    </div>
                    <div class="card-footer text-muted">
                        Publication date:  <?php echo substr($post->date_posted, 0,  10)?>
                    </div>
                </div>
                <?php endforeach; ?>

                <ul class="pagination justify-content-center">
                    <li class="page-item @if ($current_page == '1') {{'disabled'}} @endif">
                        <a class="page-link" href="/page/<?php echo strval((int)$current_page-1); ?>">Предыдущая</a>
                    </li>
                    <?php for ($i = 1; $i < $last_page + 1; $i++): ?>
                    <li class="page-item <?php if ((int)$current_page == $i) { echo "active"; }?>">
                        <a class="page-link" href="/page/<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                    <?php endfor; ?>
                    <li class="page-item <?php if ((int)$current_page == (int)$last_page) { echo "disabled"; }?> ">
                        <a class="page-link" href="/page/<?php echo strval((int)$current_page+1); ?>">Следующая</a>
                    </li>
                </ul>



                <?php else: ?>
                <h1 class="my-4">Sorry, no resent posts:(
                    <p><a href="/createAd"><small>Add new post</small></a></p>
                </h1>

                <?php endif; ?>
            </div>



        </div>
        <!-- /.container -->


        <!-- Bootstrap core JavaScript -->
        <script src="public/assets/vendor/jquery/jquery.min.js"></script>
        <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

@endsection
