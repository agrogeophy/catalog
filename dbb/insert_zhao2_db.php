<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uname = "BenjaminSql";
$pass = "TqgOCjdDq2Shyhja";
$sname ="localhost";
$db ="agrigeophy";
$tableName2fill="agrigeophy_zhao";

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

$rowCount = 0;
$colCount = 0;
$filename = 'zhao_bib.json'; //
$string = file_get_contents($filename);
$data = json_decode($string, true);
echo var_dump($data);
echo "<br>";

for($rowCount=0; $rowCount<count($data); $rowCount++) {
    echo "[$rowCount]";
    echo "<BR>";


	    $query_T2 = "INSERT INTO contact(name, surname,	organisation,email,	website_perso)
	    			VALUES ('" . $data[$rowCount]["Name"] . "','" . $data[$rowCount]["Surname"] . "','" . $data[$rowCount]["Institution"] . "','" . $data[$rowCount]["Corresponding email"] . "','". $data[$rowCount]["Personal website"]."')
					 ON DUPLICATE KEY UPDATE id_contact_l2=LAST_INSERT_ID(id_contact_l2),
					 name = values(name),
					 surname = values(surname),
					 organisation = values(organisation),
					 email = values(email),
					 website_perso = values(website_perso)"; // website not provided
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
    // if (strlen($data[$rowCount]["Date"])==0) {
    $new_date = 'NULL'; //define to suit
    // }

    // $new_date = date("y-m-d", strtotime($data[$rowCount]["Date"]));
    // $new_date = date("y-m-d", strtotime($data[$rowCount]["Date"]));
		// echo $new_date;
		echo "<br>";
    // $new_lat =floatval($data[$rowCount]["Lat"]);
    // $new_long =floatval($data[$rowCount]["Long"]);

    $new_lat =$data[$rowCount]["Lat"];
    $new_long =$data[$rowCount]["Long"];
    echo  $new_lat;

    if (strlen($new_lat)==0) {
        $new_lat = 'NULL'; //define to suit
        $new_long = 'NULL'; //define to suit
        echo  $new_lat;
    }

    	$query_T3 = "INSERT INTO prospection(datep, lat, longitude, method, spatial_scale, bound_cond, temporal_scale, dimension, zhao_description)
           VALUES (" . $new_date . "," . $new_lat . "," . $new_long . ",'" . $data[$rowCount]["Method"] . "','" . $data[$rowCount]["Spatial scale"] . "','" . $data[$rowCount]["Boundary cond"] . "','" . $data[$rowCount]["Temporal scale"] . "','" . $data[$rowCount]["Dimension"] . "','" . $data[$rowCount]["Research purpose* (According to Zhao et al 2019)"] . "')
					 ON DUPLICATE KEY UPDATE id_prospection_l2=LAST_INSERT_ID(id_prospection_l2),
					 method = values(method),
           spatial_scale = values(spatial_scale),
           temporal_scale = values(temporal_scale),
					 dimension = values(dimension)
					 ";
    // $query_T3 = "INSERT INTO prospection(method,scale,instrument,dimension,permanent_setup) VALUES ('" . $data[$rowCount][4] . "','" . $data[$rowCount][5] . "','" . $data[$rowCount][6] . "','" . $data[$rowCount][7] . "','" . $data[$rowCount][8] . "')
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
    echo "PROCESSING BIOTIC TABLE"; // T5
    echo "<br>";
    echo '**********************';
    echo "<br>";

      $query_T5 = "INSERT INTO biotic(species)
            VALUES ('" . $data[$rowCount]["Crop type"] . "')
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

      $query_T1 = "INSERT INTO main(contrib_type, contrib_title,  contrib_date, contrib_authors,  DOI, id_FK_contact, id_FK_prospection, id_FK_biotic)
          VALUES ('" . $data[$rowCount]["Contribution type"] . "',
            '".$data[$rowCount]["Title"]."',
            '".$data[$rowCount]["Date"]."',
            '" . $data[$rowCount]["Authors"] . "',
            '" . $data[$rowCount]["DOI"] . "',
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


}

?>

