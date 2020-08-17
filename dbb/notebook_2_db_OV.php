# -*- coding: utf-8 -*-
"""
Created on Wed Mar 18 16:55:43 2020

@author: Benjamin
"""

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ------------------------------------------------------------------------------------
// VALUES TO REPLACE

$uname = "uname";
$pass = "pass";
$sname ="sname";
$db ="db";
$tableName2fill="tableName2fill";

// ------------------------------------------------------------------------------------
//Making database connection

try
{
	// $con = new PDO('mysql:host=localhost;dbname=test');
	// $con = new PDO('mysql:host=localhost;dbname=insertkey;charset=utf8;password=TqgOCjdDq2Shyhja', 'root');
    $conn = mysqli_connect($sname,$uname,$pass,$db);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Make studentdb the current database
$db_selected = mysqli_select_db($conn,$tableName2fill);

if (!$db_selected) {
  // If we couldn't, then it either doesn't exist, or we can't see it.
  $sql = 'CREATE DATABASE '.$tableName2fill;

  if (mysqli_query($conn,$sql)) {
      echo 'Database '.$tableName2fill.'created successfully\n';
  } else {
      echo 'Error creating database: ' . mysql_error() . "\n";
  }
}

// -------------------------------------------------------------------------
/// backup file
$tableName  = 'agrigeophy';
$backupFile = 'backup/agrigeophy_backup.sql';
$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
$result = mysqli_query($conn,$query);
// -------------------------------------------------------------------------


$rowCount = 0;
$colCount = 0;

// $filename = "SC_google_form/blanchy_notebook_example.tsv";
// $filename = "./agrogeophy-bib.csv";
// $filename = "./agrogeophy-bib_1l.txt"; //
// $filename = "./agrogeophy-bib.txt"; //
// $filename = "json_array_Snow_John_2020-07-27 17_04_21.json"; //
$filename = "json_array_mary_benjamin_2020-08-05 17_14_17.txt"; //

// $stringfp = file_get_contents($fp);
// echo $string;

$string = file_get_contents($filename);
echo $string;
echo "<br>";

// echo $someJSON;
// echo "<br>";

// $size_line=258;
// $delim="\t";
// $delim=";";
$data = json_decode($string, true);
echo var_dump($data);
echo "<br>";

// for($rowCount=0; $rowCount<count($data); $rowCount++) {
//     echo "[$rowCount]";
//     echo "<BR>";


	    $query_T2 = "INSERT INTO contact(name, surname,	organisation,email)
	    			VALUES ('" . $data["name"] . "','" . $data["surname"] . "','" . $data["organisation"] . "','" . $data["email"] . "')
					 ON DUPLICATE KEY UPDATE id_contact_l2=LAST_INSERT_ID(id_contact_l2),
					 name = values(name),
					 surname = values(surname),
					 organisation = values(organisation),
					 email = values(email)"; // website not provided
	    echo $query_T2;
		echo "<br>";

echo "<br>";


// Insert into summary (primaryKey, fieldA, fieldB) values (NULL, valueA, valueB) on duplicate key update primaryKey=LAST_INSERT_ID(primaryKey), fieldA = fieldA, fieldB=fieldB;


		$conn->query($query_T2);
		// $reponse->closeCursor(); // Termine le traitement de la requête
		echo 'Le jeu CONTACT a bien été ajouté !';
		echo "<br>";
		echo '--------------------';
		echo "<br>";

		// $new_contact_id = $conn->insert_id;
		$new_contact_id = $conn->insert_id;
		echo $new_contact_id;
		echo "<br>";

		// '*******************************************************************************************';
		echo "PROSPECTION TABLE";  // T3
		echo "<br>";
		echo '**********************';
		echo "<br>";

		echo "<br>";
		$new_date = date("y-m-d", strtotime($data["publiDate"]));
		echo $new_date;
		echo "<br>";
    $new_lat =floatval($data["longitude"]);
    $new_long =floatval($data["latitude"]);


    	$query_T3 = "INSERT INTO prospection(datep, lat, longitude, method, spatial_scale, temporal_scale, dimension)
           VALUES ('" . $new_date . "','" . $new_lat . "','" . $new_long . "','" . $data["prospectionType"] . "','" . $data["SpatialScale"] . "','" . $data["TemporalScale"] . "','" . $data["dimension"] . "')
					 ON DUPLICATE KEY UPDATE id_prospection_l2=LAST_INSERT_ID(id_prospection_l2),
					 method = values(method),
           spatial_scale = values(spatial_scale),
           temporal_scale = values(temporal_scale),
					 dimension = values(dimension)
					 ";
    // $query_T3 = "INSERT INTO prospection(method,scale,instrument,dimension,permanent_setup) VALUES ('" . $data[4] . "','" . $data[5] . "','" . $data[6] . "','" . $data[7] . "','" . $data[8] . "')
      //      ON DUPLICATE KEY UPDATE
          //  method = values(method),
          //  scale = values(scale),
          //  instrument = values(instrument),
          //  dimension = values(dimension),
          //  permanent_setup = values(permanent_setup)";

      echo $query_T3;
    echo "<br>";
    $conn->query($query_T3);
    // $reponse->closeCursor(); // Termine le traitement de la requête
    echo 'Le jeu PROSPECTION TABLE a bien été ajouté !';
    echo "<br>";
    echo '--------------------';
    echo "<br>";


    $new_prospection_id = $conn->insert_id;
    echo $new_prospection_id;
    echo "<br>";

    // '*******************************************************************************************';
    echo "PROCESSING TOOLS TABLE"; // T4
    echo "<br>";
    echo '**********************';
    echo "<br>";

      $query_T4 = "INSERT INTO processing(software_name, licence_type, DOI_software,notebook_filename,notebook_purpose)
            VALUES ('" . $data["software"] . "','" . $data["license"] . "','" . $data["NotebookDOI"] . "','" . $data["notebook_file"] . "')
           ON DUPLICATE KEY UPDATE id_processing_l2=LAST_INSERT_ID(id_processing_l2),
           software_name = values(software_name),
           licence_type = values(licence_type),
           DOI_software = values(DOI_software), 
           notebook_filename = values(notebook_filename)"; // NOTE: not adding data link
      echo $query_T4;
    echo "<br>";
    $conn->query($query_T4);
    // $reponse->closeCursor(); // Termine le traitement de la requête
    echo 'Le jeu PROCESSING TOOLS a bien été ajouté !';
    echo "<br>";
    echo '--------------------';
    echo "<br>";

    $new_processing_id = $conn->insert_id;
    echo $new_processing_id;
    echo "<br>";


    // '*******************************************************************************************';
    echo "PROCESSING BIOTIC TABLE"; // T5
    echo "<br>";
    echo '**********************';
    echo "<br>";

      $query_T5 = "INSERT INTO biotic(species)
            VALUES ('" . $data["species"] . "')
           ON DUPLICATE KEY UPDATE id_biotic_l2=LAST_INSERT_ID(id_biotic_l2),
           species = values(species)";
      echo $query_T5;
    echo "<br>";
    $conn->query($query_T5);
    // $reponse->closeCursor(); // Termine le traitement de la requête
    echo 'Le jeu BIOTIC a bien été ajouté !';
    echo "<br>";
    echo '--------------------';
    echo "<br>";

    $new_biotic_id = $conn->insert_id;
    echo $new_biotic_id;
    echo "<br>";

    // '*******************************************************************************************';
    echo "MAIN TABLE"; // T1
    echo "<br>";
    echo '**********************';
    echo "<br>";


// START TRANSACTION;
// INSERT IGNORE INTO users (Name, ...) VALUES ('user1',..) ON DUPLICATE KEY UPDATE lastSeen=NOW();
// SELECT CASE WHEN LAST_INSERT_ID()=0 THEN (SELECT id FROM users WHERE Name = 'user1') ELSE LAST_INSERT_ID() END;
// COMMIT;

    // $ContributionType = echo 'Notebook';

      $query_T1 = "INSERT INTO main(contrib_type, contrib_title,  contrib_date, contrib_authors,  DOI, id_FK_contact, id_FK_prospection, id_FK_biotic)
          VALUES ('Notebook',
            '".$data["title"]."',
            '" . $new_date ."',
            '" . $data["authors"] . "',
            '" . $data["NotebookDOI"] . "',
           '".$new_contact_id."',
           '".$new_prospection_id."',
           '".$new_biotic_id."')
         ON DUPLICATE KEY UPDATE main.id=LAST_INSERT_ID(main.id),
       id_FK_contact = values(id_FK_contact),
       id_FK_prospection = values(id_FK_prospection),
       id_FK_processing = values(id_FK_processing),
       id_FK_biotic = values(id_FK_biotic),
       id_FK_abiotic = values(id_FK_abiotic)";

    echo $query_T1;
    echo "<br>";
    $conn->query($query_T1);
    // $reponse->closeCursor(); // Termine le traitement de la requête
    echo 'Le jeu MAIN TABLE a bien été ajouté !';
    echo "<br>";
    echo '--------------------';
    echo "<br>";

    if($conn)
      {
      echo "Success Tmain";
      echo "<br>";
      }
      else
      {
      echo "Error";
      echo "<br>";
      }


// }

?>

