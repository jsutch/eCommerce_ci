<!DOCTYPE html>
<html lang="en">
   <head>
   	  <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="js">
	    <meta name="description" content="eCommerceAdmin">
   	  <link rel="stylesheet" type="text/css" href="/assets/css/eCommerce_items.css">
      <title>eCommerce Admin</title>
   </head>
   <body>
	<div id="global">
	<div id="header">
		<div>
			<h2>eCommerce Admin Home</h2>
		</div>
		<div id="products">		
			<h3>Products</h3>
		</div>
		<div id="cart">
			<a href="localhost:8888/cart"><h3>Cart</h3></a>
		</div>
	</div>
		<?php
			$total = 0;
			foreach($items as $item)
			{
				$temp = $this->session->userdata($item['id']);
				$total += $temp;
			}
		?>
	<div class="products">
		<div id="product1">
			<p>
				What is your Mission?
				<select name="formMission">
				  <option value="">Select...</option>
				  <option value="Code">Code</option>
				  <option value="Run">Run</option>
				  <option value="Learn">Learn</option>
				  <option value="Money">Money</option>
				</select>
				</p>
		</div>
		<div id="product2">
			<select name="hour">
<?php 			for ($i = 1; $i <= 24; $i++) : ?>
        			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php 			endfor; ?>
			</select>
		</div>
		<div id="product3">
			<form action="/process">
				<input list="winlist">
					<datalist id="winlist">
						<option value="Take Stock">
						<option value="Get Enough Sleep">
						<option value="Run Every Day">
						<option value="Chill With Friends">
						<option value="Build Stability">
					</datalist>
			   	<input type="hidden" name="products" value="add">
   				<input type="submit" class="btn btn-default" value="Add">
			</form>
		</div>
		<p><a href="/logout">Logout</p>	
	</div>

	</div> <! - div global>
   </body>
</html>   