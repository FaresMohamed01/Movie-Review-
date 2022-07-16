<?php
	// Name: Fares Mohamed.
	// Course: CMPT 241 Web Programming Project 3
	// Description: This project uses PHP to create a dynamic movie reviews for different films
?>
<!DOCTYPE html>
<html>

<head>
		<title>Rancid Tomatoes</title> <!-- Title always as "Rancid Tomatoes" -->
		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
		<link rel="icon" type="images/rotten.gif" href="images/rotten.gif">
</head>
	

    <body>
		<div class = "banner">
			<img src="images/banner.png" alt="Rancid Tomatoes" />
		</div>
		
		<span id = "header">
		
		<?php
			$movie = $_GET["film"]; //query parameter
			
			//info.txt: getting file content and exploding it based on white spaces
			$information = file_get_contents("$movie/info.txt");
			$information = explode ("\n", $information);
			
			//creating a list from information array to store info.txt content
			list ($title, $year, $overall_rating) = $information;
			
			//trim all variables for additional spaces
			$title = trim ($title);
			$year = trim ($year);
			$overall_rating = trim ($overall_rating);
		?>
			<h1>
				<?= "$title ($year)" ?> <!-- printing the title(year) of the movie -->
			</h1>
			
	    </span>
		
		<div class = "content-area">
		
		<div class = "overview"> 
		
		<div id = "overview">
			<img src = "<?= $movie?>/overview.png" alt="general overview" /> <!--Updating overview.png depending on film -->
		</div>
		
		<dl id = "style">
		
		<?php
			//overview.txt: getting file content and  exploding it based on white spaces
		    $overview = file_get_contents("$movie/overview.txt");
		    $overview = explode ("\n", $overview);
			
			//foreach loop to go over the overview section and explode when it finds ":" to divide between title and value.
		    foreach ($overview as $general_overview){
			   $general_overview = explode (":", $general_overview);
			   
			   //creating a list from $general_overview array to store overview.txt content
			   list ($title, $value) = $general_overview;
			   
			   //trim all variables for additional spaces
			   $title = trim ($title);
			   $value = trim ($value);
		?>
			<dt> 
				<?= "$title" ?> <!-- definition list term (dt) prints the title -->
			</dt>
			
			<dd> 
				<?= "$value" ?> <!-- description (dd) prints the value of each title -->
			</dd>
		
		<?php
			} 
		?>
		 
		</dl>
        </div>
        
        <div class = "rotten">
		
		<div class = "img">
		
			<?php 
				//if rating is 60 or above, freshbig is shown beside rating. 
				if ($overall_rating >= 60){
			?>
				<img src="images/freshbig.png" alt="Fresh" />
			<?php
				}
				//Otherwise, rottenbig.png will be displayed
				else {
			?>
			    <img src="images/rottenbig.png" alt="Rotten" />
			<?php
				} 
			?>
				<?= "$overall_rating" ?>% <!-- Display the overall rating of the movie-->
		</div>
		
		<?php
			$reviews = glob ("$movie/review*.txt"); //return an array of movie files
			$count = count ($reviews); //counts number of elements
			$left_column = ((int)($count/2) + ($count%2)); //variable that divides the reviews into two columns. Deals with odd columns through mod operation.
		?>
		
		<div class = "reviews">
		
		<?php
			// for loop that iterates over the first half of reviews (left column)
			for ($i = 0; $i < $left_column ; $i++){
				//list using reviews array. It creates the four variables for different parts of the review.
				list ($review, $rating, $name, $publication) = file($reviews[$i]); 
				
				//trim all variables for additional spaces
				$review = trim ($review);
				$rating = trim ($rating);
				$name = trim ($name);
				$publication = trim ($publication);
		?>
			<p class = "quote">
				<?php
					//If/Else to add appropriate image depending on whether the review is Fresh or Rotten
					if ($rating == "FRESH"){
				?>
					<img src = "images/fresh.gif" alt = "Fresh" />
				<?php
					}
					elseif ($rating == "ROTTEN"){
				?>
					<img src = "images/rotten.gif" alt = "Rotten" />
				<?php
					}
				?>
					<q><?=$review?></q> <!--printing the review--> 					
		    </p>
			
			<p class = "person">
				<img src = "images/critic.gif" alt = "Critic" />
				<?= $name ?> </br> <?= $publication ?> <!--printing reviewer name and publication of the review-->
		    </p>
		
		<?php
			}
		?>
		
		</div>
		
		<div class = "reviews">
		
		<?php
			// for loop that iterate from the half of the reviews to the end of the reviews (right column)
			for ($i = $left_column; $i < $count ; $i++){
				//list created to store the review contents of the right column 
				list ($review, $rating, $name, $publication) = file($reviews[$i]); 
				
				//trim all variables for additional spaces
				$review = trim ($review);
				$rating = trim ($rating);
				$name = trim ($name);
				$publication = trim ($publication);
		?>
			<p class = "quote">
				<?php
					//If/Else to add appropriate image depending on whether the review is Fresh or Rotten
					if ($rating == "FRESH"){
				?>
					<img src = "images/fresh.gif" alt = "Fresh" />
				<?php
					}
					elseif ($rating == "ROTTEN"){
				?>
					<img src = "images/rotten.gif" alt = "Rotten" />
				<?php
					}
				?>
					<q><?=$review?></q> <!--printing the review--> 					
		    </p>
			
			<p class = "person">
				<img src = "images/critic.gif" alt = "Critic" />
				<?= $name ?> </br> <?= $publication ?> <!--printing reviewer name and publication of the review for right column reviews-->
		    </p>
		
		<?php
			}
		?>
		
		</div>
		
		</div>
		
		<p id = "endline">
			(1- <?= $count ?>) of <?= $count ?> <!--displaying count of reviews based on movie-->
		</p>  
		
		</div>
	
	</body>
	
</html>
