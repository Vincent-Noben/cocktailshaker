function grabShake () {
	console.log("grabShake called.");
	$.ajax({
		url: 'http://vincentnoben.mctantwerpen.kdg.be/cocktailshaker/grabshake.php',
		//url: 'grabshake.php',
		type: 'get',
		dataType: 'json',
		data: "",
		crossDomain: true,
		async: false,

		success: function (response) {
			console.log(response);
			$("#cocktailname").empty().html(response.info[0]); // Cocktail title
			$("#cocktailpicture").empty().html("<img src=\"images/cocktails/"+response.info[2]+"\">");
			$("#score").empty().html("Score:<br>5/10");
			$("#recipe").empty().html("<h4>Recipe:</h4>"+response.info[1]); // Cocktail recipe
			var ingredients = "";
			$.each(response.ingredients, function(index, val) { // Loops trough all ingredients.
				ingredients += val + " "; // This adds the sql array item to the output.
				if ((index+1) % 3 == 0) {
					ingredients += "<br>";
				};
			});
			$("#ingredients").empty().html("<h4>Ingredients:</h4>"+ingredients);
		}
	});	
}