<?php
include("dbb/connect_db.php");

    include("dbb/join_query.php"); # return sql_main_joint
    // echo $sql_main_joint;

    // new without joint
    $select = $conn->prepare($sql_main_joint);
    $select->execute();

    if (!$select) {
        echo 'An SQL error occured.\n';
        exit;
    }

$ArrayValue = array();
$row = $select->fetch(PDO::FETCH_ASSOC);
array_push($ArrayValue, json_encode($row));

// echo var_dump($row);
$ArrayValue = array();
        # Loop through rows to build feature arrays
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $ArrayValue_tmp['organisation'] = $row['organisation']; 
            $ArrayValue_tmp['name'] = $row['name'].' '.$row['surname'] ; 
            $ArrayValue_tmp['contrib_authors'] = $row['contrib_authors']; 
            $ArrayValue_tmp['method'] = $row['method']; 



            $ArrayValue_tmp['software_name'] =  $row['software_name']; 
            $ArrayValue_tmp['licence_type'] =  $row['licence_type']; 
            $ArrayValue_tmp['notebook_filename'] =  $row['notebook_filename']; 


            $ArrayValue_tmp['dimension'] = $row['dimension']; 
            $ArrayValue_tmp['spatial_scale'] = $row['spatial_scale']; 
            $ArrayValue_tmp['bound_cond'] = $row['bound_cond']; 
            $ArrayValue_tmp['temporal_scale'] = $row['temporal_scale']; 
            $ArrayValue_tmp['instrument'] = $row['instrument']; 
            $ArrayValue_tmp['permanent_setup'] = $row['permanent_setup']; 

            $ArrayValue_tmp['species'] = $row['species']; 
            $ArrayValue_tmp['organ'] = $row['organ']; 

            $ArrayValue_tmp['contrib_date'] = $row['contrib_date']; 
            $ArrayValue_tmp['contrib_type'] =  $row['contrib_type']; 
            $ArrayValue_tmp['contrib_title'] =  $row['contrib_title']; 
            $ArrayValue_tmp['DOI'] =  '<a href="https://dx.doi.org/'.$row['DOI'].'"  target="_blank">DOI</a>'; 
            $ArrayValue_tmp['more'] = '<a href="contribution_detailed.php?idnb='.$row['id'].'">more</a>';   


            array_push($ArrayValue, $ArrayValue_tmp);
        }
    echo json_encode($ArrayValue);

?>
