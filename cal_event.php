<?php
    $lien = mysqli_connect('localhost', 'root', 'root');
    $ma_base = 'events';
     
    if (!$lien)
    {
        echo 'Impossible de se connecter au serveur MySQL.';
    }
     
    if (!mysqli_set_charset($lien, 'utf8'))
    {
        echo "Impossible de configurer l'encodage de la connexion à la base.";
    }
     
    if (!mysqli_select_db($lien, $ma_base))
    {
        echo "La base de données est introuvable.";
    }
     
     if(!empty($_GET['m']))
        {$m = $_GET['m'];}
    else{$m = date("m");};

    if(!empty($_GET['a']))
        {$a = $_GET['a'];}
    else{$a = date("Y");};
 
   if(!empty($_GET['eventId']))
        {$eventID = $_GET['eventId'];}
    else{$eventID='';};
   
     
            // $m = $_GET['m'];
            // $a = $_GET['a'];
            // if ($m == "") { $m = date("m"); }
            // if ($a == "") { $a = date("Y"); }
 
            $resultats = mysqli_query($lien, "SELECT *,
                                                  DAY(event_date) as event_jour
                                                  FROM events
                                                  WHERE YEAR(event_date) = '$a' AND MONTH(event_date) = '$m'
                                                  ORDER BY event_date");

           $idresultats = mysqli_query($lien, "SELECT *
                                                  FROM events
                                                  WHERE YEAR(event_date) = '$a' AND MONTH(event_date) = '$m' AND 
                                                      DAY(event_date)='$eventID'
                                                  ORDER BY time
                                                  ");
 
 
            while ($ligne = mysqli_fetch_array($resultats))
            {
                $evenement[$ligne['event_jour']] = $ligne['id']; 
                $cemois[] = array(      'event_date' => $ligne['event_date'],
                                        'event_descr'  => $ligne['event_descr'],
                                        'event_jour' => $ligne['event_jour']);
            }
             
            require_once("calendrier.php");
            calendrier(date("n"),date("Y"));
?>