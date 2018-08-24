<link rel="stylesheet" type="text/css" href="style.css"></head>

<?php
define("DEBUGGING_ENABLED", 0);

include("sql_connection.php");
include("common_queries.php");

if (DEBUGGING_ENABLED){
}
?>
<!--
We will create a family tree using just CSS(3)
The markup will be simple nested lists
-->
<div class="tree">

<?php

	$nestedarray = getNestedTreeArray($conn);
	$endOfBranch = false;
	$endBranch1 = "";
	$endBranch2 = "";
	$branchDepth = 0;
	$lastBranchDepth = 0;	
	
	function tabOverEcho($string){

		echo  "\n" . str_repeat("\t" , $GLOBALS['branchDepth'] ) . $string;
	}
	
	function r($element, $endOfBranch, $endBranch1, $endBranch2) {
		

		
		foreach ($element as $value) {
			if (DEBUGGING_ENABLED){
				if (!is_array($value)){
					echo "</br></br>element: " . $value;
					
				} else {
					echo "</br>";
					echo "element: {array, size: " . sizeof($value) . "}";
					
					r($element[1], $arraysInARow + 1);
				}
			} else { //not debugging (make list)
			
				if (!is_array($value)){
					if ($endOfBranch){
						tabOverEcho("<a href=\"#\">" . $endBranch1. "</a>");
						tabOverEcho("</li>");	
						tabOverEcho("<li>");
						tabOverEcho("<a href=\"#\">" . $endBranch2. "</a>");
						tabOverEcho("</li>");
						$lastBranchDepth = $GLOBALS['branchDepth'];
						$GLOBALS['branchDepth']--;
						
						//$endOfBranch = false; //reset
						
						break;
					} else {
						tabOverEcho("<a href=\"#\">" . $value . "</a>");
						$GLOBALS['branchDepth']++;
					}

					
				} else {
					if (!is_array($value[1])){
						tabOverEcho("<!--" . $value[0] . ", " . $value[1] . "  branchDepth: " . $GLOBALS['branchDepth'] . "-->");
					} else{
						tabOverEcho("<!--" . $value[0] . ", ARRAY " . " branchDepth: " . $GLOBALS['branchDepth'] . "-->");

					}
					
					if (!$endOfBranch) {
						//tabOverEcho("<ul>");
					}

					if (!is_array($value[1])){ //if next value in series is not an array
						echo "\n<!--" . "END OF BRANCH DETECTED" . " branchDepth: " . $GLOBALS['branchDepth'] . "-->";
						$endOfBranch = true;
						$endBranch1 = $value[0];
						$endBranch2 = $value[1];
						
					} else {
						echo "\n<!--" . "NOT END OF BRANCH" . " branchDepth: " . $GLOBALS['branchDepth'] . "-->";
						$endOfBranch = false;
						
					}

					tabOverEcho("<!--" . "CALLING FUNCTION r" . " branchDepth: " . $GLOBALS['branchDepth'] ."-->");
					
					if($GLOBALS['lastBranchDepth'] != $GLOBALS['branchDepth']){
						tabOverEcho("<ul>");
					}
					tabOverEcho("<li>");  //THESE ARE CORRECT
					
					r($value, $endOfBranch, $endBranch1, $endBranch2);
					echo "\n<!--" . "RETURNED FROM FUNCTION r" . " branchDepth: " . $GLOBALS['branchDepth'] . "-->";

					if ($GLOBALS['lastBranchDepth'] == $GLOBALS['branchDepth']){
						tabOverEcho("<!--" . "END OF BRANCH" . "  branchDepth: " . $GLOBALS['branchDepth'] .  "-->");
						tabOverEcho("\t</ul>");
						tabOverEcho("</li>");
					}
				}
			}
			
			
		} //end foreach
	}
	
	echo "<ul>";
	echo "\n<!--" . "CALLING FUNCTION r" . "-->";
	echo "\n<li>";
	r($nestedarray, $endOfBranch, $endBranch1, $endBranch2,);
	echo "\n</ul>";

	
?>

</div>

<!--

<div class="tree">
	<ul>
		<li>
			<a href="#">Parent 1 </a>
			<a href="#">Parent 2</a>
		  
			<ul>
				<li>
					<a href="#">Child</a>
					<ul>
						<li>
							<a href="#">Grand Child</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">Child</a>
						<ul>
							<li>
								<a href="#">Grand Child</a>
							</li>
							<li>
								<a href="#">Grand Child</a>
								<ul>
									<li>
										<a href="#">Great Grand Child</a>
									</li>
									<li>
										<a href="#">Great Grand Child</a>
									</li>
									<li>
										<a href="#">Great Grand Child</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#">Grand Child</a>
							</li>
						</ul>
				</li>
			</ul>
		</li>
	</ul>
</div>

-->