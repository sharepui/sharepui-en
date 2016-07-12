<?php

/*query_by_recipe_id.php contains the following functions:

1. printFormattedRecipeInfo
	1 parameter: recipe id
	function: it takes recipe id in as a parameter to display the formatted information including recipe name, plant name, type name, overview
	goal names, weather names, level names, ingredients, and instructions.
2. printName
	1 parameter: recipe id
	function: it takes recipe id in as a parameter to display the name of the recipe
3. printBrief
	1 parameter: recipe id
	function: it takes recipe id in as a parameter to display the name, plant name, type name and the overview of the recipe
4. printDetailedRecipeInfo
	1 parameter: recipe id
	function: it takes recipe id in as a parameter to display everything. Used for testing.
*/

function printFormattedRecipeInfo($this_recipe_id) {

	//----------Connecting-------------//
	$con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
	//----------Check connection-------------//
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//----------Check connection-------------//
	//----------Connecting-------------//

	//-----------query the row of this recipe_id from recipes table-----------//
	$query_recipe = "SELECT *  FROM `recipes` WHERE recipe_id='$this_recipe_id'";
	$result_query_recipe = $con->query($query_recipe);
	$row_recipe = $result_query_recipe->fetch_array();
	//-----------query the row of this recipe_id from recipes table-----------//

	//---------------define variables storing the recipe's data---------------//
	$this_name=$row_recipe['recipe_name']; //string
	$this_plant_id=$row_recipe['plant_id']; //int
	$this_type_id=$row_recipe['type_id']; //int
	$this_goals=$row_recipe['goals']; //serialized array -> string
	$this_goals_arr=unserialize($this_goals); //unserialized string -> array
	$this_weather=$row_recipe['weather']; //serialized array -> string
	$this_weather_arr=unserialize($this_weather); //unserialized string -> array

	$this_period=$row_recipe['period'];
	$this_time_unit_id=$row_recipe['time_unit_id'];
	$this_soil_id=$row_recipe['soil_id'];
	$this_level_id=$row_recipe['level_id'];
	$this_overview=$row_recipe['overview'];
	//---------------define variables storing the recipe's data---------------//

	//---------------------------printing defined variables----------------------//

	//---------------------------printing defined variables-----------------//
	//GETTING NAME
	
	echo  "<strong>"."RECIPE NAME"."</strong>"."<br>";
	echo $this_name."<br>";

	//GETTING PLANT NAME OF THIS PLANT ID
	echo "<br>"."<strong>"."PLANT NAME"."</strong>"."<br>";
	$query_plant_name = "SELECT * FROM plants WHERE plant_id='$this_plant_id'";
	$result_query_plant_name = $con->query($query_plant_name);
	$row_this_plant_name = $result_query_plant_name->fetch_array();
	$this_plant_name=$row_this_plant_name['plant_name'];
	echo $this_plant_name."<br>";

	//GETTING TYPE NAME OF THIS PLANT ID
	echo "<br>"."<strong>"."FERTILIZER TYPE"."</strong>"."<br>";
	$query_type_name = "SELECT * FROM types WHERE type_id='$this_type_id'";
	$result_query_type_name = $con->query($query_type_name);
	$row_this_type_name = $result_query_type_name->fetch_array();
	$this_type_name=$row_this_type_name['types'];
	echo $this_type_name."<br>";

	//GETTING OVERVIEW
	echo "<br>"."<strong>"."OVERVIEW"."</strong>"."<br>";
	echo $this_overview."<br>";

	//GETTING GOAL NAMES OF THIS GOAL IDs
	echo "<br>"."<strong>"."WHAT DOES THIS RECIPE DO?"."</strong>"."<br>";
	$query_goals = "SELECT * FROM goals";
	$result_query_goals = $con->query($query_goals);
	while($row_goal = $result_query_goals->fetch_array())
	{
		if (in_array($row_goal['goals_id'],$this_goals_arr)) {
	            //echo "Weather id: ".$row_weather['weather_id']." ";
			echo $row_goal['goal_text'] . "<br>";
		}  
	}

	//GETTING WEATHER NAMES OF THIS WEATHER IDs
	echo "<br>"."<strong>"."SUITABLE IN THE FOLLOWING WEATHER"."</strong>"."<br>";
	$query_weather = "SELECT * FROM weather";
	$result_query_weather = $con->query($query_weather);
	while($row_weather = $result_query_weather->fetch_array())
	{
		if (in_array($row_weather['weather_id'],$this_weather_arr)) {
	            //echo "Weather id: ".$row_weather['weather_id']." ";
			echo $row_weather['weather'] . "<br>";
		}  
	}

	//GETTING TIME PERIOD 
	echo "<br>"."<strong>"."HOW LONG DOES IT TAKE?"."</strong>"."<br>";
	echo $this_period." ";

	//GETTING NAME OF TIME UNIT ID
	$query_time_unit_name = "SELECT * FROM time_units WHERE time_unit_id='$this_time_unit_id'";
	$result_query_time_unit_name = $con->query($query_time_unit_name);
	$row_this_time_unit_name = $result_query_time_unit_name->fetch_array();
	$this_time_unit_name=$row_this_time_unit_name['time_unit'];
	echo $this_time_unit_name."<br>";


	//GETTING NAME OF THIS SOIL ID
	echo "<br>"."<strong>"."SOIL TYPE"."</strong>"."<br>";
	$query_soil_name = "SELECT * FROM soil_types WHERE soil_types_id='$this_soil_id'";
	$result_query_soil_name = $con->query($query_soil_name);
	$row_this_soil_name = $result_query_soil_name->fetch_array();
	$this_soil_name=$row_this_soil_name['soil_types'];
	echo $this_soil_name."<br>";

	//GETTING NAME OF THIS LEVEL ID
	echo "<br>"."<strong>"."DIFFICULTY"."</strong>"."<br>";
	$query_level_name = "SELECT * FROM levels WHERE level_id='$this_level_id'";
	$result_query_level_name = $con->query($query_level_name);
	$row_this_level_name = $result_query_level_name->fetch_array();
	$this_level_name=$row_this_level_name['level'];
	echo $this_level_name."<br>";

	//GETTING INGREDIENTS
	//getting all if recipe_id == this_recipe_id
	echo "<br>"."<strong>"."INGREDIENTS"."</strong>"."<br>";
	$query_ingredients = "SELECT * FROM recipes_ingredients WHERE recipe_id='$this_recipe_id'";
	$result_ingredients = $con->query($query_ingredients);
	$count=1;
	while($row_result_ingredients = $result_ingredients->fetch_array())
	
	{
		echo $count.". ";
		echo $row_result_ingredients['ingredient']." ";
		echo $row_result_ingredients['quantity']." ";
		//echo "Unit id: ".$row_result_ingredients['unit_id']."<br>";
		$this_unit_id=$row_result_ingredients['unit_id'];

		//getting unit name from unit id
		$query_unit_name = "SELECT * FROM units WHERE unit_id='$this_unit_id'";
		$result_query_unit_name = $con->query($query_unit_name);
		$row_this_unit_name = $result_query_unit_name->fetch_array();
		$this_unit_name=$row_this_unit_name['unit'];
		echo $this_unit_name."<br>";
		$count++;
	}

	//GETTING INSTRUCTIONS
	//getting all if recipe_id == this_recipe_id
	$one=1;
	echo "<br>"."<strong>"."INSTRUCTIONS"."</strong>"."<br>";
	$query_instructions = "SELECT * FROM instructions WHERE recipe_id='$this_recipe_id'";
	$result_instructions = $con->query($query_instructions);
	while($row_result_instructions = $result_instructions->fetch_array())
	{
		$order=$row_result_instructions['myorder']+$one;
		echo $order.". ";
		echo $row_result_instructions['instruction']."<br>";
	}
	echo "<br>";

	}


	function printName($this_recipe_id) {
		$con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
	//----------Check connection-------------//
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//----------Check connection-------------//
	//----------Connecting-------------//

	//-----------query the row of this recipe_id from recipes table-----------//
	$query_recipe = "SELECT *  FROM `recipes` WHERE recipe_id='$this_recipe_id'";
	$result_query_recipe = $con->query($query_recipe);
	$row_recipe = $result_query_recipe->fetch_array();
	//-----------query the row of this recipe_id from recipes table-----------//

	//---------------define variables storing the recipe's data---------------//
	$this_name=$row_recipe['recipe_name']; //string
	//GETTING NAME
	echo  "<strong>".$this_name."</strong>"."<br>";

	}

	function printBrief($this_recipe_id) {

		//----------Connecting-------------//
	 $con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
	//----------Check connec$contion-------------//
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//----------Check connection-------------//
	//----------Connecting-------------//

	//-----------query the row of this recipe_id from recipes table-----------//
	$query_recipe = "SELECT *  FROM `recipes` WHERE recipe_id='$this_recipe_id'";
	$result_query_recipe = $con->query($query_recipe);
	$row_recipe = $result_query_recipe->fetch_array();
	//-----------query the row of this recipe_id from recipes table-----------//

	//---------------define variables storing the recipe's data---------------//
	$this_name=$row_recipe['recipe_name']; //string
	$this_plant_id=$row_recipe['plant_id']; //int
	$this_type_id=$row_recipe['type_id']; //int
	$this_goals=$row_recipe['goals']; //serialized array -> string
	$this_goals_arr=unserialize($this_goals); //unserialized string -> array
	$this_weather=$row_recipe['weather']; //serialized array -> string
	$this_weather_arr=unserialize($this_weather); //unserialized string -> array

	$this_period=$row_recipe['period'];
	$this_time_unit_id=$row_recipe['time_unit_id'];
	$this_soil_id=$row_recipe['soil_id'];
	$this_level_id=$row_recipe['level_id'];
	$this_overview=$row_recipe['overview'];
	//---------------define variables storing the recipe's data---------------//

	//---------------------------printing defined variables----------------------//

	//---------------------------printing defined variables-----------------//
	//GETTING NAME
	//echo  "<strong>"."RECIPE NAME"."</strong>"."<br>";
	//echo $this_name."<br>";

	//GETTING PLANT NAME OF THIS PLANT ID
	echo "<br>"."<strong>"."PLANT NAME"."</strong>"."<br>";
	$query_plant_name = "SELECT * FROM plants WHERE plant_id='$this_plant_id'";
	$result_query_plant_name = $con->query($query_plant_name);
	$row_this_plant_name = $result_query_plant_name->fetch_array();
	$this_plant_name=$row_this_plant_name['plant_name'];
	echo $this_plant_name."<br>";

	//GETTING TYPE NAME OF THIS PLANT ID
	echo "<br>"."<strong>"."FERTILIZER TYPE"."</strong>"."<br>";
	$query_type_name = "SELECT * FROM types WHERE type_id='$this_type_id'";
	$result_query_type_name = $con->query($query_type_name);
	$row_this_type_name = $result_query_type_name->fetch_array();
	$this_type_name=$row_this_type_name['types'];
	echo $this_type_name."<br>";

	//GETTING OVERVIEW
	echo "<br>"."<strong>"."OVERVIEW"."</strong>"."<br>";
	echo $this_overview."<br>";

	}


	function printDetailedRecipeInfo($this_recipe_id) {

	//----------Connecting-------------//
	$con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
	//----------Check connection-------------//
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//----------Check connection-------------//
	//----------Connecting-------------//

	//-----------query the row of this recipe_id from recipes table-----------//
	$query_recipe = "SELECT *  FROM `recipes` WHERE recipe_id='$this_recipe_id'";
	$result_query_recipe = $con->query($query_recipe);
	$row_recipe = $result_query_recipe->fetch_array();
	//-----------query the row of this recipe_id from recipes table-----------//

	//---------------define variables storing the recipe's data---------------//
	$this_name=$row_recipe['recipe_name']; //string
	$this_plant_id=$row_recipe['plant_id']; //int
	$this_type_id=$row_recipe['type_id']; //int
	$this_goals=$row_recipe['goals']; //serialized array -> string
	$this_goals_arr=unserialize($this_goals); //unserialized string -> array
	$this_weather=$row_recipe['weather']; //serialized array -> string
	$this_weather_arr=unserialize($this_weather); //unserialized string -> array

	$this_period=$row_recipe['period'];
	$this_time_unit_id=$row_recipe['time_unit_id'];
	$this_soil_id=$row_recipe['soil_id'];
	$this_level_id=$row_recipe['level_id'];
	$this_overview=$row_recipe['overview'];
	//---------------define variables storing the recipe's data---------------//

	//---------------------------printing defined variables----------------------


	//-------------------------------------PRINT TABLE----------------------//

	
	echo "PRINTING A ROW FROM THE TABLE";

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

	echo "<tr>";
	echo "<td>".$this_recipe_id. "</td>";
	echo "<td>".$this_name. "</td>";
	echo "<td>".$this_plant_id. "</td>";
	echo "<td>".$this_type_id. "</td>";
	echo "<td>".$this_goals . "</td>";
	echo "<td>".$this_weather. "</td>";
	echo "<td>".$this_period. "</td>";
	echo "<td>".$this_time_unit_id. "</td>";
	echo "<td>".$this_soil_id. "</td>";
	echo "<td>".$this_level_id. "</td>";
	echo "<td>".$this_overview. "</td>";
	echo "</table>";
	//-------------------------------------PRINT TABLE----------------------//



	//---------------------------printing defined variables-----------------//
	//GETTING NAME
	echo  "<br>"."<strong>"."GETTING RECIPE NAME"."</strong>"."<br>";
	echo $this_name."<br>";

	//GETTING PLANT_ID
	echo "<br>"."<strong>"."GETTING PLANT ID"."</strong>"."<br>";
	echo $this_plant_id."<br>";

	//GETTING PLANT NAME OF THIS PLANT ID
	echo "<br>"."<strong>"."GETTING PLANT NAME"."</strong>"."<br>";
	$query_plant_name = "SELECT * FROM plants WHERE plant_id='$this_plant_id'";
	$result_query_plant_name = $con->query($query_plant_name);
	$row_this_plant_name = $result_query_plant_name->fetch_array();
	$this_plant_name=$row_this_plant_name['plant_name'];
	echo $this_plant_name."<br>";

	//GETTING TYPE NAME OF THIS PLANT ID
	echo "<br>"."<strong>"."GETTING TYPE NAME"."</strong>"."<br>";
	$query_type_name = "SELECT * FROM types WHERE type_id='$this_type_id'";
	$result_query_type_name = $con->query($query_type_name);
	$row_this_type_name = $result_query_type_name->fetch_array();
	$this_type_name=$row_this_type_name['types'];
	echo $this_type_name."<br>";

	//GETTING GOAL NAMES OF THIS GOAL IDs
	echo "<br>"."<strong>"."GETTING GOAL NAMES"."</strong>"."<br>";
	$query_goals = "SELECT * FROM goals";
	$result_query_goals = $con->query($query_goals);
	while($row_goal = $result_query_goals->fetch_array())
	{
		if (in_array($row_goal['goals_id'],$this_goals_arr)) {
	            //echo "Weather id: ".$row_weather['weather_id']." ";
			echo $row_goal['goal_text'] . "<br>";
		}  
	}

	//GETTING WEATHER NAMES OF THIS WEATHER IDs
	echo "<br>"."<strong>"."GETTING WEATHER NAMES"."</strong>"."<br>";
	$query_weather = "SELECT * FROM weather";
	$result_query_weather = $con->query($query_weather);
	while($row_weather = $result_query_weather->fetch_array())
	{
		if (in_array($row_weather['weather_id'],$this_weather_arr)) {
	            //echo "Weather id: ".$row_weather['weather_id']." ";
			echo $row_weather['weather'] . "<br>";
		}  
	}

	//GETTING TIME PERIOD 
	echo "<br>"."<strong>"."GETTING TIME PERIOD"."</strong>"."<br>";
	echo $this_period."<br>";

	//GETTING NAME OF TIME UNIT ID
	echo "<br>"."<strong>"."GETTING TIME UNIT NAME"."</strong>"."<br>";
	$query_time_unit_name = "SELECT * FROM time_units WHERE time_unit_id='$this_time_unit_id'";
	$result_query_time_unit_name = $con->query($query_time_unit_name);
	$row_this_time_unit_name = $result_query_time_unit_name->fetch_array();
	$this_time_unit_name=$row_this_time_unit_name['time_unit'];
	echo $this_time_unit_name."<br>";


	//GETTING NAME OF THIS SOIL ID
	echo "<br>"."<strong>"."GETTING SOIL NAME"."</strong>"."<br>";
	$query_soil_name = "SELECT * FROM soil_types WHERE soil_types_id='$this_soil_id'";
	$result_query_soil_name = $con->query($query_soil_name);
	$row_this_soil_name = $result_query_soil_name->fetch_array();
	$this_soil_name=$row_this_soil_name['soil_types'];
	echo $this_soil_name."<br>";

	//GETTING NAME OF THIS LEVEL ID
	echo "<br>"."<strong>"."GETTING LEVEL NAME"."</strong>"."<br>";
	$query_level_name = "SELECT * FROM levels WHERE level_id='$this_level_id'";
	$result_query_level_name = $con->query($query_level_name);
	$row_this_level_name = $result_query_level_name->fetch_array();
	$this_level_name=$row_this_level_name['level'];
	echo $this_level_name."<br>";

	//GETTING INSTRUCTIONS
	//getting all if recipe_id == this_recipe_id
	$one=1;
	echo "<br>"."<strong>"."GETTING INSTRUCTIONS"."</strong>"."<br>";
	$query_instructions = "SELECT * FROM instructions WHERE recipe_id='$this_recipe_id'";
	$result_instructions = $con->query($query_instructions);
	while($row_result_instructions = $result_instructions->fetch_array())
	{
		$order=$row_result_instructions['myorder']+$one;
		echo "Order: ".$order."<br>";
		echo "Instruction: ".$row_result_instructions['instruction']."<br>";
	}

	//GETTING INGREDIENTS
	//getting all if recipe_id == this_recipe_id
	echo "<br>"."<strong>"."GETTING INGREDIENTS"."</strong>"."<br>";
	$query_ingredients = "SELECT * FROM recipes_ingredients WHERE recipe_id='$this_recipe_id'";
	$result_ingredients = $con->query($query_ingredients);
	while($row_result_ingredients = $result_ingredients->fetch_array())
	{
		echo "Ingredient: ".$row_result_ingredients['ingredient']."<br>";
		echo "Quantity: ".$row_result_ingredients['quantity']."<br>";
		echo "Unit id: ".$row_result_ingredients['unit_id']."<br>";
		$this_unit_id=$row_result_ingredients['unit_id'];

		//getting unit name from unit id
		$query_unit_name = "SELECT * FROM units WHERE unit_id='$this_unit_id'";
		$result_query_unit_name = $con->query($query_unit_name);
		$row_this_unit_name = $result_query_unit_name->fetch_array();
		$this_unit_name=$row_this_unit_name['unit'];
		echo $this_unit_name."<br>"."<br>";
	}

	//GETTING OVERVIEW
	echo "<strong>"."GETTING OVERVIEW"."</strong>"."<br>";
	echo $this_overview."<br>";

	}


?>