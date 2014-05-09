<?php

/**
 * Classe qui permet de modéliser un tableau HTML
 */
class Tableau {
	var $header;
	var $content;
	var $nb_col;

	/**
	 * Constructeur d'un tableau HTML
	 */
	function Tableau($tab_headers) {
		$this->nb_col = 0;
		foreach($tab_headers as $col) {
			$this->header[$this->nb_col] = $col;
			$this->nb_col++;
		}
	}


	/**
	 * Methode qui permet d'ajouter une ligne au tableau
	 */
	function add_line($tab_line) {
		if( count($tab_line) == $this->nb_col ) {
			$this->content[] = $tab_line;
		}
	}


	/**
	 * Methode qui permet d'afficher le tableau
	 */
	function afficher() {
		echo "<table border='1' style='margin:auto'>";
		echo "<tr>";
		foreach ($this->header as $key => $value) 
			echo "<th>" . $value . "</th>";
		echo "</tr>";

		foreach ($this->content as $key => $value) {
			echo "<tr>";
			foreach ($value as $key2 => $value2) 
				echo "<td>" . $value2 . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}

}

?>