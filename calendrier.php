
<?php
//FONCTION PRINCIPALE DU CALENDRIER
function calendrier($m_donne,$a_donne){
    include("config.php");
    
    global $evenement;

    $year=date('Y');
    $month=date('m');
    $month=str_replace("0","",$month);
    $m_donne=$month;
    $a_donne=$year;
     
    // On récupère le mois et l'année dans la barre de navigation
    if(!empty($_GET['m']))
        {$m = $_GET['m'];}
    else{$m = $m_donne;};

    if(!empty($_GET['a']))
        {$a = $_GET['a'];}
    else{$a = $a_donne;};
 
    // Si rien n'est spécifié, afficher le mois et l'année donnés par la fonction
    // if ($m == "") { $m = $m_donne; }
    // if ($a == "") { $a = $a_donne; }
     
    // Calcul du nombre de jours dans chaque mois en prenant compte des années bisextiles.
    // Les tableaux PHP commençant par 0 et non par 1, le premier mois est un mois "factice".
    if (($a % 4) == 0){
        $nbrjour = array(0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    }else{
        $nbrjour = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    }
 
    // On cherche grâce à cette fonction à quel jour de la semaine correspond le 1er du mois.
    $premierdumois = jddayofweek(cal_to_jd(CAL_FRENCH, $m, 1, $a), 0);
    if($premierdumois == 0){
        $premierdumois = 7;
    }
 
    // Début du tableau
    echo "<table><tr><td class=\"fleches\">"
        .mois_precedent($m,$mois[$m],$a)
        ."</td><td class=\"nom_mois\" colspan=\"5\">$mois[$m] $a</td><td class=\"fleches\">"
        .mois_suivant($m,$a)
        ."</td></tr><tr class=\"noms_jours\">"
        ."<td>$jours[1]</td><td>$jours[2]</td><td>$jours[3]</td><td>$jours[4]</td><td>$jours[5]</td><td>$jours[6]</td><td>$jours[7]</td></tr><tr>";
 
    $jour=1;    //Cette variable est celle qui va afficher les jours de la semaine
    $joursmoisavant = $nbrjour[$m-1] - $premierdumois+2; //Celle-ci sert à afficher les jours du mois précédent qui apparaissent
    $jourmoissuivant = 1; //Et celle-ci les jours du mois suivant
    if($m == 1){
        $joursmoisavant = $nbrjour[$m+11] - $premierdumois+2; //Si c'est janvier, le mois d'avant n'est pas à 0 mais 31 jours.
    }
 
    //Boucle qui crée l'affichage du calendrier
    for($i=1;$i<40;$i++){       
        if($i < $premierdumois)
        {   // Tant que la variable i ne correspond pas au premier jour du mois, on fait des cellules de tableau avec les derniers jours du mois précédent
        echo "<td class=\"cases_vides\">$joursmoisavant</td>";
        $joursmoisavant++;
        }else{
            if($jour == date("d") && $m == date("n"))
            {   //Si la variable $jour correspond à la date d'aujourd'hui
                if (isset($evenement[$jour]))
                {   //S'il y a un évènement le $jour
                    echo '<td class="aujourdhui"><a href="index.php?m='.$m.'&a='.$a.'&eventId='.$jour.'" title="voir l’évènement">'.$jour.'</a></td>';
                    // foreach($idresultats as $idresultat){

                    // echo '<p>'.$idresultat['event_descr'].'</p>';
                    // echo '<p>'.$idresultat['event_date'].'</p>';

                    // } 
                }
                else
                {   //S'il n'y a rien de particulier
                echo '<td class="aujourdhui">'.$jour.'</td>';
                }
            }
            else
            {
                if (isset($evenement[$jour]))
                {   //S'il y a un évènement le $jour
                    echo '<td class="jours"><a href="index.php?m='.$m.'&a='.$a.'&eventId='.$jour.'" title="voir l’évènement">'.$jour.'</a></td>';

                }
                else
                {   //S'il n'y a rien de particulier
                    echo '<td class="jours">'.$jour.'</td>';
                }
            }
            $jour++;    //On passe au lendemain
         
            /*Si la variable $jour est plus élevée que le nombre de jours du mois, c'est que c'est la fin du mois.
            On remplit les cases vides avec les premiers jours des mois suivants,
            on ferme le tableau, et on met la variable $i à 41 pour sortir de la boucle */
            if($jour > ($nbrjour[$m])){
                while($i % 7 != 0){
                    echo "<td class=\"cases_vides\">$jourmoissuivant</td>";
                    $i++;
                    $jourmoissuivant++;
                }
            echo "</tr></table>";
            $i=41;
            }
        }
     
        // Si la variable i correspond à un dimanche (multiple de 7), on passe à la ligne suivante dans le tableau
        if($i % 7 == 0){
            echo "</tr><tr>";
        }
 
    }
}
 
//FONCTION POUR AFFICHER LE MOINS SUIVANT
function mois_suivant($m,$a){
    $m++;   //mois suivant, donc on incrémente de 1
    if($m==13){ //si le mois et 13, faut augmenter l'année de 1 et repasser le mois à 1
        $a++;
        $m=1;
    }
    if(isset($_GET['page']))
    {
        return '<a href="'.$_SERVER['PHP_SELF'] . "?m=$m&a=$a" . '&page=' . $_GET['page'] . '"> &raquo; </a>';
    }
    else
    {
        if(isset($_GET['eventId']))
        {
            return '<a href="'.$_SERVER['PHP_SELF'] . "?m=$m&a=$a" . '&eventId=' . $_GET['eventId'] . '"> &raquo; </a>';
        }
        else
        {
            return '<a href="'.$_SERVER['PHP_SELF']."?m=$m&a=$a\"> &raquo; </a>";
        }
    }
}
 
//FONCTION POUR AFFICHER LE MOINS PRECEDENT
function mois_precedent($m,$mois,$a){
    $m--;
    if($m==0){
        $a--;
        $m=12;
    }
    if(isset($_GET['page']))
    {
        return '<a href="'.$_SERVER['PHP_SELF'] . "?m=$m&a=$a" . '&page=' . $_GET['page'] . '"> &laquo; </a>';
    }
    else
    {
        if(isset($_GET['eventId']))
        {
            return '<a href="'.$_SERVER['PHP_SELF'] . "?m=$m&a=$a" . '&eventId=' . $_GET['eventId'] . '"> &laquo; </a>';
        }
        else
        {
            return '<a href="'.$_SERVER['PHP_SELF']."?m=$m&a=$a\"> &laquo; </a>";
        }
    }
}
?>