<!DOCTYPE html>
<html lang="en">
   <head>
   	  <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="js">
	    <meta name="description" content="eCommerceMain">
   	  <link rel="stylesheet" type="text/css" href="/assets/css/eCommerce_items.css">
      <title>eCommerce Main</title>
   </head>
   <body>
	<div id="global">

	<div id="wrapper">
		<?php 
			$total = 0;
			foreach($items as $item)
			{
				$temp = $this->session->userdata($item['id']);
				$total += $temp;
			}
		?>
				<h1>Welcome To My Basket Store</h1>
				<p>Cart Not Working Yet - stuck on Delete Item From Cart</p>
				<p class='right' ><a href='/eCommerceItems/basket'>View Basket (<?= $total; ?>)</a></p>
				<h3 class='green right'>Welcome back <?= $this->session->userdata('first_name'); ?>!</h3>
				<p class='right'><button><a class='button' href='/eCommerceUsers/logout'>Log Out</a></button></p>
				<p class="right"><a href="/eCommerceUsers/logout">Logout</a></p>
	<?php
				foreach($items as $item)
				{
					echo "<div class='item'>
						<div class='description'>
							<p>Name: {$item['name']}</p>
							<p>Description: {$item['description']}</p>
							<p>Price: \${$item['price']}</p>
							<p>Quantity Available: {$item['quantity']}</p>
							<p>Item ID is: {$item['id']}</p> 
							<form action='/eCommerceItems/add_to_basket/{$item['id']}' method='post'>
								<select name='qty'>";
		                        for ($i=1; $i<=$item['quantity']; $i++)
		                        {
		                           echo "<option>{$i}</option>";
		                        }
								echo "</select>
								<input type='submit' value='Add to basket'>
							</form>
						</div>
					</div>";
				}
			?>
			<p><a href="/logout">Logout</p>	
		</div> <! - div wrapper>


	</div> <! - div global>
   </body>
</html>   