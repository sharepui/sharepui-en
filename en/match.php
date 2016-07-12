<?php

	//----- include other files to use their functions-----//
	include 'query_by_recipe_id.php';

	//-----Connecting-----//
	$con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
	//-----Connecting-----//

	//-----check connection-----//
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//-----check connection-----//
	
	//-----make the stuff the the user filled in the form variables-----//
	$zero=0;
	$one=1;
	$two=2;
	$three=3;
	$four=4;
	$plant_id=$_POST['plant_id'];
	$goals=$_POST['goals'];
	$goals_arr=implode(" ",$goals);
	$type=$_POST['type'];
	$weather=$_POST['weather'];
	$weather_arr=implode(" ",$weather);
	$timeperiod = $_POST['timeperiod'];
	$time_unit_id = $_POST['time_unit'];
	$time_limit=getDays($timeperiod,$time_unit_id);
	$soil_id=$_POST['soil_id'];
	$level_id = $_POST['level'];
	$goal_key=makeGoalsKey($goals);
	$weather_key=makeWeatherKey($weather);
	//-----make the stuff the the user filled in the form variables-----//

	//-----functions-----//

	/*if $a is less than $b return true*/
	function isLessThan($a,$b) {
		if ($a<$b) {
			return true;
		}
		return false;
	}

	/*goals are stored in this format: a:2:{i:0;s:1:"1";i:1;s:1:"3";} This means 2 boxes are checked and the values are "1" and 
	3"*/
	function makeGoalsKey($goals) {
		$goal_key="";
		if(!empty($goals)){
		// Loop to store and display values of individual checked checkbox.
		foreach($goals as $selected_goal){
	    	//echo $selected_goal."</br>";
			$goal_key.="%";
			$goal_key.="\"".$selected_goal."\"";
		}

	}

	$goal_key.="%";
	//echo "goal_key: ".$goal_key."<br>";
	return $goal_key;
	}

	function makeWeatherKey($weather) {
		$weather_key="";
		if(!empty($weather)){
	// Loop to store and display values of individual checked checkbox.
		foreach($weather as $selected_weather){
	    //echo $selected_goal."</br>";
			$weather_key.="%";
			$weather_key.="\"".$selected_weather."\"";
		}
	}
	$weather_key.="%";
		return $weather_key;
	}

	/*getDays() function takes in two parameters: timeperiod and time unit
	it computes these period into the unit days*/
	function getDays($timeperiod,$time_unit_id) {

		$zero=0;
		$one=1;
		$two=2;
		$three=3;
		$four=4;
		$week_days=7;
		$month_days=31;
		$year_days=365;

		if ($time_unit_id==$one) {
			//echo "id is 1! <br>";
			return $timeperiod;
			//echo "EQUALS: ".$timeperiod." days"."<br>";
		}

		if ($time_unit_id==$two) {
			//echo "id is 2! <br>";
			return $timeperiod*$week_days;
			//echo "EQUALS: ".$timeperiod*$week_days." days"."<br>";
		}
		if ($time_unit_id==$three) {
			//echo "id is 3! <br>";
			return $timeperiod*$month_days;
			//echo "EQUALS: ".$timeperiod*$month_days." days"."<br>";
		}
		if ($time_unit_id==$four) {
			//echo "id is 4! <br>";
			return $timeperiod*$year_days;
			//echo "EQUALS: ".$timeperiod*$year_days." days"."<br>";
		}

		return 0;
	}

	function constructMatchQuery($plant_id,$goal_key,$type,$weather_key,$level_id,$soil_id) {
		$zero=0;
		if ($plant_id==$zero) {
		$ret_query = "SELECT *  FROM `recipes` 
		WHERE 
		`goals` LIKE '$goal_key'
		AND `type_id` LIKE '$type'
		AND `weather` LIKE '$weather_key'
		AND `level_id` LIKE $level_id 
		AND `soil_id` LIKE $soil_id  
		";

	 //if plant is any
	} else {
		$ret_query = "SELECT *  FROM `recipes` 
		WHERE 
		`plant_id` = $plant_id
		AND `goals` LIKE '$goal_key'
		AND `type_id` LIKE '$type'
		AND `weather` LIKE '$weather_key'
		AND `level_id` LIKE '$level_id'
		AND `soil_id` LIKE '$soil_id'  
		";
	}
		return $ret_query;
	}

	/*this function prints the table of the query. The parameter must be in this format
	$query="SELECT * FROM ........" and the timelimit as an int in days unit*/
	function printTable($query,$time_limit) {
		//----------Connecting-------------//
		$con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
		//----------Check connection-------------//
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		//----------Check connection-------------//
		//----------Connecting-------------//
		$result = $con->query($query);

		echo "<table class='table'>
		<tr class='info'>
		<th>recipe_id</th>
		<th>recipe_name</th>
		<th>plant_id</th>
		<th>type_id</th>
		<th>goals</th>
		<th>weather</th>
		<th>period</th>
		<th>time_unit_id</th>
		<th>soil_id</th>
		<th>level_id</th>
		<th>overview</th>
		</tr>";

		while($row = $result->fetch_array())
		{
			$this_recipe_time=getDays($row['period'],$row['time_unit_id']);
			//------display rows if the time is less than the time limit the user chooses----//
			if (isLessThan($this_recipe_time,$time_limit)) {
				echo "<tr>";
				echo "<td>".$row['recipe_id'] . "</td>";
				echo "<td>".$row['recipe_name'] . "</td>";
				echo "<td>".$row['plant_id'] . "</td>";
				echo "<td>".$row['type_id'] . "</td>";
				echo "<td>".$row['goals'] . "</td>";
				echo "<td>".$row['weather'] . "</td>";
				echo "<td>".$row['period'] . "</td>";
				echo "<td>".$row['time_unit_id'] . "</td>";
				echo "<td>".$row['soil_id'] . "</td>";
				echo "<td>".$row['level_id'] . "</td>";
				echo "<td>".$row['overview'] . "</td>";
				//echo "days of each result: ".getDays($row['period'],$row['time_unit_id'])."<br>";
			}
			
		}
		echo "</table>";
	}

//-----functions-----//

?>