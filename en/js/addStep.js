var counter = 1;
var counter_goal=1;
var limit_goal=5;
var limit = 10;
function addStep(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }

     else {
     	var para = document.createElement("div");
     	var div = document.getElementById(divName),
    	     clone = div.cloneNode(true); // true means clone all childNodes and all event handlers

          var newdiv = document.createElement('div');
          newdiv.innerHTML = "Step " + (counter + 1) + " <br><input class='form-control' type='text' name='instructions[]'>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}

function addGoals(divName){
     if (counter_goal == limit_goal)  {
          alert("You have reached the limit of adding " + counter_goal + " inputs");
     }

     else {
          var para = document.createElement("div");
          var div = document.getElementById(divName),
          clone = div.cloneNode(true); // true means clone all childNodes and all event handlers

          var newdiv = document.createElement('div');
          newdiv.innerHTML = "Problem/Goal " + (counter_goal + 1) + " <br><input class='form-control' type='text' name='goals[]'>";
          document.getElementById(divName).appendChild(newdiv);
          counter_goal++;
     }
}

