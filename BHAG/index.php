<?php

//include('Smarty.class.php');

// create object
//$smarty = new Smarty;

// assign some content. This would typically come from
// a database or other source, but we'll use static
// values for the purpose of this example.
// display it



$fhemdbhost = "127.0.0.1";
$fhemdbuser = "fhem";
$fhemdbpass = "fhem";
$fhemdb = "fhem";

$test1 = "123";
$test2 = "345";


echo "eule<br>";


// LETZTER WERT
	//DB-Connection
    $verbindung_wt = mysql_connect ($fhemdbhost,$fhemdbuser, $fhemdbpass) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
    mysql_select_db($fhemdb) or die ("Die Datenbank existiert nicht.");

    $abfrage_wt = "SELECT * FROM current WHERE DEVICE='OWL' AND READING='A' ORDER BY TIMESTAMP DESC LIMIT 0,1";
    $ergebnis_wt = mysql_query($abfrage_wt);


    while($row_wt = mysql_fetch_object($ergebnis_wt))
    {
        echo  "Rohformat: ".$row_wt->VALUE ."<br><br>";
	
	// string zerlegen in ampere, watt und euro
	$tagsAsString = $row_wt->VALUE;
    $tagsAsArray = explode(',', $tagsAsString);
    
	//ampere
	$ampArray = explode(' ',  $tagsAsArray[0]);
	
	//watt
	$wattArray = explode(' ',  $tagsAsArray[1]);

	//euro
	$euroArray = explode(' ',  $tagsAsArray[2]);
	
	$Ampere = $ampArray[0];
	$Watt = $wattArray[2];
	$Euro = $euroArray[2];
	
	echo "Ampere: ".$Ampere ." A <br>";
	echo "Watt: ".$Watt ." Watt<br>";
	echo "Euro: ".$Euro . " €/h<br>";

	echo "<br><br><br>ENDE CURRENT<br><br><br>";
    }

//ENDE LETZER WERT
	
	
	
	// Historie
	$verbindung_wt2 = mysql_connect ($fhemdbhost,$fhemdbuser, $fhemdbpass) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
    mysql_select_db($fhemdb) or die ("Die Datenbank existiert nicht.");

    $abfrage_wt2 = "SELECT * FROM history WHERE DEVICE='OWL' AND READING='A' ORDER BY TIMESTAMP ASC LIMIT 0,30";
	$ergebnis_wt2 = mysql_query($abfrage_wt2);
	
	
	//$categorie = "categories: [";
	
	while($row_wt2 = mysql_fetch_object($ergebnis_wt2))
    {
    
    //echo $row_wt->VALUE;	
	// string zerlegen in ampere, watt und euro
	$originalString = $row_wt2->VALUE;
    
	$tagsAsArray = explode(',', $originalString);
    
	$ampArray = explode(' ',  $tagsAsArray[0]);
	$wattArray = explode(' ',  $tagsAsArray[1]);
	
	$Ampere = $ampArray[0];
	$Watt = $wattArray[2];
	
	// echo $row_wt2->TIMESTAMP . " -- Ampere: ".$Ampere . " -- Watt: ".$Watt ."<br>";
	
	$categorie .= "'".$row_wt2->TIMESTAMP."',";
	// categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	
	$data .= $data + $Ampere.",";
	// data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
	
	//$tpl->assign('DATA', 'jahdsahdhsadasj'
	
	echo $data."<br>";
	//echo $categorie."<br>";

 	  
		}


echo "<br><br>Tuer<br><br>";


// LETZTER WERT
	//DB-Connection
    $verbindung_wt3 = mysql_connect ($fhemdbhost,$fhemdbuser, $fhemdbpass) or die ("keine 
Verbindung möglich. Benutzername oder Passwort sind falsch");
    mysql_select_db($fhemdb) or die ("Die Datenbank existiert nicht.");
    
	$abfrage_wt3 = "SELECT * FROM current WHERE DEVICE='Garagentuer_hinten' AND 
READING='state' ORDER BY TIMESTAMP DESC LIMIT 0,1";
    $ergebnis_wt3 = mysql_query($abfrage_wt3);
    
	while($row_wt3 = mysql_fetch_object($ergebnis_wt3))
    {
        echo "Rohformat: ".$row_wt3->VALUE ."<br><br>";
    }
?>
