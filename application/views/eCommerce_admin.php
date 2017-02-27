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
			<h2 class='green'>Welcome back <?= $this->session->userdata('first_name'); ?>!</h2>
		</div>
		<div id="products">		
			<h3>Add Products</h3>
			<p class='green'><?= $this->session->flashdata('message'); ?></p>
			<span class='red'><?= $this->session->flashdata('error'); ?></span>
					<form action ='/eCommerceItems/add_product' enctype='multipart/form-data' method='post'>
						<div class='row'>
							<label for='name'>Product Name: </label>
							<input type='text' name='name'>
						</div>
						<div class='row'>
							<label for='description'>Product Description: </label>
							<input type='text' name='description'>
						</div>
						<div class='row'>
							<label for='price'>Product Price: </label>
							<input type='text' name='price'>
						</div>
						<div class='row'>
							<label for='quantity'>Product Quantity: </label>
							<input type='text' name='quantity'>
						</div>
						<input type='submit' value='Enter into Database'>
					</form>
		</div>
	</div>
	<div id='products'>
		<?= "<p class='green'>{$this->session->flashdata('messages')}</p>"; ?>
		<table>
			<thead>
				<tr>
					<th class='normal'>Product Name</th>
					<th class='wide'>Description</th>
					<th class='narrow'>Price</th>
					<th class='normal'>Dated Added</th>
					<th class='narrow'>Quantity Left</th>
					<th class='narrow'>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php
			foreach($items as $item)
			{
				$date = date('M jS Y, g:ia', strtotime($item['created_at']));
				echo "<tr>
						<td>{$item['name']}</td>
						<td>{$item['description']}</td>
						<td>\${$item['price']}</td>
						<td>{$date}</td>
						<td class='red'>{$item['quantity']}</td>
						<td><a href='/eCommerceItems/confirm_delete/{$item['id']}'>Remove</a></td>
					</tr>";
			}
			echo "</tbody>
			</table>"
		?>

		<p><a href="/logout">Logout</p>	
	</div>

	</div> <! - div global>
   </body>
</html>   