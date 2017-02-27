<!DOCTYPE html>
<html lang="en">
   <head>
   	  <meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="author" content="js">
	    <meta name="E-Commerces" content="Test Basket Application">
   	  <link rel="stylesheet" type="text/css" href="/assets/css/eCommerce_users.css">
      <title>Welcome To e-Commerce</title>
   </head>
   <body>
   <div id="header">
      <h2> Welcome To Ecommerce MVC</h2>
   </div>
            <span class='red'><?= $this->session->flashdata('login_errors'); ?></span> 
            <!-- <form method="post" action="/eCommerceUsers/login"> -->
            <form method="post" action="/eCommerceUsers/login_with_secret">
               <input type="hidden" name="action" value="login"/> 
               <label for="email">Email Address</label>
               <input type="text" name="email"/><br>
               <label for="password">Password</label>
               <input type="password" name="password"/><br>
               <label for="secret">Enter secret </label>
               <input type="text" name="secret"/> <br>
               <input type="hidden" name="action" value="login">
               <input type="submit" value="Login"/>
            </form>
         </div>
         <div class="forms">
            <h3> Registration</h3>           
            <p class='green'><?= $this->session->flashdata('form_success'); ?></p>
            <span class='red'><?= $this->session->flashdata('registration_errors'); ?></span>
<!--             <form method="post" action="/eCommerceUsers/register"> -->
            <form method="post" action="/eCommerceUsers/register_with_hash">
               <input type="hidden" name="action" value="register"/> 
               <label for="first_name">First Name</label>
               <input type="text" name="first_name"/><br>
               <label for="last_name">Last Name</label>
               <input type="text" name="last_name"/><br>
               <label for="first_name">Email Address</label>
               <input type="text" name="email"/><br>
               <label for="password">Password</label>
               <input type="password" name="password"/><br>
               <label for="confirm_password">Confirm Password</label>
               <input type="password" name="confirm_password"/> <br>
               <label for="code">Enter Code </label>
               <input type="text" name="code"/> <br>
               <input type="submit" value="Register"/>
            </form>
         </div>
      </div>

   </body>
</html>   