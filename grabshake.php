<?php
	header('Access-Control-Allow-Origin: *'); // Om ervoor te zorgen dat locale site php op server kan aanspreken.
	$connect=mysqli_connect("vincentnoben.mctantwerpen.kdg.be","vince_ctshaker","ctshakerpassword","vincentnoben_cocktailshaker");
	// Check connection
	if (mysqli_connect_errno($connect))
	{
		//echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} 

	$checkrow = "SELECT c.id FROM tbl_cocktails as c";
	$rowresult = mysqli_query($connect,$checkrow);
	$rows = mysqli_num_rows($rowresult);
	//echo "Er zijn " . $rows." cocktails gevonden in de database.<br>";
	$random = rand(1,$rows);
	//echo "Random nummer tussen 1 en ".$rows." is: ".$random."<br>";

	$sql = "	SELECT c.name,c.recipe,c.img
				FROM tbl_cocktails c
				WHERE c.id = $random
			";
	$sql2 = "	SELECT ci.volume,i.name,i.measurement
				FROM tbl_cocktail_ingredient ci
				INNER JOIN tbl_ingredients i
					ON (ci.pk_ingredient_id = i.id)
				WHERE ci.pk_cocktail_id = $random
			";
	$info="";
	if ($result=mysqli_query($connect,$sql))
	{
		while($test = mysqli_fetch_array($result)){
			$info[] .= $test[0]; // Name
			$info[] .= $test[1]; // recipe
			$info[] .= $test[2]; // img
			//$info .= $test[3]; // (Votes)
		}
		//var_dump($info);
	}
	$ingredients="";
	if ($result2=mysqli_query($connect,$sql2))
	{
		while($test2 = mysqli_fetch_array($result2)){
			$ingredients[] .= $test2[0]; // Volume
			$ingredients[] .= $test2[2]; // (Measurement cl/spoon/#/...)
			$ingredients[] .= $test2[1]; // Ingrediënt
		}
		//var_dump($ingredients);
	}
	$response['info'] = $info;
	$response['ingredients'] = $ingredients;
	echo json_encode($response);

	mysqli_close($connect);
?>