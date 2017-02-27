<!DOCTYPE html>
<html lang="en">
   <head>
   	  <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="js">
	    <meta name="description" content="eCommerce Checkout Success">
   	  <link rel="stylesheet" type="text/css" href="MyCSSFile.css">
      <title>eCommerce Checkout Success!</title>
   </head>

   <body>
	<div id='global'>
	</div> 



	<h1 class="green">Your Checkout Is A Success!</h1>
	<p class="right"><a href="/eCommerceItems">Back</a></p>
	<p><a href='/eCommerceUsers/logout'>Log Out</a></p>
	<! - div global>
   </body>
</html>   

      <?php 
         $total=0;
         foreach ($items as $item) 
         {
            $temp = $item['price'] * $this->session->userdata($item['id']);
            $total += $temp;
            if ($this->session->userdata($item['id']) > 0)
            {
               echo "<div class='item'>
                  <div class='description'>
                     <p>Name: {$item['name']}</p>
                     <p>Price: {$item['price']}</p>
                     <p>Item ID: {$item['id']}</p>
                     <p>Quantity: {$this->session->userdata($item['id'])}</p>
                     <form action '/eCommerceItems/remove_from_basket/{$item['id']}' method='post'>
                        <select name='qty'>";
                        for($i=1;$i <= $this->session->userdata($item['id']);$i++)
                        {
                           echo "<option>{$i}</option>";
                        }
                        echo "</select>
                        <input type='submit' value='Remove'>
                        </form>
                     </div> 
                  </div>";
            }
         }