<?php 
if(isset($_COOKIE['provider_logged_flag']))
{
setcookie('provider_logged_flag',true , time()+400 , '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELL</title>

</head>
<body>
    <?php require_once "../models/deal_model.php";
    require_once "../models/provider_user_model.php";
    
session_start();
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
<h1 align='center'>My Orders </h1>
<?php
require_once "../models/provider_user_model.php";
$user= ['email'=> $_SESSION['provider_id']];
//getting id from email ; 
$provider_id = get_id ($user);
$provider = ['id' => $provider_id];
//showing his data from deal table ; 
$status = show_provider_order($provider);
while ($show = mysqli_fetch_assoc($status))
{
    ?>
<div style= "border: solid 2px maroon">
    <h2>Product Name : <?php echo $show['product_name']; ?> </h2>
    <h4>Selling Quantity: <?php echo $show['buying_quantity'] ; ?></h4>
    <h4> Buyer Information :</h4>
    <table border=1px>
        <tr>
            <th>Buyer Name : </th>
            <th>Contact: </th>
            <th>Shipping Address :  </th>
            <th>Transaction ID :</th>
            <?php 
        // getting buyer information 
        //require_once "models/consumer_user_model.php";
        
        $con = getconnection();
        $sql = "SELECT * FROM consumer_user WHERE id = '{$show['consumer_id']}'";
        $status1= mysqli_query($con, $sql);
        $consumer_data = mysqli_fetch_assoc($status1);
        
        $consumer= ['id'=> $show['consumer_id']];
        //$consumer_data = consmuer_data($consumer);
        ?>
    </tr>
    <tr>
        <td>
            <?php echo $consumer_data['username']; ?>
        </td>
        <td>
            <?php echo $consumer_data['contact'] ;?>
        </td>
        <td>
            <?php echo $show['shipping_address'] ;?>
        </td>
        <td>
            <?php echo $show['transaction_id'] ;?>
        </td>
       
        
    </tr>
</table>
</br>
<!--------------------Shipping Status--------------------------->
<form action="../Controllers/shipping_status_controller.php">
    <input type="hidden" name="deal_id" value=<?php echo  $show['deal_id'] ; ?> id="">
    <input type="hidden" name="consumer_id" value = <?php echo  $show['consumer_id'] ; ?> id="">
    <input type="hidden" name="product_name" value = <?php echo  $show['product_name'] ; ?> id="">
    <input type="hidden" name="shipping_address" value = <?php echo  $show['shipping_address'] ; ?> id="">
    <input type="submit" name="submit" value= "CONFIRM SHIPPED" onclick= "return confirm('Are You Sure this Product has been shifted to the desired Destination ?')" id="">
</form>

</div>
<br>
<?php 
}
?>

<?php




}
else 
{
    header("location:../home.html");
}?>
</body>
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

h1 {
  color: maroon;
  font-size: 2.5rem;
  margin-top: 1rem;
}

h2 {
  color: maroon;
  font-size: 1.5rem;
  margin-top: 0.5rem;
}

h4 {
  font-size: 1.2rem;
}


/* Specific styles for the order section */
div {
  padding: 1rem;
  margin-bottom: 1rem;
  background-color: #fff;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1);
}

table {
  width: 100%;
  margin-top: 1rem;
}

table th {
  background-color: maroon;
  color: #fff;
  padding: 0.5rem;
}

table td {
  padding: 0.5rem;
}

input[type="submit"] {
  background-color: maroon;
  color: #fff;
  border: none;
  padding: 0.5rem;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #ad0000;
}

</style>
</html>