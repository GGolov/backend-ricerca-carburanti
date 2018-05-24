<?php
    /*
        Restituisce un JSON array con i tipi di
        carburante presenti nel database.
    */

	$db = new mysqli('localhost', 'ggtests', '', 'my_ggtests');
    $sql = 'SELECT DISTINCT descCarburante FROM prezzi';
    $carburanti = array();
    
    $res = $db->query($sql);
    
    while($carburante = $res->fetch_assoc()) {
    	$carburanti[] = $carburante['descCarburante'];
    }
    
    header('Content-Type: application/json');
	echo json_encode(array('fueltypes' => $carburanti));

    $db->close();
?>
