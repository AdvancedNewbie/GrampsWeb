<?php
/**************************
/*Basic Select All Queries
***************************/

function getFamilies($conn) {
    $sql = 'SELECT * FROM families';
    return $conn->query($sql);
}

function getMarriages($conn) {
    $sql = 'SELECT * FROM marriages';
    return $conn->query($sql);
}

function getMedia($conn) {
    $sql = 'SELECT * FROM media';
    return $conn->query($sql);
}

function getMediaTags($conn) {
    $sql = 'SELECT * FROM mediatags';
    return $conn->query($sql);
}

function getPeople($conn) {
    $sql = 'SELECT * FROM people';
    return $conn->query($sql);
}

function getPlaces($conn) {
    $sql = 'SELECT * FROM places';
    return $conn->query($sql);
}

//Get Oldest People In Tree (i.e. without a family entry).  These will be the top nodes in the family tree
function getOldestPeopleInTree($conn) {
	$sql = 'SELECT * FROM people WHERE NOT EXISTS (SELECT * FROM families WHERE families.id_child = people.id_person);';
	return $conn->query($sql);
}

//Returns an nested-arrays of tree
function getNestedTreeArray($conn) {
	return $array = 
		array("Me",
			array("Parent 1",
				array("Grandpa 1", 
					array("Click to Add", "Click to Add")
				),
				array("Grandma 1", 
					array("Click to Add", "Click to Add")
				)

			),
			array("Parent 2",
				array("Grandpa 2", 
					array("Click to Add", "Click to Add")
				),
				array("Grandma 2", 
					array("Click to Add", "Click to Add")
				)

			)

		);

			
		
}



?>