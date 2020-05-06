<!DOCTYPE html>


<br><br>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4"><?php echo $data[0]['title']; ?></h1>

            <!-- Author -->
            <p class="lead">
                <?php echo $data[0]['country']; ?>
            </p>

            <hr>

            <!-- Date/Time -->
            <p> Publication date: <?php echo substr($data[0]['date_posted'], 0,  10)?></p>

            <hr>

            <?php if ($data[0]['image']):?>
            <img class="card-img-top" src="<?php echo '/images/'.$data[0]['image']; ?>">
            <?php else: ?>
            <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1280px-No_image_3x4.svg.png" alt="Card image cap">
            <?php endif; ?>
            <hr>
            <br>
            <h3 class="mt-4">Description:  </h3>
            <p><?php echo $data[0]['description'] ?></p>
            <br>
            <?php if ($data[0]['latitude'] != 0 and  $data[0]['longitude'] != 0): ?>
            <h3 class="mt-4">Location:  </h3>
            <div id="map"></div>
            <input type="hidden" id="la" value="<?php echo $data[0]['latitude']; ?>"/>
            <input type="hidden" id="lo" value="<?php echo $data[0]['longitude']; ?>"/>
            <?php endif; ?>
        </div>


        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <br>
            <br>
            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Contact Info</h5>
                <div class="card-body">
                    <p>📞 <?php echo $data[0]['phone']; ?></p>
                    <p>📧 <?php echo $data[0]['email']; ?></p>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
    <br><br>

</div>
<!-- /.container -->



<script src="{{ URL::asset('js/map_static.js') }}" defer></script>

<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxuJt0FM7ceyYD6i5Y0XI_brWCTULYNd0&callback=initMap">
</script>
<!-- Bootstrap core JavaScript -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>


</html>
