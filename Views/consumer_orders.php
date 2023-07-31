<?php
//views file 
session_start();
if(isset($_COOKIE['consumer_logged_flag'])){

    require_once "../models/deal_model.php";
    require_once "../models/consumer_user_model.php";
    require_once "../models/product_model.php";
    $user = ['email'=> $_SESSION['consumer_id']];
    ?>
        	<!-- NAVBAR INCLUDES HERE  -->
            <?php
            $email = $_SESSION['consumer_id'];
            $image = consumer_image($email);
            ?>
            <img class="logo" src="../pictures/uploads-c/<?php echo $image ?>" height=80px width=80px alt="Logo">
<nav>
                <ul>
                    
                    <li><a href="consumer_page.php">Home</a></li>
                    <li><a href="con_profile.php">Customize Your Profile</a></li>
                    <li><a href="buy.php">BUY MEDICAL ACCESSORIES</a></li>
                    <li><a href="blog_show.php">Show Articles</a></li>
                    <li><a href="consumer_orders.php">My Orders</a></li>
                    <li><a href="consumer_complain.php">File a Complain</a></li>
                    <li><a href="consumer_show_doctors.php">Chat with a Doctor</a></li>
                    <?php
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $user = ['email'=>$_SESSION['consumer_id']];
                    $consumer_id= get_id($user);
                    $client =['type'=>'consumer', 'user_id'=>$consumer_id];
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
                    <li><a href="consumer_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
                </ul>
                <br>
                <ul>
                    <li><a href="../Controllers/logout_consumer.php">Logout</a></li>
                </ul>
            </nav>
<!-- NAVBAR ENDS HERE  -->
    <u>
        <h1>My Orders : </h1>
    </u>
    <?php
    $consumer_id = get_id($user);
    //now to get his order data 
    $consumer=['id'=> $consumer_id];
    $status=  show_consumer_order($consumer);
    while ($result = mysqli_fetch_assoc($status))
    {
    ?>
    <div style= "border: dotted 1px green ">
    <h2>Product Name : <?php echo $result['product_name']; ?></h2>
    <!----------Picture and description to be added here  -->
    <?php $product_details= getProductById($result['product_id']) ?>
    <!-- .php location to be changed after MVC model  -->
    <img src="../pictures/uploads_products/<?php echo $product_details['picture'] ;?>" style= "width: 200px ; height: 150px" alt="">
    <p><?php echo $product_details['description']; ?></p>
    <small>Quantity : <?php echo $result['buying_quantity']; ?></small>
    <h3>Cost :<?php echo $result['cost']; ?></h3>
    <h4>To be Shipped : <?php echo $result['shipping_address']; ?></h4>
<!-------------------------------Here the Product Review Part start--------------->
<?php if ($result['rating'] == 0) { ?>
        <form action="../Controllers/rating_controller.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $result['product_id']; ?>">
            <input type="hidden" name="consumer_id" value="<?php echo $consumer_id; ?>">
            <label for="rating">Rating:</label>
            <select name="rating" id="rating">
                <option value="1">1 star</option>
                <option value="2">2 stars</option>
                <option value="3">3 stars</option>
                <option value="4">4 stars</option>
                <option value="5">5 stars</option>
            </select>
            <input type="submit" name="submit" value="Submit">
        </form>
    <?php } else { ?>
        <p>Your rating: <?php echo $result['rating']; ?> stars</p>
    <?php } ?>
<!-------------------------------Here the Product Review Part end--------------->
    <form action="../Controllers/received_status_controller.php">
        <input type="hidden" name="deal_id" value=<?php echo  $result['deal_id'] ; ?> id="">
        <input type="submit" name="submit" value= "Recieved" onclick= "return confirm('Are You Sure you have recieved this Product ?')" id="">
    </form>
</div>
    <?php } ?>

    <?php
}
else 
{
    header("location:../home.html");
}
?>
<style>
    /* NAVBAR */
    nav {
			background-color: #fff;
			box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
			position: sticky;
			top: 0;
			z-index: 999;
		}


		.logo {
			height: 50px;
			width: 50px;
			object-fit: cover;
			border-radius: 50%;
			margin-right: 10px;
		}

		nav ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
		}

		nav ul li {
			margin-left: 10px;
		}

		nav ul li a {
			color: #333;
			text-decoration: none;
			font-size: 16px;
			font-weight: bold;
			padding: 10px 15px;
			transition: all 0.3s ease;
			position: relative;
			display: flex;
			align-items: center;
		}

			nav ul li a:hover {
				background-color: #ddd;
			}

			nav ul li a:after {
				content: '';
				display: inline-block;
				height: 4px;
				width: 100%;
				background-color: #6c5ce7;
				position: absolute;
				bottom: -4px;
				left: 0;
				transform: scaleX(0);
				transform-origin: bottom right;
				transition: transform 0.3s ease;
			}

			nav ul li a:hover:after {
				transform: scaleX(1);
				transform-origin: bottom left;
			}

		nav ul li a span {
			background-color: #6c5ce7;
			color: #fff;
			border-radius: 50%;
			height: 18px;
			width: 18px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 12px;
			position: absolute;
			top: -6px;
			right: -6px;
		}

/* ORDERS */
h1 {
  margin-top: 50px;
}

div {
  margin-top: 20px;
  padding: 10px;
}

h2 {
  margin-top: 0;
}

img {
  margin-right: 20px;
  float: left;
}

p {
  margin-top: 10px;
}

small {
  display: block;
  margin-top: 10px;
}

h3 {
  margin-top: 10px;
}

h4 {
  margin-top: 10px;
}

form {
  margin-top: 10px;
}

input[type="submit"] {
  background-color: #333;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #ccc;
  color: #333;
}

</style>