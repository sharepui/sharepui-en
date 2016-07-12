================================================================================
HTML files
================================================================================
--------------------------------------------------------------------------------
index.html
php: -
added js and scripts: - 
note: i just include photo slide and info in this page. The image files are in img folder.
--------------------------------------------------------------------------------
share.html
php: 
1) share_success.php
	purpose: send the information in the form to the database and then print "Thanks for contributing your recipe!" and the information
added js and scripts: 
1) addInput.js 
	purpose: to use functions to dynamically add more ingredients, units and quantities
2) addStep.js
	purpose: to use functions to dynamically add more step in the instuctions
see these files in js folder
--------------------------------------------------------------------------------
search.html
php: 
1) result.php
	purpose: print the list of recipes that match the filter
added js and scripts:
	At the end, I added the script to disable all options under Weather section. If any is selected, other options are disabled. 

================================================================================
PHP files
================================================================================
--------------------------------------------------------------------------------
share_success.php
php:
1) send.php
	
2) query_by_recipe_id.php
	purpose: to use function printFormattedRecipeInfo() to print the stuff entered by the user 
purpose: send the information in the form to the database and then print "Thanks for contributing your recipe!" and the information
--------------------------------------------------------------------------------
send.php
other php: -
purpose: to send stuff into the DB
--------------------------------------------------------------------------------
query_by_recipe_id.php
other php: -
purpose: functions that print information of each recipe ID
note: the parameter of each function is recipe ID
--------------------------------------------------------------------------------
result.php
other php: match.php
purpose: display the list of recipes that match the filter
--------------------------------------------------------------------------------
match.php
other php: query_by_recipe_id.php
purpose: include functions 
--------------------------------------------------------------------------------
result_by_id.php
other php: 'query_by_recipe_id.php'
note: when you click the link on /result.php it links to /result_by_id.php?recipe_id=[recipe_id] and it displays the information of that recipe ID



