<!DOCTYPE html>
<html>
<head>
	<title>Catalog Agrogeophysic</title>

<!-- 	<link href="css/form.css" rel="stylesheet">
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
<!-- 	<link href="css/style.css" rel="stylesheet">
 -->  <link href="css/style_contrib_details.css" rel="stylesheet">

<!-- # https://api.altmetric.com/embeds.html -->
<script type='text/javascript' src='https://d1bxh8uas1mnw7.cloudfront.net/assets/embed.js'></script>

</head>

<style type="text/css">

#imgfixed
{
    top:20px;
    background: blue;
    position: fixed;
    width: 25%;
}

</style>


<body>

<?php include("header_home_contrib.php"); ?>

<?php
# Connect to MySQL database
include("dbb/connect_db.php");


// $select = $conn->prepare('SELECT * FROM main_l1 WHERE id = ?');
// $select->execute(array($_GET['idnb'])) 

    // $sql_main_joint_idnb='
    // SELECT main.*,
    //        contact.*,
    //        prospection.*, prospection.lat AS x, prospection.longitude AS y,
    //        processing.*
    //        FROM main
    //        JOIN contact ON (main.id = contact.id_contact_l2)
    //        JOIN processing ON (main.id = processing.id_processing_l2)
    //        JOIN prospection ON (main.id = prospection.id_prospection_l2)
    //        AND main.id = ?';

    // $sql_main_joint_idnb='
    // SELECT main.*,
    //        contact.*,
    //        prospection.*, prospection.lat AS x, prospection.longitude AS y,
    //        processing.*
    //        FROM main
    //        LEFT JOIN contact ON (main.id = contact.id_contact_l2)
    //        LEFT JOIN processing ON (main.id = processing.id_processing_l2)
    //        LEFT JOIN prospection ON (main.id = prospection.id_prospection_l2)
    //        AND main.id = ?';

    $sql_main_joint_idnb='
    SELECT main.*,
           contact.*,
           prospection.*, prospection.lat AS x, prospection.longitude AS y,
           processing.*,
           biotic.*,
           abiotic.*
           FROM main
           LEFT JOIN contact ON (main.id_FK_contact = contact.id_contact_l2)
           LEFT JOIN processing ON (main.id_FK_processing = processing.id_processing_l2)
           LEFT JOIN prospection ON (main.id_FK_prospection = prospection.id_prospection_l2)
           LEFT JOIN biotic ON (main.id_FK_biotic = biotic.id_biotic_l2)
           LEFT JOIN abiotic ON (main.id_FK_abiotic = abiotic.id_abiotic_l2)
           WHERE main.id = ?';





// SELECT main_l1.*, 
//        contact_l2.*, 
//        prospection_l2.*, prospection_l2.lat AS x, prospection_l2.longitude AS y,
//        processing_tools_l2.*
//        FROM main_l1 
//        INNER JOIN contact_l2 ON (main_l1.id = contact_l2.id_contact_l2)
//        INNER JOIN prospection_l2 ON (main_l1.id = prospection_l2.id_prosp_l2)
//        INNER JOIN processing_tools_l2 ON (main_l1.id = processing_tools_l2.id_proc_l2) 
//        AND main_l1.id = ?';

$select = $conn->prepare($sql_main_joint_idnb);
$select->execute(array($_GET['idnb']));

// echo $sql_main_joint_idnb;

?>

<?php
	$overview = $select->fetch(PDO::FETCH_ASSOC);

    // echo var_dump($overview) ;

?>

<!------------------------------------- DISPLAY Scientif comm CONTRIB ------------------------------------ -->
<?php
// if  ($overview['contrib_type']=='Scientific communication' || $overview['contrib_type']== 'Dataset' )
if  ($overview['contrib_type']=='Research article'|| $overview['contrib_type']== 'Book')

// if (true) {in_array($overview['contrib_type'], ['Scientific communication','dataset'], true )
    {
?>
    <section id="about">
          <div class="container">
            <div class="row">

              <div class="col-lg-5 col-md-6" >
                       <div class="sticky-top">


                  <?php

                  if ($overview['icon_img']='N.C.')
                  {
                                  // echo  '****************************************';

                    echo '<div class="about-img"><p><img src="dbb/SC_icons/Eco_leaves_nature-512.png" width="40"><p></div>';
                  }
                  else
                  {
                  // echo  '****************************************';
                  // echo  var_dump($overview['icon_img']);
                  // echo '<div class="about-img"><p><img src="dbb/SC_icons/Eco_leaves_nature-512.png" width="40"><p></div>';
                  echo '<div class="caption"><h3><img src="dbb/SC_icons/'.$overview['icon_img'].'" width="400"></h3></div>';
                  // echo '<div class="caption"><h3><img src="img/map/Eco_leaves_nature-512.png" width="40"></h3></div>';

                  }
                  ?>
                  <h1>
                  <?php echo $overview['contrib_title']; ?>
                 </h1>
                      </div>

             </div>


              <div class="col-lg-7 col-md-6">
                <div class="about-content">

                 <h2>Metrics</h2>

                <?php
                // echo $overview['DOI'];
                echo '<div class="altmetric-embed" data-badge-type="donut" data-doi="'.$overview['DOI'].'"></div>'
                ?>

<!--                 <div class='altmetric-embed' data-badge-type='donut' data-doi="10.1038/nature.2012.9872"></div>
 -->


                 <h2>Contribution overview</h2>
                      <ul class="list-group">

                <?php
                              
                        // echo '<h6>Type</h6>';
                        if (!empty($overview['contrib_type']))
                              {
                                echo  '<li class="list-group-item"><b>Type:</b> '.$overview['contrib_type'].'</li>';
                              }
                                           
                        // echo '<h6>Keywords</h6>';
                        if (!empty($overview['keywords']))
                              {
                                echo '<li class="list-group-item"><b>Keywords: </b> '.$overview['keywords'].'</li>';
                              }
                        // echo '<p><h4>DOI</h6>';
                        if (!empty($overview['DOI']))
                              {
                                // echo '<li class="list-group-item"><b>DOI: </b> '.$overview['DOI_proc_tools'].'</li>';
                                echo '<li class="list-group-item"><a href="https://dx.doi.org/'.$overview['DOI'].'"  target="_blank"><b>Link to publication</b></a></li>';
                               }
                               


                ?>

                    </ul>
                 <h2>Prospection</h2>
                      <ul class="list-group">


                <?php

                        // echo '<h6>Date</h6>';
                        if (!empty($overview['datep']))
                              {
                                echo '<li class="list-group-item"><b>Date: </b> '.$overview['datep'].'</li>';
                              }
                        // echo '<h6>lat/long</h6>';
                        if (!empty($overview['lat']))
                              {
                                echo '<li class="list-group-item"><b>Lat/long: </b> '.$overview['lat']." ; " . $overview['longitude'].' </li>';
                                // echo $myName . " " . $myAge

                              }
                        // echo '<h6>method</h6>';
                        if (!empty($overview['method']))
                              {
                                echo '<li class="list-group-item"><b>Method(s): </b> '.$overview['method'].'</li>';
                              }

                        // echo '<h6>scale</h6>';
                        if (!empty($overview['scale']))
                              {
                                echo '<li class="list-group-item"><b>Scale: </b> '.$overview['scale'].'</li>';
                              }

                        // echo '<h6>instrument</h6>';
                        if (!empty($overview['instrument']))
                              {
                                echo '<li class="list-group-item"><b>Instrument: </b> '.$overview['instrument'].'</li>';
                              }

                        // echo '<h6>dimension</h6>';
                        if (!empty($overview['dimension']))
                              {
                                echo '<li class="list-group-item"><b>Dimension: </b> '.$overview['dimension'].'</li>';
                              }

                        // echo '<h6>permanent_setup</h6>';
                        if (!empty($overview['permanent_setup']))
                              {
                                echo '<li class="list-group-item"><b>Permanent setup: </b> '.$overview['permanent_setup'].'</li>';
                              }

                                          ?>
                    </ul>

               <h2>Processing tools</h2>
                      <ul class="list-group">

                <?php

                        // echo '<h6>Software</h6>';
                        if (!empty($overview['software_name']))
                              {
                                echo '<li class="list-group-item"><b>Software: </b> '.$overview['software_name'].'</li>';
                              }
                        // echo '<p><h4>Licence</h6>';
                        if (!empty($overview['licence_type']))
                              {
                                echo '<li class="list-group-item"><b>Licence type: </b> '.$overview['licence_type'].'</li>';
                              }
                        // echo '<p><h4>DOI</h6>';
                        if (!empty($overview['DOI_proc_tools']))
                              {
                                echo '<li class="list-group-item"><b>DOI: </b> '.$overview['DOI_proc_tools'].'</li>';
                               }
               ?>

                    </ul>

                 <h2>Biotic</h2>
                      <ul class="list-group">

                <?php
                        // id_species
                        if (!empty($overview['species']))
                              {
                                echo '<li class="list-group-item"><b>Species: </b> '.$overview['species'].'</li>';
                              }
                        // id_species
                        if (!empty($overview['organ']))
                              {
                                echo '<li class="list-group-item"><b>Organ: </b> '.$overview['organ'].'</li>';
                              }

                ?>
                    </ul>

                 <h2>Abiotic description</h2>
                      <ul class="list-group">

                <?php
                        // id_species
                        if (!empty($overview['soil_type']))
                              {
                                echo '<li class="list-group-item"><b>Soil type: </b> '.$overview['soil_type'].'</li>';
                              }
                        // id_species
                        if (!empty($overview['water_input']))
                              {
                                echo '<li class="list-group-item"><b>Water input: </b> '.$overview['water_input'].'</li>';
                              }

                ?>
                    </ul>

                 <h2>Contact description</h2>
                      <ul class="list-group">

                <?php

                
                        if (!empty($overview['contrib_authors']))
                              {
                                echo '<li class="list-group-item"><b>Contrib. Authors: </b> '.$overview['contrib_authors'].'</li>';
                              }

                        if (!empty($overview['name']))
                              {
                                echo '<li class="list-group-item"><b>1st. Author: </b> '.$overview['surname'].' '.$overview['name'].'</li>';
                              }
                        if (!empty($overview['email']))
                              {
                                echo '<li class="list-group-item"><b>Email: </b> '.$overview['email'].'</li>';
                                // echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=About your contribution nb '.$_GET['idnb'].'><b>Contact the author</b></a></li>';
                                echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=><b>Contact the author</b></a></li>';
                              }

                ?>
                <p>
    <!--                  <a href="" target="_blank" class="btn btn-primary">Report an error</a>
     -->
            <h4><a href="mailto:benjamin.mary@unipd.it?subject=error dbb Agrogeophysic" class="btn btn-primary"> Report an error </a></h4>    
            </p>

            </div>
          </div>
        </div>
      </div>

    </section><!-- #about -->
 <?php              
  }
?>

<!------------------------------------- MODEL CONTRIB ------------------------------------ -->
<?php
if  ($overview['contrib_type']=='Notebook')
    {
?>
    <section id="about">
          <div class="container">
            <div class="row">
              <div class="col-lg-5 col-md-6" >
                <div class="sticky-top">
                  <h2>Contribution overview</h2>
                      <ul class="list-group">

                <?php
                              
                        // echo '<h6>Type</h6>';
                        if (!empty($overview['contrib_type']))
                              {
                                echo  '<li class="list-group-item"><b>Type:</b> '.$overview['contrib_type'].'</li>';
                              }
                                           
                        // echo '<h6>Keywords</h6>';
                        if (!empty($overview['method']))
                              {
                                echo '<li class="list-group-item"><b>Keywords: </b> '.$overview['keywords'].'</li>';
                              }
                        // echo '<p><h4>DOI</h6>';
                        if (!empty($overview['DOI']))
                              {
                                // echo '<li class="list-group-item"><b>DOI: </b> '.$overview['DOI_proc_tools'].'</li>';
                                echo '<li class="list-group-item"><a href="https://dx.doi.org/'.$overview['DOI'].'"  target="_blank"><b>Link to publication</b></a></li>';
                               }

                ?>

                    </ul>
                  <?php
                    if (!empty($overview['notebook_file']))
                          {
                           echo '<h4><a href=https://mybinder.org/v2/gh/BenjMy/agrogeophy-notebooks.git/master?filepath=.%2Fnotebooks%2F'.$overview['notebook_file'].'.ipynb class="btn btn-primary" target="_blank"> Try model in binder </a></h4>';
                           include('./dbb/M_models/agrogeophy-notebooks/html/'.$overview['notebook_file'].'.html');
                          }
                    else
                          {
                           // echo $overview['notebook_file'];
                           echo '<h4><a href=https://mybinder.org/v2/gh/BenjMy/agrogeophy-notebooks.git/master?filepath=.%2Fnotebooks%2FLorenz.ipynb class="btn btn-primary" target="_blank"> Try model in binder </a></h4>';
                           include('./dbb/M_models/agrogeophy-notebooks/html/Lorenz.html');

                          }

                  ?>
                </div>
            </div>
          </div>
          <h2>Contact description</h2>
            <ul class="list-group">

            <?php
                    // id_species
                    if (!empty($overview['name']))
                          {
                            echo '<li class="list-group-item"><b>Contrib. Author: </b> '.$overview['surname'].' '.$overview['name'].'</li>';
                          }
                    // id_species
                    if (!empty($overview['email']))
                          {
                            echo '<li class="list-group-item"><b>Email: </b> '.$overview['email'].'</li>';
                            // echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=About your contribution nb '.$_GET['idnb'].'><b>Contact the author</b></a></li>';
                            echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=><b>Contact the author</b></a></li>';
                          }

            ?>
        <p>
        <h4><a href="mailto:benjamin.mary@unipd.it?subject=error dbb Agrogeophysic" class="btn btn-primary"> Report an error </a></h4>    
        </p>
        </div>
    </section><!-- #about -->

<?php
    }
?>


<!------------------------------------- DATASET CONTRIB ------------------------------------ -->
<?php
if  ($overview['contrib_type']=='Dataset')
    {
?>
    <section id="about">
          <div class="container">
            <div class="row">

<!--               <div class="col-lg-5 col-md-6" >
 -->                <div class="sticky-top">
                        <ul class="list-group">

                           <h1>
                            <?php echo $overview['contrib_title']; ?>
                           </h1>
                        </ul>
                        <ul class="list-group">
                         <?php
                          if (!empty($overview['DOI']))
                                {
                                  

                                 echo '<h4><a href='.$overview['DOI'].' class="btn btn-primary" target="_blank"> Link to data repo or code to reproduce dataset </a></h4>';
                                 // include('./dbb/M_models/agrogeophy-notebooks/html/'.$overview['notebook_file'].'.html');
                                }
                          else
                                {
                                 // echo $overview['notebook_file'];
                                 echo 'no journal file found';
                                }

                        ?>
                        </ul>
                        <ul class="list-group">
                          <?php
                            if (!empty($overview['journal_file']))
                                  {
                                   echo '<h4><a href=https://github.com/BenjMy/agrogeophy-data/raw/master/try-reda-master/'.$overview['journal_file'].' class="btn btn-primary" target="_blank"> Download metadata journal file </a></h4>';
                                   // include('https://github.com/BenjMy/agrogeophy-data/raw/master/try-reda-master/'.$overview['journal_file']);
                                  }
                            else
                                  {
                                   // echo $overview['notebook_file'];
                                   echo 'no journal file found';
                                  }

                          ?>
                        </ul>
          <h2>Contact description</h2>
            <ul class="list-group">

            <?php
                    // id_species
                    if (!empty($overview['name']))
                          {
                            echo '<li class="list-group-item"><b>Contrib. Author: </b> '.$overview['surname'].' '.$overview['name'].'</li>';
                          }
                    // id_species
                    if (!empty($overview['email']))
                          {
                            echo '<li class="list-group-item"><b>Email: </b> '.$overview['email'].'</li>';
                            // echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=About your contribution nb '.$_GET['idnb'].'><b>Contact the author</b></a></li>';
                            echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=><b>Contact the author</b></a></li>';
                          }

            ?>
        <p>
        <h4><a href="mailto:benjamin.mary@unipd.it?subject=error dbb Agrogeophysic" class="btn btn-primary"> Report an error </a></h4>    
        </p>
        </div>
    </section><!-- #about -->

<?php
    }
?>


<footer>
Designed with <a href="https://bootstrapmade.com/">BootstrapMade</a>
</footer><!-- #footer -->

</body>
</html>