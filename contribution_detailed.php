<!DOCTYPE html>
<html>
<head>
	<title>Catalog Agrogeophysic</title>

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
	<!-- 	<link href="css/style.css" rel="stylesheet">  -->  
 	<link href="css/style_contrib_details.css" rel="stylesheet">

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


// $sql_main_joint_idnb = 'SELECT * 
// 						FROM main
// 						FOR JSON PATH';


// abiotic.land_use

// $sql_main_joint_idnb='
// SELECT main.id, main.contrib_type,main.contrib_title,main.contrib_date,main.contrib_authors,main.DOI,main.journal,main.icon_img,main.keywords,
// main.id_FK_abiotic, main.id_FK_biotic,main.id_FK_prospection,main.id_FK_processing,main.id_FK_contact,
//        contact.name,contact.surname,contact.name,contact.email,contact.organisation,contact.website_perso,  contact.id_contact_l2,
//        prospection.datep, prospection.method, prospection.spatial_scale, prospection.bound_cond, prospection.temperature, prospection.temporal_scale, prospection.instrument, prospection.dimension, prospection.permanent_setup, prospection.lat AS x, prospection.longitude AS y,prospection.id_prospection_l2,
//        processing.software_name,processing.licence_type,processing.DOI_software,processing.notebook_filename,processing.notebook_purpose,processing.data_repo_url, processing.data_licence,processing.id_processing_l2,
//        biotic.species,biotic.organ,biotic.id_biotic_l2,
//        abiotic.soil_type, abiotic.water_input ,abiotic.id_abiotic_l2
// FROM 
// 		main
//        	LEFT JOIN contact ON (main.id_FK_contact = contact.id_contact_l2)
//        	LEFT JOIN processing ON (main.id_FK_processing = processing.id_processing_l2)
//        	LEFT JOIN prospection ON (main.id_FK_prospection = prospection.id_prospection_l2)
//        	LEFT JOIN biotic ON (main.id_FK_biotic = biotic.id_biotic_l2)
//        	LEFT JOIN abiotic ON (main.id_FK_abiotic = abiotic.id_abiotic_l2)
// WHERE main.id = ?';

// $sql_main_joint_idnb='
// SELECT contrib_type,contrib_title,contrib_date,contrib_authors,DOI,journal,icon_img,keywords FROM main
// WHERE main.id = ?';


$sql_main_joint_idnb='
SELECT main.*,
       contact.*,
       prospection.*, prospection.lat AS x, prospection.longitude AS y,
       processing.*,
       biotic.*,
       abiotic.*
FROM 
		main
       	LEFT JOIN contact ON (main.id_FK_contact = contact.id_contact_l2)
       	LEFT JOIN processing ON (main.id_FK_processing = processing.id_processing_l2)
       	LEFT JOIN prospection ON (main.id_FK_prospection = prospection.id_prospection_l2)
       	LEFT JOIN biotic ON (main.id_FK_biotic = biotic.id_biotic_l2)
       	LEFT JOIN abiotic ON (main.id_FK_abiotic = abiotic.id_abiotic_l2)
WHERE main.id = ?';

// ALTER TABLE Temptable
// DROP COLUMN main.id_FK_biotic
// DROP TABLE Temptable';
		   #FOR JSON AUTO';

// NEED TO REMOVE collumns with foreign key ids


$select = $conn->prepare($sql_main_joint_idnb);
$select->execute(array($_GET['idnb']));

?>

<?php
	$overview = $select->fetch(PDO::FETCH_ASSOC);
	// $overview = mysql_fetch_array($select, MYSQL_ASSOC);
    unset($overview['id_FK_prospection']);
    unset($overview['id_FK_biotic']);
    unset($overview['id_FK_contact']);
    unset($overview['id_FK_processing']);
    unset($overview['id_FK_abiotic']);
    unset($overview['id_processing_l2']);
    unset($overview['id_prospection_l2']);
    unset($overview['id_biotic_l2']);
    unset($overview['id_abiotic_l2']);



	$json_data=array();//create the array 
    array_push($json_data,$overview);  
	//echo var_dump($overview) ;
	// echo json_encode($json_data)

?>


<!------------------------------------- DISPLAY Scientif comm CONTRIB ------------------------------------ -->
<?php
if  ($overview['contrib_type']=='Research article'|| $overview['contrib_type']== 'Book')
    {
?>
    <section id="about">
          <div class="container">
            <div class="row">

              <div class="col-lg-5 col-md-6" >
                       <div class="sticky-top">
                       	

<!-- 			 				<button class="btn" value="Download_JSON" onclick="DownloadJSON()"><i class="fa fa-download"></i> Download Json metadatas</button> -->
			 				<button class="btn" id="Download_JSON"><i class="fa fa-download"></i> Download Json metadatas</button>
<!-- 			 				something.outerHTML += '<input id="btnsave" ...>'
							document.getElementById ("btnsave").addEventListener ("click", resetEmotes, false); -->

<!-- 			 				<button class="btn" id="Download_XML"><i class="fa fa-download"></i> Download XML metadatas</button>
 -->
<!-- 			 				<button class="btn" value="Download XML" onclick="DownloadXML()"><i class="fa fa-download"></i> Download XML metadatas</button> -->
			 				<!-- 						<input type="button" value="Download JSON" onclick="DownloadJSON()" />
 -->

		                  <?php

			                  if (is_null($overview['icon_img']))
			                  {
			                                  // echo  '****************************************';

			                    echo '<div class="about-img"><p><img src="dbb/SC_icons/Eco_leaves_nature-512.png" width="40"><p></div>';
			                  }
			                  else
			                  {
			                  echo '<div class="caption"><h3><img src="dbb/SC_icons/'.$overview['icon_img'].'" width="400"></h3></div>';
			                  }
			               ?>
			                  <h1>
			                  <?php echo $overview['contrib_title']; ?>
			                 </h1>
                      </div>

             </div>

             <div class="col-lg-7 col-md-6">
                <div class="about-content">
                 	<h3>Metrics</h3>
		                <?php
		                echo '<div class="altmetric-embed" data-badge-type="donut" data-doi="'.$overview['DOI'].'"></div>'
		                ?>
	                <h2>Contribution overview</h2>
	                      <ul class="list-group">

	                <?php
	                        if (!empty($overview['contrib_type']))
	                              {
	                                echo  '<li class="list-group-item"><b>Type:</b> '.$overview['contrib_type'].'</li>';
	                              }
	                                           
	                        if (!empty($overview['keywords']))
	                              {
	                                echo '<li class="list-group-item"><b>Keywords: </b> '.$overview['keywords'].'</li>';
	                              }
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
		                        if (!empty($overview['software_name']))
		                              {
		                                echo '<li class="list-group-item"><b>Software: </b> '.$overview['software_name'].'</li>';
		                              }
		                        if (!empty($overview['licence_type']))
		                              {
		                                echo '<li class="list-group-item"><b>Licence type: </b> '.$overview['licence_type'].'</li>';
		                              }
		                        if (!empty($overview['DOI_proc_tools']))
		                              {
		                                echo '<li class="list-group-item"><b>DOI: </b> '.$overview['DOI_proc_tools'].'</li>';
		                               }
		               ?>
                    </ul>

                 <h2>Biotic</h2>
                      <ul class="list-group">
		                <?php
		                        if (!empty($overview['species']))
		                              {
		                                echo '<li class="list-group-item"><b>Species: </b> '.$overview['species'].'</li>';
		                              }
		                        if (!empty($overview['organ']))
		                              {
		                                echo '<li class="list-group-item"><b>Organ: </b> '.$overview['organ'].'</li>';
		                              }

		                ?>
                    </ul>

                 <h2>Abiotic description</h2>
                      <ul class="list-group">
		                <?php
		                        if (!empty($overview['soil_type']))
		                              {
		                                echo '<li class="list-group-item"><b>Soil type: </b> '.$overview['soil_type'].'</li>';
		                              }
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
            
            		<h4>
            			<a href="mailto:benjamin.mary@unipd.it?subject=error dbb Agrogeophysic" class="btn btn-primary"> Report an error </a>
            		</h4>    
            	</p>

            </div>
          </div>
        </div>
      </div>

    </section>
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

			                  if (is_null($overview['icon_img']))
			                  {
			                                  // echo  '****************************************';
			                    echo '<div class="about-img"><p><img src="dbb/SC_icons/Eco_leaves_nature-512.png" width="100"><p></div>';
			                  }
			                  else
			                  {
			                  echo '<div class="caption"><h3><img src="dbb/M_models/agrogeophy-notebooks/icon_img/'.$overview['icon_img'].'" width="250"></h3></div>';
			                  }
			               ?>

		                <?php  
		                        if (!empty($overview['contrib_type']))
		                              {
		                                echo  '<li class="list-group-item"><b>Type:</b> '.$overview['contrib_type'].'</li>';
		                              }    
		                        if (!empty($overview['method']))
		                              {
		                                echo '<li class="list-group-item"><b>Keywords: </b> '.$overview['keywords'].'</li>';
		                              }
		                        if (!empty($overview['DOI']))
		                              {
		                                echo '<li class="list-group-item"><a href="https://dx.doi.org/'.$overview['DOI'].'"  target="_blank"><b>Link to publication</b></a></li>';
		                               }

		                ?>
                      </ul>
                  <h2>Contact description</h2>
                        <ul class="list-group">

                        <?php
                                if (!empty($overview['name']))
                                      {
                                        echo '<li class="list-group-item"><b>Contrib. Author: </b> '.$overview['surname'].' '.$overview['name'].'</li>';
                                      }
                                if (!empty($overview['email']))
                                      {
                                        echo '<li class="list-group-item"><b>Email: </b> '.$overview['email'].'</li>';
                                        echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=><b>Contact the author</b></a></li>';
                                      }

                        ?>
                      </ul>
	                  <?php
	                    if (!empty($overview['notebook_filename']))
	                          {
	                           echo '<h4><a href=https://mybinder.org/v2/gh/agrogeophy/notebooks/master?filepath=notebooks/'.$overview['notebook_filename'].' class="btn btn-primary" target="_blank"> Try model in binder </a></h4>';
                             // echo '<h4><a href=https://mybinder.org/v2/gh/BenjMy/agrogeophy-notebooks.git/master?filepath=.%2Fnotebooks%2F'.$overview['notebook_file'].'.ipynb class="btn btn-primary" target="_blank"> Download Notebook </a></h4>';

                             include('./dbb/M_models/agrogeophy-notebooks/html/'.$overview['notebook_filename'].'.html');
	                          }
	                    else
	                          {
	                           echo '<h4><a href=https://mybinder.org/v2/gh/BenjMy/agrogeophy-notebooks.git/master?filepath=.%2Fnotebooks%2FLorenz.ipynb class="btn btn-primary" target="_blank"> Try example model in binder </a></h4>';
	                           include('./dbb/M_models/agrogeophy-notebooks/html/Lorenz.html');

	                          }

	                  ?>
                </div>
            </div>
          </div>

        <p>
        <h4><a href="mailto:benjamin.mary@unipd.it?subject=error dbb Agrogeophysic" class="btn btn-primary"> Report an error </a></h4>    
        </p>
        </div>
    </section>

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
               <div class="sticky-top">
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
                            }
                      else
                            {
                             echo 'no journal file found';
                            }

                    ?>
                    </ul>
                    <ul class="list-group">
                      <?php
                        if (!empty($overview['journal_file']))
                              {
                               echo '<h4><a href=https://github.com/BenjMy/agrogeophy-data/raw/master/try-reda-master/'.$overview['journal_file'].' class="btn btn-primary" target="_blank"> Download metadata journal file </a></h4>';
                              }
                        else
                              {
                               echo 'no journal file found';
                              }

                      ?>
                    </ul>
          <h2>Contact description</h2>
            <ul class="list-group">

            <?php
                    if (!empty($overview['name']))
                          {
                            echo '<li class="list-group-item"><b>Contrib. Author: </b> '.$overview['surname'].' '.$overview['name'].'</li>';
                          }
                    if (!empty($overview['email']))
                          {
                            echo '<li class="list-group-item"><b>Email: </b> '.$overview['email'].'</li>';
                            echo '<li class="list-group-item"><a href=mailto:'.$overview['email'].'?subject=><b>Contact the author</b></a></li>';
                          }

            ?>
        <p>
        <h4><a href="mailto:benjamin.mary@unipd.it?subject=error dbb Agrogeophysic" class="btn btn-primary"> Report an error </a></h4>    
        </p>
        </div>
    </section>

<?php
    }
?>


<script type="text/javascript">
    document.getElementById ("Download_JSON").addEventListener ("click", DownloadJSON, false);

    function DownloadJSON(exportObj, exportName){

        var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(<?php echo json_encode($json_data) ?>));
        var downloadAnchorNode = document.createElement('a');
        downloadAnchorNode.setAttribute("href",     dataStr);
        downloadAnchorNode.setAttribute("download", exportName + ".json");
        document.body.appendChild(downloadAnchorNode); // required for firefox
        downloadAnchorNode.click();
        downloadAnchorNode.remove();
  }
</script>

<script type="text/javascript">
    document.getElementById ("Download_XML").addEventListener ("click", DownloadXML, false);

    function DownloadXML(exportObj, exportName){

        var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON_PRETTY(JSON.stringify(<?php echo xmlrpc_encode($json_data) ?>)));
        var downloadAnchorNode = document.createElement('a');
        downloadAnchorNode.setAttribute("href",     dataStr);
        downloadAnchorNode.setAttribute("download", exportName + ".json");
        document.body.appendChild(downloadAnchorNode); // required for firefox
        downloadAnchorNode.click();
        downloadAnchorNode.remove();
  }
</script>


</body>
</html>