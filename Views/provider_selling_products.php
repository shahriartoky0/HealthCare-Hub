<?php 
if(isset($_COOKIE['provider_logged_flag']))
{
    session_start();
setcookie('provider_logged_flag',true , time()+400 , '/');
if(isset($_REQUEST['submit']))
{
    $product_id = $_REQUEST['product_id'];


require_once "../models/product_model.php";
require_once "../models/provider_user_model.php";
/* $user = ['email'=> $_SESSION['provider_id']];
$provider_id = get_id($user); */
?>
<!-- NAVBAR INCLUDES HERE  -->
<?php
            $email = $_SESSION['provider_id'];
            $image = provider_image($email);
            ?>
<nav>
	<ul>
		<img class="logo" src="../pictures/uploads-p/<?php echo $image ?>" height=80px width=80px alt="Logo">

	</ul>
                <ul>
                    
                    <li><a href="provider_page.php">Home</a></li>
                    <li><a href="pro_profile.php">Customize Your Profile</a></li>
                    <li><a href="sell.php">Sell Medical Equipment</a></li>
					<li><a href="show_provider_selling_products.php">My Products</a></li>
                    <li><a href="provider_own_sell.php">My Sold Products</a></li>
                    <?php
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['provider_id']];
                    $provider_id= get_id($user);
                    $client =['type'=>'provider', 'user_id'=>$provider_id];
                    $client_all_notices = unread_notification($client);
                    $unread_count=0;
                    while ($client_notice = mysqli_fetch_assoc($client_all_notices))
                    {
                        if ($client_notice['read_status']==0)
                         $unread_count++;
                    }
                    if ($unread_count > 0 )
                    {
                        $show_count = "($unread_count)";
                    }
                    else 
                    {
                        $show_count='';

                    }
                    ?>
                    <li><a href="provider_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
					<li><a href="../Controllers/logout_provider.php">Logout</a></li>
                </ul>
                <br>
               
            </nav>
<!-- NAVBAR ENDS HERE  -->

<?php
$product = ['product_id'=> $product_id];
$status= show_provider_products_by_productid($product);
while ($result = mysqli_fetch_assoc ($status))
{

?>
<div style= "border: dotted 2px grey">

    <form action="../Controllers/provider_updating_products.php">
        
        
        <h4>
            Product Name : 
        </h4>
        <input type="hidden" name="product_id" value="<?php echo $product_id ;?>" id="">
        <input type="text" name="product_name" value="<?php echo $result['name']; ?>" id="">
        <h4> Product Description :</h4>
        <textarea name="product_description" id="" cols="30" rows="7"><?php echo $result['description']; ?></textarea>
        <h4>
            Product Price :
        </h4>
        <input type="number" name="product_price" value =<?php echo $result['price']; ?> id="">
<h4>
    Quantity : 
</h4>
<input type="number" name="product_quantity" value=<?php echo $result['quantity']; ?> id=""><br><br>
<input type="submit" name="submit" value= "Update" onclick="return confirm('Are you sure you want to update this ?')"id="">

</form>
<?php } ?>
</div>







<?php
}
}
else 
{
    header("location:../home.html");
}
?>
<!-- Internal CSS starts here --> 
<style>
		body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

   nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f2f2f2;
  height: 80px;
  padding: 0 30px;
}

nav ul {
  display: flex;
  align-items: center;
  list-style: none;
}

nav li {
  margin-right: 30px;
}

nav li:last-child {
  margin-right: 0;
}

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  font-size: 18px;
}

nav img.logo {
  margin-right: 20px;
  border-radius: 50%;
}

nav a:hover {
  color: #008080;
}

nav span {
  background-color: #008080;
  color: #fff;
  border-radius: 50%;
  padding: 5px 10px;
  margin-left: 5px;
  font-size: 12px;
}
		/* Form */
		form {
			padding: 20px;
			border: dotted 2px grey;
		}
		form h4 {
			margin-top: 20px;
			margin-bottom: 10px;
			font-weight: bold;
		}
		form input[type="text"],
		form input[type="number"],
		form textarea {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 20px;
			font-size: 16px;
		}
		form input[type="submit"] {
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
		}
		form input[type="submit"]:hover {
			background-color: #0069d9;
		}
	</style>
<!-- Internal CSS ends here --> 
</html>