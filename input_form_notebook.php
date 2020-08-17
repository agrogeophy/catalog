<!DOCTYPE html>
<html>
<head>
  <title>Catalog Agrogeophysic</title>

<!--  <link href="css/form.css" rel="stylesheet">
 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
  <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css" />
  <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css" />


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

  <!-- (Optional) Latest compiled and minified JavaScript translation files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
<!--  <link href="css/style.css" rel="stylesheet">
 -->  <link href="css/style_contrib_details.css" rel="stylesheet">

    <title>Input contribution form</title>

<style type="text/css">

#imgfixed
{
    top:20px;
    background: blue;
    position: fixed;
    width: 25%;
}

/* Style the form */
#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

</style>

</head>


<body>

<?php include("header_home_contrib.php"); ?>
<section id="about">
      <div class="container">
<!--         <div class="row">
 -->
    <h3>Add a contribution</h3>
    <form enctype="multipart/form-data" action="notification_handler.php" method="post" style="margin:5%;">

<!----------------------------------->    
<!-- Contact description  -->    
<!----------------------------------->    

 <div class="container">
        <header class="section-header">
          <h3 id="howtocontribute">Contact details</h3>
<!--           <p></p>
 -->        </header>
            <div class="form-group row required">
              <label for="surname" class="col-sm-2 col-form-label">Surname</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="e.g. John" required>
              </div>
            </div>

          <div class="form-group row required">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Snow ..." required>
            </div>
          </div>

          <div class="form-group row required">
            <label for="organisation" class="col-sm-2 col-form-label">First author organisation</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="organisation" name="organisation" placeholder="e.g. Lancaster University" required>
            </div>
          </div>

        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label">Contact Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
          </div>
        </div>
        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>
  </div>


<!----------------------------------->    
<!-- Contribution description  -->    
<!----------------------------------->    

 <div class="container">
        <header class="section-header">
          <h3 id="howtocontribute">Contribution details</h3>
<!--           <p></p>
 -->        </header>

      <div class="form-group row">
        <label for="Notebook_cat" class="col-sm-2 col-form-label">Notebook purpose</label>
        <div class="col-sm-10">
          <select class="form-control" id="Notebook_cat" name="Notebook_cat">
            <option>Establish Pedophysical relationships</option>
            <option>Data inversion</option>
            <option>Fwd model</option>
          </select>
        </div>
      </div>

          <div class="form-group row required">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="title" name="title" placeholder="My Agrogeophysical Survey" required>
            </div>
          </div>

        <div class="form-group row">
          <label for="publiDate" class="col-sm-2 col-form-label">Date</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="publiDate" name="publiDate">
          </div>
        </div>


      <div class="form-group row" enctype="multipart/form-data">
          <label for="notebook_file" class="col-sm-2 col-form-label">Notebook</label>
          <div class="col-sm-10">
            <input type="file" class="form-control-file" name="notebook_file">
          </div>
      </div>


      <div class="form-group row">
        <label for="publicationLink" class="col-sm-2 col-form-label">Notebook (DOI)</label>
        <div class="col-sm-10">
          <input type="url" class="form-control" id="NotebookDOI" name="NotebookDOI" placeholder="Enter NotebookDOI (DOI) e.g. 10.1016/j.cageo.2020.104423">
        </div>
      </div>

          <div class="form-group row required">
            <label for="authors" class="col-sm-2 col-form-label">Author(s) (comma separated)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="authors" name="authors" placeholder="e.g. J. Snow, B. Bastard, ..." required>
            </div>
          </div>

        <div class="form-group row">
          <label for="keywords" class="col-sm-2 col-form-label">Keywords (comma separated)</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="e.g. ERT, MALM">
          </div>
        </div>

      <div class="form-group row" enctype="multipart/form-data">
          <label for="keyFigure" class="col-sm-2 col-form-label">Key figure</label>
          <div class="col-sm-10">
            <input type="file" class="form-control-file" name="keyFigure">
          </div>
      </div>
        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>
  </div>


<!----------------------------------->    
<!-- Survey description  -->    
<!----------------------------------->    

 <div class="container">
        <header class="section-header">
          <h3 id="howtocontribute">Survey description</h3>
          <p>Please indicate your laboratory location for synthetic and laboratory survey</p>
        </header>

        <div class="form-group row">
          <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="longitude" name="longitude" placeholder="Longitude as decimal degree (WGS84)" step="any">
          </div>
        </div>

        <div class="form-group row">
          <label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="latitude" name="latitude" placeholder="Latitude as decimal degree (WGS84)" step="any">
          </div>
        </div>

      <div class="form-group row">
        <label for="prospectionType" class="col-sm-2 col-form-label">Prospection Type</label>
        <div class="col-sm-10">
          <select class="form-control" id="prospectionType" name="prospectionType">
            <option>ERT (DC only)</option>
            <option>ERT + TDIP</option>
            <option>EIT (ERT + SIP)</option>
            <option>ERT + MASM</option>
          </select>
        </div>
      </div>

  <!-- TODO replace by bhecklist -->

      <div class="form-group row">
        <label for="SpatialScale" class="col-sm-2 col-form-label">Spatial Scale</label>
        <div class="col-sm-10">
          <select class="form-control" id="SpatialScale" name="SpatialScale">
            <option>Field</option>
            <option>Laboratory</option>
            <option>Catchement</option>
          </select>
        </div>
      </div>

<!-- TODO replace by bhecklist -->

      <div class="form-group row">
        <label for="TemporalScale" class="col-sm-2 col-form-label">Temporal Scale</label>
        <div class="col-sm-10">
          <select class="form-control" id="TemporalScale" name="TemporalScale">
            <option>Minutes</option>
            <option>Hours</option>
            <option>Days</option>
            <option>Months</option>
            <option>Years</option>
            <option>None</option>
          </select>
        </div>
      </div>

    <div class="form-group row">
      <label for=dimension class="col-sm-2 col-form-label">Dimension</label>
      <div class="col-sm-10">
        <select class="form-control" id="dimension" name="dimension">
          <option>1D</option>
          <option>2D</option>
          <option>3D</option>
        </select>
      </div>
    </div>

        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>
<!--TODO add timelapse or not -->

</div>

<!----------------------------------->    
<!-- Processing tools description  -->    
<!----------------------------------->    

 <div class="container">
        <header class="section-header">
          <h3 id="howtocontribute">Processing tools</h3>
          <p>Please indicate your processing tools</p>
        </header>

        <div class="form-group row">
          <label for="software" class="col-sm-2 col-form-label">Software Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="software" name="software" placeholder="Enter software used">
          </div>
        </div>

        <div class="form-group row">
          <label for="licence_soft" class="col-sm-2 col-form-label">Software Licence</label>
          <div class="col-sm-10">
            <select class="form-control" id="licence_soft" name="licence_soft">
              <option>Open source</option>
              <option>Proprietary</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>
  </div>


<!----------------------------------->    
<!-- Abiotic tools description  -->    
<!----------------------------------->    

 <div class="container">
        <header class="section-header">
          <h3 id="howtocontribute">Biotic description</h3>
<!--           <p></p>
 -->        </header>

        <div class="form-group row">
          <label for="species" class="col-sm-2 col-form-label">Crop type</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="species" name="species" placeholder="e.g. Triciticum aestivum L. (Winter wheat)">
          </div>
        </div>

        <div class="form-group row">
          <label for="organ" class="col-sm-2 col-form-label">Organ studied</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="organ" name="organ" placeholder="e.g. Roots, stem">
          </div>
        </div>
        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>
</div>
<!----------------------------------->    
<!-- Abiotic tools description  -->    
<!----------------------------------->    

 <div class="container">
        <header class="section-header">
          <h3 id="howtocontribute">Abiotic description</h3>
<!--           <p></p>
 -->        </header>

    <div class="form-group row">
      <label for="soil" class="col-sm-2 col-form-label">Soil type</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="soil" name="soil" placeholder="e.g. Cambisol, clayey loam">
      </div>
    </div>

        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>
 </div>

<!----------------------------------->    
<!-- Companion dataset  -->    
<!----------------------------------->    

 <div class="container">
        <header class="section-header">
          <h3 id="howtocontribute">Companion dataset</h3>
<!--           <p></p>
 -->        </header>

        <div class="form-group row">
          <label for="dataLink" class="col-sm-2 col-form-label">Data Link (DOI)</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="dataLink" name="dataLink" placeholder="Enter data link (DOI if available) as URL. e.g.https://doi.org/10.5281/zenodo.2530059">
          </div>
        </div>

        <div class="form-group row">
          <label for="licence" class="col-sm-2 col-form-label">Data Licence</label>
          <div class="col-sm-10">
            <select class="form-control" id="licence" name="licence">
              <option>Open source</option>
              <option>Proprietary</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>
</div>

 <div class="container">
        <header class="section-header">
          <h5 id="howtocontribute">Something missing? please add a comment</h5>
<!--           <p></p>
 -->        </header>

        <div class="form-group row">
          <label for="comment" class="col-sm-2 col-form-label">Comment</label>
          <div class="col-sm-10">
            <input type="url" class="form-control" id="comment" name="comment" placeholder="Enter a comment">
          </div>
        </div>

</div>
    <button type="submit_contrib_form" class="btn btn-primary" value="Upload File">Submit</button>
  </form>
<!--     </div>
 -->  </div>


</section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!--==========================
  -- JavaScript Libraries 
  ============================-->

<!-- form
 -->

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/mobile-nav/mobile-nav.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</html>



