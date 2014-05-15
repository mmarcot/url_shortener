<?php
include_once("tools.php");
include_once("config.php");
include_once("Url.php");
include_once("Membre.php");
include_once("Modification.php");
include_once("Utilisation.php");
include_once("Tableau.php");


if(!empty($_SESSION['connex_active'])) {
?>

<!DOCTYPE html> 
  <html style='background-color: #F5FAFF;'>
    <head>
      <meta charset='utf-8' />
      <title>Mes liens</title>
        <!--Load the AJAX API-->
        <script type='text/javascript' src='https://www.google.com/jsapi'></script>
        <script type='text/javascript'>

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
          data.addColumn('string', 'Lien');
          data.addColumn('number', 'Utilisation');
          data.addRows([

<?php  
$id_pseudo = Membre::getIdFromPseudo($_SESSION['connex_active']);
$liste_url_aut = Url::getUrlByAuthor($id_pseudo);

foreach ($liste_url_aut as $value) {
  echo "['" . Url::getCibleById($value->id) . "'," . Utilisation::countByUrl($value->id) . "],";
}
echo "]);";
?>
          // Set chart options
          var options = {'title':'Utilisation par lien', 
                         'backgroundColor':'#F5FAFF'};

          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        }
      </script>
    </head>
    <body style='margin:0;'>

<?php
  barreConnexion($_SESSION['connex_active']);

  echo "<h2 style='text-align:center'>Mes liens</h2>";

  echo "<table style='margin:auto; background:#EEEEEE; padding:8px'>";
  echo "<tr><td><a style='text-align:center;' href='mon_compte.php'>Mon compte</a></td></tr>";
  echo "<tr><td><a style='text-align:center;' href='index.php'>Retour accueil</a></td></tr>";
  echo "</table>"; 

  // En cas de modification (formulaire):
  if( !empty($_POST['id_m']) ) {
    if(!empty($_POST['source_m'])) {
      $_POST['source_m'] = strtolower(strip_tags(trim($_POST['source_m'])));
      Modification::modifSource($_POST['id_m'], $_POST['source_m']);
    }
    if(!empty($_POST['courte_m'])) {
      $_POST['courte_m'] = strtolower(strip_tags(trim($_POST['courte_m'])));
      Modification::modifCourte($_POST['id_m'], $_POST['courte_m']);
    }
  }

  // on récupère l'ID de l'auteur pour
  // ensuite ressortir ses liens :
  $id_author = Membre::getIdFromPseudo($_SESSION['connex_active']);
  $tab = Url::getUrlByAuthor($id_author);

  // on crée le tableau HTML et on l'affiche :  
  $tab_liens = new Tableau(array("id", "source", "courte", "utilisation", "creation", "auteur", "suppr", "modif"));
  foreach( $tab as $ligne)  {
    $tab_liens->add_line(array($ligne->id, $ligne->source, $ligne->courte, Utilisation::countByUrl($ligne->id), $ligne->creation, 
        Membre::getPseudoFromId($ligne->auteur), "<a href='suppr_liens.php?id=" . $ligne->id . "'>supprimer</a>", 
        "<a href='modif_lien.php?id=" . $ligne->id . "'>modifier</a>"));
  }
  $tab_liens->afficher();

  // affichage du graphique
  echo "<div id='chart_div' style='width:700px; height:300px; margin:auto;'></div>";

  finHTML();
}
else {
  header("Location: index.php");
}
?>
