<?php

//----------Connecting-------------//
$con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
//----------Check connection-------------//
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//----------Check connection-------------//
//----------Connecting-------------//

echo "Printing stuff from the form: <br>";

$zero=0;
$plant_id=$_POST['plant_id'];
$goals=$_POST['goals'];
$goals_arr=implode(" ",$goals);
$type=$_POST['type'];
$weather=$_POST['weather'];
$weather_arr=implode(" ",$weather);
$timeperiod = $_POST['timeperiod'];
$time_unit_id = $_POST['time_unit'];
$soil_id=$_POST['soil_id'];
$level_id = $_POST['level'];
$goal_key="";
$weather_key="";

//-----------printing stuff from the form---------//
echo "plant id: ".$plant_id."<br>";
echo "goals array: ".$goals_arr."<br>";
echo "type: ".$type."<br>";
echo "weather array: ".$weather_arr."<br>";
echo "time period: ".$timeperiod."<br>";
echo "time unit id: ".$time_unit_id."<br>";
echo "level id: ".$level_id."<br>";
echo "soil id: ".$soil_id."<br>";
//-----------printing stuff from the form---------//

//-------------------constructing goal_key for search---------------//
if(!empty($goals)){
// Loop to store and display values of individual checked checkbox.
	foreach($goals as $selected_goal){
    //echo $selected_goal."</br>";
		$goal_key.="%";
		$goal_key.=$selected_goal;
	}
}
$goal_key.="%";
echo "goal_key: ".$goal_key."<br>";
//-------------------constructing goal_key for search---------------//

//-------------------constructing weather_key for search---------------//
if(!empty($weather)){
// Loop to store and display values of individual checked checkbox.
	foreach($weather as $selected_weather){
    //echo $selected_goal."</br>";
		$weather_key.="%";
		$weather_key.=$selected_weather;
	}
}
$weather_key.="%";
echo "weather_key: ".$weather_key;
//-------------------constructing weather_key for search---------------//

//--------------------querying-------------------//

//if plant is chosen
if ($plant_id==$zero) {
	$query = "SELECT *  FROM `recipes` 
	WHERE 
	`goals` LIKE '$goal_key'
	AND `type_id` LIKE '$type'
	AND `weather` LIKE '$weather_key'
	AND `level_id` LIKE $level_id 
	AND `soil_id` LIKE $soil_id  
	";

 //if plant is any
} else {
	$query = "SELECT *  FROM `recipes` 
	WHERE 
	`plant_id` = $plant_id
	AND `goals` LIKE '$goal_key'
	AND `type_id` LIKE '$type'
	AND `weather` LIKE '$weather_key'
	AND `level_id` LIKE '$level_id'
	AND `soil_id` LIKE '$soil_id'  
	";
}

//--------------------querying-------------------//

//-------------------printing table-------------------------//
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
}

echo "</table>";
//-------------------printing table-------------------------//

?>