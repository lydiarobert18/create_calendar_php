<!DOCTYPE html>
<html>

      <head>
        <!--Here goes the intelligence of the page-->
        <meta charset="utf-8" />      
        <title>créer calendrier</title>
       
        <link rel="stylesheet" href="style.css" />

      </head> 

      <body>

<?php include 'cal_event.php' ?>


<div class='mois'>
<?php 



//print_r($resultat_mois);
echo '<h2>les évenements du mois</h2>';
foreach($resultats as $resultat){

echo '<p>'.$resultat['event_descr'].'</p>';
echo '<p>'.$resultat['event_date'].'</p>';

}


 ?>
 </div>

 <div class='hidden'>
 	<?php 

echo '<h3>les évenements du jour</h3>';

foreach($idresultats as $idresultat){

echo '<p>'.$idresultat['time'].'heures: '.$idresultat['event_descr'].'</p>';
 

 }  ?>
 	 
 </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">


$('td a').click(function(){
  $('.hidden').show();

});



</script>
</body>
</html>