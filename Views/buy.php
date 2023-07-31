<?php 
//consumer buying page
if (isset($_COOKIE['consumer_logged_flag'])) {
    require_once "../models/product_model.php";
    require_once "../models/consumer_user_model.php";
    session_start();
?>

<!-- NAVBAR INCLUDES HERE  -->
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
                    //unread notifucation Number
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

<u><h1>BUY MEDICAL PRODUCTS</h1></u>
<?php
    $status = show_all_products();
  
        if (isset($_SESSION['product_added_to_cart']))
        {
            echo "<h3 align='center'>{$_SESSION['product_added_to_cart']} </h3>";
            unset($_SESSION['product_added_to_cart']);
        }
        


    while ($result = mysqli_fetch_assoc($status)) {
        echo "<h2>{$result['name']}</h2>";
        echo "<img style = 'width: 150 ;height :150' src='../pictures/uploads_products/{$result['picture']}'> </br>";
        echo "<p>{$result['description']}</p>";
        echo "Price: {$result['price']}<br>";
        echo "Available: {$result['quantity']}<br>";

        $sql1 = "SELECT * FROM provider_user WHERE id = {$result['seller_id']}";
        $con = getconnection();
        $status1 = mysqli_query($con, $sql1);
        $result1 = mysqli_fetch_assoc($status1);
        echo "Call to Buy: {$result1['contact']} </br>";
        /* echo "Quantity: <input type='number' name='quantity_{$result['id']}' value='1' min='1' /><br></br>"; */
        /*   echo "<button onclick=\"add_to_cart({$result['id']}, '{$result['name']}', {$result['price']}, document.querySelector('[name=quantity_{$result['id']}]').value)\">ADD TO CART</button>"; */
        ?>
      <form method='post' action="../Controllers/cart_controller.php">
          <input type="hidden" name="product_id" value="<?php echo $result['id'] ?>" id="">
          <input type="hidden" name="product_name" value="<?php echo $result['name'] ?>" id="">
          <!-- <input type="hidden" name="buying_quantity" value="<//?php echo $_SESSION['consumer_id'] ?>" id=""> -->
          
          <?php 
          //getting consumer_id from the email that was stored in session(consumer_id) 
          $user = ['email' =>$_SESSION['consumer_id'] ];
          $consumer_id = get_id($user);
          ?>
          <input type="hidden" name="consumer_id" value="<?php echo $consumer_id ?>" id="">
          <input type="hidden" name="seller_id" value="<?php echo $result['seller_id'] ?>" id="">
          Quantity: <input type='number' name='buying_quantity' value='1' min='1' /><br><br>
          <!------------------------- REVIEW OF THE PRODUCT STARTS HERE----------------------- -->
          <?php
          require_once "../models/deal_model.php";
          $review = ['product_id'=> $result['id']];
         $rating= get_average_rating($review);
         if ($rating == 0 )
         {
            $rating_text = "NO REVIEW AVAILABLE ";
         }
         else if($rating == 1)
         {
            $rating_text="BAD (*)";
         }
         else if($rating == 2)
         {
            $rating_text="POOR (* *)";
         }
         else if($rating == 3)
         {
            $rating_text="AVERAGE (* * *)";
         }
         else if($rating == 4)
         {
            $rating_text="FAIR (* * * *)";
         }
         else if($rating == 5)
         {
            $rating_text="GOOD (* * * * *)";
         }
         else 
         {
          $rating_text = "ERROR";  
         }


          ?>
          <span> Review: <?php echo $rating_text; ?></span><br>
          <!------------------------- REVIEW OF THE PRODUCT ENDS HERE----------------------- -->
        <input type="hidden" name="product_price" value="<?php echo $result['price'] ?>" id="">
        
        <input type="submit" name="submit" value="Add to Cart" id="">

      </form>
     

<a href="cart.php"> GO TO CART</a> <br> <br>

     <?php  
    }
}
else 
{
    header("location:../home.html");
}
?>

<style>
nav {
			background-color: #fff;
			box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
			position: sticky;
			top: 0;
			z-index: 999;
		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 10px 20px;
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

h1 {
  text-decoration: underline;
  font-size: 30px;
  margin-top: 30px;
}

h2 {
  font-size: 20px;
  margin-top: 30px;
}

p {
  font-size: 18px;
  margin-top: 10px;
}

img {
  margin-top: 10px;
  margin-bottom: 10px;
}

form {
  margin-bottom: 30px;
}

input[type="number"] {
  width: 70px;
  height: 30px;
  margin-right: 10px;
  margin-bottom: 10px;
  font-size: 18px;
  text-align: center;
  border: 1px solid #c42d2d;
  border-radius: 5px;
}

input[type="submit"] {
  padding: 10px;
  background-color: #c42d2d;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #a42c2c;
}

</style>

