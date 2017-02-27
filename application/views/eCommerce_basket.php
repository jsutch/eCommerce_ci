<!DOCTYPE html>
<html lang="en">
   <head>
   	  <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="js">
	    <meta name="description" content="eCommerce Basket">
   	  <link rel="stylesheet" type="text/css" href="MyCSSFile.css">
      <title>eCommerce Basket</title>
   </head>

   <body>
   <div id="wrapper">
      <h1 class="center">Checkout</h1>
      <p class="right"><a href="/eCommerceItems">Back</a></p>

      <?php
         $total=0;
         foreach($items as $item)
         {
            $temp = $item['price'] * $this->session->userdata($item['id']);
            $total += $temp;
            if ($this->session->userdata($item['id']) > 0)
            {
               echo "<div class='item'>
                  <div class='description'>
                     <p>Name: {$item['name']}</p>
                     <p>Price: \${$item['price']}</p>
                     <p>Quantity: {$this->session->userdata($item['id'])}</p>
                     <form action='/eCommerceItems/remove_from_basket/{$item['id']}' method='post'>
                        <select name='qty'>";      
                        for ($i=1; $i<=$this->session->userdata($item['id']); $i++)
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
                  echo "<h3 class='border_top'>Total Price: \${$total}</h3>"
         ?>
      <form action="/eCommerceItems/process" method='POST'>
         <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="pk_test_SYyvT1NoAP93RkAwvAqOxbxN"
          data-amount="2000"
          data-name="Confirm Purchase"
          data-description="Total: $<?= $total; ?>"
          data-image="/128x128.png">
        </script>
      </form>
   </div>

   </body>
</html>