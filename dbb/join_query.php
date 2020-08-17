<?php 

    $sql_main_joint='
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
           LEFT JOIN abiotic ON (main.id_FK_abiotic = abiotic.id_abiotic_l2)';

?>
