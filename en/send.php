<?php

/*Description of the following lines*/
/*
set the names of variables received from the form on share.html
*/

//-----set variables-----//
$plant_id=$_POST['plant_id'];
$recipe_name=$_POST['recipe_name'];
$overview=htmlspecialchars($_POST['overview']);
$timeperiod = $_POST['timeperiod'];
$time_unit_id = $_POST['time_unit'];
$level_id = $_POST['level'];
$instructions = $_POST['instructions'];
$goals = $_POST['goals'];
$ingredients=$_POST['ingredients'];
$quantities=$_POST['quantities'];
$units=$_POST['units'];
$weather=$_POST['weather'];
$goals=$_POST['goals'];
$type=$_POST['type'];
$weather_arr=serialize($weather);
$goals_arr=serialize($goals);
$soil_id=$_POST['soil_id'];
//-----set variables-----//

/*Description of the following lines*/
/*
connecting the PHP file to the database named 'fertilizer_recipe'
host:
username:
password:
Then, check if the connection is valid.
*/

//-----connecting-----//
$con = mysqli_connect("localhost","alicornt_sharep","xgGXHBuQWu","alicornt_sharep");
//-----connecting-----//

//-----check connection-----//
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//-----check connection-----//

/*Description of the following lines*/
/*
insert the following variables into the fields in database named 'recipes'

[variable] -> [field name]
recipe_id is automatically incremented
$recipe_name -> recipe_name
$type -> type_id
$plant_id -> plant_id
$goals_arr -> goals
$weather_arr ->weather
$timeperiod -> period
$time_unit_id -> time_unit_id
$soil_id -> soil_id
$level_id -> level_id
'' -> user_id
$overview -> overview
CURRENT_TIMESTAMP -> add_date
*/

//----------------------add to 'recipes' table-----------------//
$recipe_insert = "INSERT INTO `recipes` (`recipe_id`, `recipe_name`,`type_id`, `plant_id`, `goals`, `weather`, `period`, `time_unit_id`, `soil_id`, `level_id`, `user_id`, `overview`, `add_date`) 
VALUES (NULL, '$recipe_name','$type', '$plant_id', '$goals_arr','$weather_arr', '$timeperiod', '$time_unit_id', '$soil_id', '$level_id', '', '$overview', CURRENT_TIMESTAMP)";
//----------------------add to 'recipes' table-----------------//

//-----check if is added into 'recipes'-----//
if ($con->query($recipe_insert) === TRUE) {
	//echo "New recipe added!"."<br>";
} else {
	echo "Error: " . $recipe_insert . "<br>" . $con->error;
}
//-----check if is added into'recipes'-----//

/*Description of the following lines*/
/*
I query the recently added recipe by searching the line of 'recipes' table, of which $recipe_name matches the field 'recipe_name'. 
The id is stored in a new variable named '$this_id' 
Not too efficient :(
*/

//-----getting current recipe ID-----//
$query_recipe = "SELECT * FROM recipes WHERE recipe_name='$recipe_name'";
$result_recipe = $con->query($query_recipe);
while($row_recipe = $result_recipe->fetch_array())
{
  //echo "<tr>";
  //echo "<td>".$row['recipe_id'] . "</td>";
  //echo "<td>".$row['recipe_name'] . "</td>";
  $this_id=$row_recipe['recipe_id'];
}
//-----getting current recipe ID-----//

/*Description of the following lines*/
/*
I use the recipe_id I just queried from the 'recipes' table to insert instructions into 'instructions' table. 
Instructions are stored in array. Thus, I loop through the array and store in index($key) in 'myorder' field.
[variable] -> [field name]
$this_id -> $recipe_id
$key -> myorder
$value -> instruction
*/

//-----insert instructions into 'instructions' table-----//
foreach($instructions as $key => $value){

    $instruction_insert = "INSERT INTO `instructions`(`recipe_id`, `myorder`, `instruction`) VALUES ('$this_id','$key','$value')";
    //-----check if is added into 'instructions'-----//
    if ($con->query($instruction_insert) === TRUE) {
        //echo "Instruction ".$key." of id ".$this_id." added!"."<br>";
    } else {
        echo "Error: " . $instruction_insert . "<br>" . $con->error;
    }
    //-----check if is added into 'instructions'-----//
}
//-----insert instructions into 'instructions' table-----//

/*Description of the following lines*/
/*
The ingredients and their quantities and units are stored in arrays. I loop through three arrays and store the same order of each one into
each row of 'recipes_ingredients' table. For example, 
'water 1 litre' and 'leaves 2 gram' are stored in the following format:
$ingredients= {water,leaves}
$quantities= {1,2}
$units={litre,gram}

[variable] -> [field name]
$this_id -> recipe_id
$this_ingredient -> ingredient
$this_quantity -> quantity
$this_unit_id -> unit_id
*/

//-----add ingredients to 'recipes_ingredient' table-----//
$keys=array_keys($ingredients);
$l=count($ingredients);
//echo "<br>"."CHECK INGREDIENTS"."<br>";
for ($i=0;$i<$l;$i++) {
    $key=$keys[$i];
    $this_ingredient=$ingredients[$key];
    $this_quantity=$quantities[$key];
    $this_unit_id=$units[$key];

    //-----printing values to insert to ingredient row-----//
    //echo $i."<br>";
    //echo "ingredient: "."{$this_ingredient}"."<br>";
    //echo "quantity: "."{$this_quantity}"."<br>";
    //echo "unit: "."{$this_unit}"."<br>";
    //-----printing values to insert to ingredient row-----//

    $ingredient_insert = "INSERT INTO `recipes_ingredients`(`recipe_id`, `ingredient`, `quantity`,`unit_id`) VALUES ('$this_id','$this_ingredient','$this_quantity','$this_unit_id')";
    
    //-----check if is added-----//
    if ($con->query($ingredient_insert) === TRUE) {
        //echo "Ingredient+quantity+unit ".$key." of id ".$this_id." added!"."<br>";
    } else {
        echo "Error: " . $ingredient_insert . "<br>" . $con->error;
    }
    //-----check if is added-----//
}
//-----add ingredients to 'recipes_ingredient' table-----//

?>