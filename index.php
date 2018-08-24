<?php
define("DEBUGGING_ENABLED", 1);

include("sql_connection.php");
include("common_queries.php");

if (DEBUGGING_ENABLED){
	echo "</br><br>People List:</br>";
	
	foreach (getPeople($conn) as $row) {
		print "</br>id_person: " . $row['id_person'] . "\t\t surname: " . $row['surname'] . "\t\t given: " . $row['given'] . "\n";
	}

	echo "</br><br>Families List:</br>";

	foreach (getFamilies($conn) as $row) {
		print "</br>id_relationship: " . $row['id_relationship'] . "\t\t family: " . $row['id_family'] . "\t\t child: " . $row['id_child'] . "\n";
	}	
	
	echo "</br><br>Marriages List:</br>";

	foreach (getMarriages($conn) as $row) {
		print "</br>id_family: " . $row['id_family'] . "\t\t id_husband: " . $row['id_husband'] . "\t\t id_wife: " . $row['id_wife'] . "\n";
	}	
	
	echo "</br><br>Oldest People List (Top Nodes):</br>";

	foreach (getOldestPeopleInTree($conn) as $row) {
		print "</br>id_person: " . $row['id_person'] . "\t\t surname: " . $row['surname'] . "\t\t given: " . $row['given'] . "\n";
	}	

}
	
?>

</br>

