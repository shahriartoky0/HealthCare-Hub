<?php 
if(isset($_COOKIE['provider_logged_flag']))
{
    session_start();
setcookie('provider_logged_flag',true , time()+400 , '/');
require_once "../models/product_model.php";
require_once "../models/provider_user_model.php";
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
<h1 align='center'> List of Products</h1 align='center'>

<?php
$user = ['email'=> $_SESSION['provider_id']];
$provider_id = get_id($user);
$product = ['provider_id'=> $provider_id];
$status= show_provider_products($product);
while ($result = mysqli_fetch_assoc ($status))
{

?>
<div>

    <form action="../Views/provider_selling_products.php">
        
        
        <h4>
            Product Name : 
            <b>
                <?php echo $result['name']; ?>
            </b>
        </h4>
        <input type="hidden" name="product_id" value="<?php echo $result['id'] ;?>" id="">
        <img src="../pictures/uploads_products/<?php echo $result['picture'] ;?>" alt="" style="width: 200px; height:200 px">
        <h4> Product Description :</h4>
        <?php echo $result['description']; ?>
        <h4>
            Product Price :
        </h4>
        <?php echo $result['price']; ?> 
<h4>
    Quantity : 
</h4>
<?php echo $result['quantity']; ?> <br><br>
<input type="submit" name="submit" value= "EDIT" ><br>

</form>
</div>
<?php } ?>
<?php
}
?>
<!-- Internal CSS starts here  -->
<style>
   /* Header */
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
/* navbar ends  */
/* Product list */
div {
  margin: 1rem;
  padding: 1rem;
  border: 1px solid #ddd;
  text-align: center;
}

div h4 {
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
}

div img {
  margin-right: 1rem;
  width: 100px;
  height: 100px;
  object-fit: contain;
}

div p {
  margin-bottom: 1rem;
}

div input[type="submit"] {
  margin-top: 1rem;
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  transition: all 0.3s ease;
}

div input[type="submit"]:hover {
  background-color: #fff;
  color: #007bff;
  cursor: pointer;
}


</style>
<!-- Internal CSS ends here  -->
</html>