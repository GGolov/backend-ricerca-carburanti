<?php
  /*
    Restituisce la lista di impianti data la distanza geografica
    dall'utente, il tipo di carburante ed il raggio di ricerca
    dati in input tramite parametri GET.
  */

  // Funzione che restituisce la distanza tra due punti geografici.
  function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
    // Conversione da gradi a radianti.
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    // Differenza tra latitudine e longitudine dei due punti.
    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

    // Restituisce la distanza in km.
    return ($angle * 6371000) / 1000;
  }

  // Funzione che codifica le stringhe di un array, o semplice stringa, in UTF-8.
  // Essenziale per JSON di medie/grandi dimensioni.
  function array_utf8_encode($dat)
  {
      if (is_string($dat))
          return utf8_encode($dat);
      if (!is_array($dat))
          return $dat;
      $ret = array();
      foreach ($dat as $i => $d)
          $ret[$i] = array_utf8_encode($d);
      return $ret;
  }
  
  if(isset($_GET['lat'], $_GET['lng'], $_GET['tipo'], $_GET['r'])) {
	// Connessione al database.
    $db = new mysqli('localhost', 'ggtests', '', 'my_ggtests');
    $db->set_charset('utf-8');
      
    $impianti = array();
    $latUtente = $db->real_escape_string($_GET['lat']);
    $lngUtente = $db->real_escape_string($_GET['lng']);
    $tipo = $db->real_escape_string($_GET['tipo']);
    $raggio = $db->real_escape_string($_GET['r']);
	
    // Seleziona i dati di tutti gli impianti che si trovano nella
    // stessa provincia dell'utente.
    $sql = "SELECT DISTINCT Bandiera, Comune, Gestore, Indirizzo, Latitudine, Longitudine, Nome_Impianto, prezzo
            FROM impianti, prezzi WHERE impianti.idImpianto = prezzi.idImpianto AND descCarburante = '".$tipo.
            "' ORDER BY prezzo ASC";
    
    $res = $db->query($sql);
	
    while($impianto = $res->fetch_assoc()) {
      $latImp = $impianto['Latitudine'];
      $lngImp = $impianto['Longitudine'];
      
      // Aggiunge l'impianto all'array globale, da restituire al client, degli impianti se
      // la distanza tra la posizione del'utente e quello dell'impianto
      // è minore o uguale al raggio desiderato.
      if (distance($latUtente, $lngUtente, $latImp, $lngImp) <= $raggio) {
        $impianti[] = $impianto;
      }
    }
    
    // Invio dell'array di impianti.
    $return = array_utf8_encode(array('gasstations' => $impianti));

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($return);
    
  	$db->close();
  }
  else { 
    echo json_encode('ciao :D');
  }
?>
