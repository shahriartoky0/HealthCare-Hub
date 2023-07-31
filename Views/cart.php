<?php
if (isset($_COOKIE['consumer_logged_flag'])) {
require_once "../models/cart_model.php";
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
                    //unread notification Number
                    require_once "../models/notifications_model.php";
                    $show_count='';

                    ?>
                    <li><a href="consumer_notification.php">Notifications <span><?php echo $show_count ; ?></span></a></li>
                </ul>
                <br>
                <ul>
                    <li><a href="../Controllers/logout_consumer.php">Logout</a></li>
                </ul>
            </nav>
<!-- NAVBAR ENDS HERE  -->

<?php

//getting consumer_id from the email that was stored in session(consumer_id) 
$user = ['email' =>$_SESSION['consumer_id'] ];
$consumer_id = get_id($user);


$person = ['consumer_id'=> $consumer_id];
$status = show_my_data($person);
//print_r( $status);
?>
<h2>Cart</h2>
<?php   
if (isset($_SESSION['cart_item_remove_msg']))
{
    echo $_SESSION['cart_item_remove_msg'];
    unset($_SESSION['cart_item_remove_msg']);
}
?>
    <table border=1px>
        <tr>
            <th>
                Product Name :
            </th>
            
            <th>
                Unit Price :
            </th>
            
            <th>
                Buying Quantity :
            </th>
            <th>
                Cost :
            </th>
            
        </tr>
        <?php
        while($result = mysqli_fetch_assoc($status))
        { ?>
        <tr>
            <td>
                <?php echo $result['product_name']; ?>
            </td>
                <td>
                <?php echo $result['product_price']; ?>
             </td>
                <td>
                <?php echo $result['buying_quantity']; ?>
             </td>
             <td>
                 <?php echo $result['cost']; ?>
                </td>
                <form action="../Controllers/delete_item_from_cart.php">
                    <input type="hidden" name="cart_id"  value="<?php echo $result['cart_id']; ?>" id="">
                    <td>
                    <input type="submit" name="submit" value="Remove" id="">
                 </form>
                </td>
            </tr>
         <?php
         }
        ?> 
    </table>
    <br><br>
    <table> 
        <tr>
            <td>
                Shipping Address : 
            </td>
            <td>
                <!----------------- The form starts here------------- -->

                <form action="../Controllers/product_deal_list.php" onsubmit= "return validateForm()">
                <textarea name="address" id="" cols="25" rows="5"></textarea>

            </td>
        </tr>
 <tr>
                    <td>

                        Payment Method :
                    </td>
                    <td>
                        <select name="payment_method" id="payment_method" onchange="f1()">
                            <option value="">Select One</option>
                            <option value="cod">Cash on Delivery</option>
                            <option value="online">Pay Via online</option>
                        </select>

                    </td>
                </tr>
              
            </table>
            
      
            <!-- Product Details that are to sent to deal table starts here -->
           
         <input type="hidden" name ="product_id" value="<?php echo $result['product_id'] ?>" id="">
         <input type="hidden" name ="buying_quantity" value="<?php echo $result['buying_quantity'] ?>" id="">
         <input type="hidden" name ="cost" value="<?php echo $result['cost'] ?>" id="">
         <input type="hidden" name ="consumer_id" value="<?php echo $result['consumer_id'] ?>" id="">
         <input type="hidden" name ="seller_id" value="<?php echo $result['seller_id'] ?>" id="">
            <!-- Product Details that are to sent to deal table ends here -->
   
<!-- If payment done online then  -->
<?php
    
    $person1 = ['consumer_id'=> $consumer_id];
    $status2 = show_my_data($person1);
    ?>
    <br>
    <div id="online_payment" style= "display: none;">

    
  <table border=1px>
      <tr>
          <th>BKASH MERCHANT Number</th>
          <th> Payement (tk)</th>
        </tr>
        <?php

while($result2= mysqli_fetch_assoc($status2))
{   
    $con = getconnection();
    $sql1 = "SELECT contact FROM provider_user WHERE id = '{$result2['seller_id']}'";
    $status1= mysqli_query($con, $sql1);
    $result1 = mysqli_fetch_assoc($status1);
    ?>
  
  <tr>
      <td align='center'>
          
          <?php echo $result1['contact']."<br>"; ?>
        </td>
        <td>
            
            <?php echo $result2['cost']."<br>"; ?>
        </td>
        <td>
        <input type="text" name="transaction_id[<?php echo $result2['cart_id']; ?>]" placeholder="Payment Transaction ID">

            
        </td>
    </tr>
    
    <?php
     } 
     ?>
    </table>
    </div>
   <!----------------------------- The form ends here ----------------------------> 
    <br><input type="submit" name="submit" value= "Confirm Order" id="">
     </form>
    <br><br> <a href="buy.php">Back to Buying Page</a>
    <?php
   
   
   ?>
<script>
    function f1()
    {
        let method = document.getElementById("payment_method").value;
        console.log(method);
        let show = document.getElementById("online_payment");
        if (method == 'online')
        {
            show.style.display= "block";
            
                
            }
            else 
            {
                
                show.style.display= "none";
            }
        }
        function validateForm() 
        {
            let method = document.getElementById("payment_method").value;
            if (method == 'online')
            {
                var inputs = document.getElementsByTagName("input");
                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].type == "text" && inputs[i].value == "") {
                        alert("Please fill in all transaction ID fields.");
                        return false;
                    }
                }
                return true;
            }
            else if (method =='cod') 
            {
                return true; 
            }
        else 
        {
            alert("Please set a payment method !!");
            return false;
        }
    }
    
</script>

<?php }
else 
{
    header("location:../home.html");
}
?>
<!-- INTERNAL CSS STARTS HERE -->
<style>
/* NAVBAR */
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
/* Cart table styles */
table {
  border-collapse: collapse;
  margin-top: 20px;
}

table th,
table td {
  padding: 8px;
  text-align: left;
}

table th {
  background-color: #f0f0f0;
}

table td {
  border-bottom: 1px solid #ddd;
}

table td:last-child {
  text-align: center;
}

table input[type="submit"] {
  background-color: #f0f0f0;
  border: none;
  padding: 4px 8px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

table input[type="submit"]:hover {
  background-color: #ccc;
}

/* Payment form styles */
form {
  margin-top: 20px;
}

form label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

form select,
form textarea {
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ddd;
  width: 100%;
  margin-bottom: 10px;
}

form input[type="hidden"] {
  display: none;
}

form input[type="submit"] {
  background-color: #f0f0f0;
  border: none;
  padding: 8px 16px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

form input[type="submit"]:hover {
  background-color: #ccc;
}

/* Online payment details styles */
#online_payment {
  margin-top: 20px;
}

#online_payment table {
  border-collapse: collapse;
  margin-top: 10px;
}

#online_payment table th,
#online_payment table td {
  padding: 8px;
  text-align: left;
}

#online_payment table th {
  background-color: #f0f0f0;
}

#online_payment table td {
  border-bottom: 1px solid #ddd;
}

    </style>
    <!-- INTERNAL CSS ENDS HERE -->