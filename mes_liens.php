<!DOCTYPE html> 
<html>
  <head>
    <meta charset="utf-8" />
    <title>Mes liens</title>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');

        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]); 

        // Set chart options
        var options = {'title':'Utilisation de vos url',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body style='margin:0;'>

<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");
include_once("Membre.php");
include_once("Utilisation.php");
enteteHTML("Mes liens");


if(!empty($_SESSION['connex_active'])) {

  if(!empty($_SESSION['connex_active']))
    barreConnexion($_SESSION['connex_active']);

  echo "<h2 style='text-align:center'>Mes liens</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='deconnexion.php'>Me deconnecter</a></td></tr>";
  echo "</table>"; 

  // on récupère l'ID de l'auteur pour
  // enuite ressortir ses liens :
  $id_author = Membre::getIdFromPseudo($_SESSION['connex_active']);
  $tab = Url::getUrlByAuthor($id_author);
   
  // affichage du tableau de mes liens :
  echo "<table border='5' style='margin:auto'>
    <tr>
      <th>id</th>
      <th>source</th>
      <th>courte</th>
      <th>utilisation</th>
      <th>creation</th>
      <th>auteur</th>
      <th>suppr</th>
    </tr>";
  foreach( $tab as $res) {
    echo "<tr>";
      echo "<td>$res->id</td>";
      echo "<td>$res->source</td>";
      echo "<td>$res->courte</td>";

      echo "<td>";
      echo Utilisation::countByUrl($res->id);
      echo "</td>";

      echo "<td>$res->creation</td>";

      echo "<td>";
      echo Membre::getPseudoFromId($res->auteur);
      echo "</td>";
  	
    	echo "<td><a href='suppr_liens.php?id=" . $res->id . "'>supprimer</a>";
  	echo "</tr>";
  }
  echo "</table>";

  echo "<div id='chart_div'></div>";

}
else {
  header("Location: index.php");
}

finHTML();
?>
