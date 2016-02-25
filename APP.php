<?php

	//require another php file
	//../../ means go to folders back
	require_once("../../config.php");


	$everything_was_okay = true;

	//*****************
	//TO validation
	//*****************
	if (isset($_GET["to"])){//if there is "?to=" in the message
		if (empty($_GET["to"])){//if it is empty
		$everything_was_okay = false;
		echo "Please enter recipient! <br>";//yes it is empty
		}else{
			echo "To: ".$_GET["to"]."<br>";//no it is not empty
		}
	}else{
		$everything_was_okay = false; //if it's empty
	}
	
	//check if there is variable in the URL
	if (isset ($_GET["message"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		// if it is empty
		if (empty ($_GET["message"])){
			//it is empty
			$everything_was_okay = false;
			echo "Please enter the message!";
		}else{
			//It is not empty
			echo "Message: ".$_GET["message"]."<br>";
		}
	}else{
		//echo "There is no such thing as message";
		$everything_was_okay = false;	
	}
	
	
	//******************************
	//******** SAVE TO DB **********
	//******************************
	
	// ? Was everything okay
	if ($everything_was_okay == true);
		echo "Saving to database... ";
		
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		//1 server name
		//2 username
		//3 password
		//4 database
		
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_mertyarba");
		
		$stmt = $mysql->prepare("INSERT INTO messages_sample(recipient, message)VALUES (?, ?)");
		
		//We are replacing question marks with values
		//s - string, date or smth that is based on characters and numbers
		//i - integer, number
		//d - decimal, float
		
		//for each question mark its type with one letter
		$stmt->bind_param("ss", $_GET["to"], $_GET["message"]);
		
		//echo error
		echo $mysql->error;
		
		//save
		if ($stmt->execute()){
			echo "saved successfully";
		}else{
			echo $stmt->error;
		}
		
		
	
	
	//Getting the message from the address
	//if there is $name= .. then $_GET ["name"]
	//$my_message = $_GET ["message"];
	//$to = $_GET ["to"];
	//$urgency = $_GET ["urgency"];
	//echo "My message is " .$my_message. " and it is to " .$to;
	
	
?>

<h2> First Application </h2>

<form method="get">
	<label for="to">To* <label><br>
	<input type="text" name="to"><br>
	
	<label for="message">Message* <label><br>
	<input type="text" name="message"><br>
	
	
	<input type="submit" value="save to DB">
	
	
	



<form>