<?php
    /*
        Routine giornaliera che preleva di dati degli impianti
        dall'API di www.sviluppoeconomico.gov.it per inserirli nel
        database.
    */

	function update($url, $filename, $table) {
    	// Recupero file da url.
        $ch = curl_init($url);

        $fp = fopen($filename, 'w+');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        
        // Scrittura dei dati recuperati nel db.
        $fp = fopen($filename, 'r');
        
        while($line = fgets($fp)) {
        	if(!strpos($line, 'Estrazione del') || !strpos($line, 'idImpianto')) {
        		$arr = split (";", $line);
                $query = "TRUNCATE TABLE $table; INSERT INTO $table VALUES (".implode(',', $arr).")";
            }
        }
        
        fclose($fp);
    }

	update('https://www.mise.gov.it/images/exportCSV/prezzo_alle_8.csv', 'prezzi.csv', 'prezzi');
	update('https://www.mise.gov.it/images/exportCSV/anagrafica_impianti_attivi.csv', 'impianti.csv', 'impianti');
?>
