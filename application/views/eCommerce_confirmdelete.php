<!DOCTYPE html>
<html lang="en">
   <head>
   	  <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="js">
	    <meta name="description" content="eCommerceConfirmDelete">
   	  <link rel="stylesheet" type="text/css" href="MyCSSFile.css">
      <title>eCommerce Confirm Delete</title>
   </head>

   <body>
	<div id='global'>
	</div> 
		<div id="confirm">
			<h3>Are you sure you want to delete the product?</h3>
<?php 		
			foreach($items as $item)
			{
				if($item['id'] == $id)
				{
					echo "<p>Name: {$item['name']}</p>";
					echo "<p>Description: {$item['description']}</p>";
				}
			}
?>

			<form action="/eCommerceUsers/admin" method=post>
				<input type="submit" value="Don't Delete">
			</form>
			<form action="/eCommerceItems/delete/<?= $id?>" method=post>
				<input type="submit" value="Delete This Product">
			</form>
		</div>


	<! - div global>
   </body>
</html>   