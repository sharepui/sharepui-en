var counter_input = 1;
var counter_quan=1;
var counter_unit=1;
var limit = 10;
function addInput(divName){
     if (counter_input == limit)  {
          alert("You have reached the limit of adding " + counter_input + " inputs");
     }

     else {
          var para = document.createElement("div");
          var div = document.getElementById(divName),
          clone = div.cloneNode(true); // true means clone all childNodes and all event handlers

          var newdiv = document.createElement('div');
          newdiv.innerHTML = " <br><input class='form-control' type='text' name='ingredients[]' placeholder='Ingredient'>";
          document.getElementById(divName).appendChild(newdiv);
          counter_input++;
     }
}

function addQuantity(divName){
     if (counter_quan == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }

     else {
          var para = document.createElement("div");
          var div = document.getElementById(divName),
          clone = div.cloneNode(true); // true means clone all childNodes and all event handlers

          var newdiv = document.createElement('div');
          newdiv.innerHTML = " <br><input class='form-control' type='text' name='quantities[]' placeholder='Quantity'>";
          document.getElementById(divName).appendChild(newdiv);
          counter_quan++;
     }
}

var choices = ["Gram", "Kilogram","Liter"];
var choices_id = ["1", "2","3"];
function addUnit(divName){
     if (counter_unit == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }

     else {
          var para = document.createElement("div");
          var div = document.getElementById(divName),

          clone = div.cloneNode(true); // true means clone all childNodes and all event handlers

          var newDiv = document.createElement('div');
          var selectHTML = "";

          selectHTML="<select name=units[] class='form-control'>";
          for(i = 0; i < choices.length; i = i + 1) {
            selectHTML += "<option class='form-control' value='" + choices_id[i] + "'>" + choices[i] + "</option>";
       }
       selectHTML += "</select>";

       newDiv.innerHTML = selectHTML;
       document.getElementById(divName).appendChild(newDiv);
  }
}