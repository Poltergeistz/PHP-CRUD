<?php

require 'db_login.php';

$sql_1 = 'SELECT lastname, firstname FROM clients;';
$sql_2 = 'SELECT * FROM showTypes;';
$sql_3 = 'SELECT * FROM clients ORDER BY id LIMIT 20;';
$sql_4 = 'SELECT * FROM clients LEFT JOIN cards ON clients.cardNumber = cards.cardNumber WHERE cardTypesId = 1;';
$sql_5 = 'SELECT lastname, firstname FROM clients WHERE lastname LIKE "M%" ORDER BY lastname ASC;';
$sql_6 = 'SELECT title, performer, date, startTime FROM shows ORDER BY title ASC;';
$sql_7 = 'SELECT lastname, firstname, birthDate, card, cardNumber FROM clients;';


try{
    echo "<h1>"."Afficher tous les clients"."</h1>";
    // echo"<table border='1'>";
    // echo"<tr><td>id</td><td>lastname</td><td>firstname</td><td>birthdate</td><td>card</td><td>cardnumber</td><tr>";
    foreach($pdo->query($sql_1) as $row => $value){
        echo $value[0].' '.$value[1].' - ';
    }
    // echo"</table>";
    echo "<h1>"."Afficher tous les types de spectacles possibles"."</h1>";
    foreach($pdo->query($sql_2) as $row => $value){
        echo $value[1].' - ';
    }
    echo "<h1>"."Afficher les 20 premiers clients"."</h1>";
    foreach($pdo->query($sql_3) as $row => $value){
        echo $value[0]." - ".$value[1]."<br>";
    }
    echo "<h1>"."N'afficher que les clients possédant une carte de fidélité"."</h1>";
    foreach($pdo->query($sql_4) as $row => $value){
        echo $value[1].' - ';
    }
    echo "<h1>"."Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre 'M'.
    Les afficher comme ceci :
    
    Nom : *Nom du client*
    Prénom : *Prénom du client*
    
    Trier les noms par ordre alphabétique."."</h1>";
    foreach($pdo->query($sql_5) as $row => $value){
        echo "Nom : ".$value[0]."<br>"."Prénom : ".$value[1]."<br>";
    }
    echo "<h1>"."Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par ordre alphabétique. Afficher les résultat comme ceci : *Spectacle* par *artiste*, le *date* à *heure*"."</h1>";
    foreach($pdo->query($sql_6) as $row => $value){
        echo $value[0]." par ".$value[1].", le ".$value[2]." à ".$value[3]."<br>";
    }
    echo "<h1>"."Afficher tous les clients comme ceci :
    Nom : *Nom de famille du client*
    Prénom : *Prénom du client*
    Date de naissance : *Date de naissance du client*
    Carte de fidélité : *Oui (Si le client en possède une) ou Non (s'il n'en possède pas)*
    Numéro de carte : *Numéro de la carte fidélité du client s'il en possède une.*"."</h1>";
    foreach($pdo->query($sql_7) as $row => $value){
        echo "Nom : ".$value[0]."<br>";
        echo "Prénom : ".$value[1]."<br>";
        echo "Date de naissance : ".$value[2]."<br>";
        if($value[3] == 0){
            // echo $value[3];
            // echo "Nom : ".$value[0]."<br>";
            // echo "Prénom : ".$value[1]."<br>";
            echo "Carte de fidélité : Non "."<br><hr>";
        }
        if($value[3] == 1){
            echo "Carte de fidélité : Oui "."<br>";
            echo "Numéro de carte : ".$value[4]."<br><hr>";
        }
    }
    $pdo = null;
} catch (PDOException $e){
    print "Error!:".$e->getMessage()."<br>";
    die();
}