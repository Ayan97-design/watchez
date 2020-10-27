<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('location:index.php');

}
require('config/config.php');
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Dosis"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/main.css" />
    <title>TimelineZ | Account </title>
  </head>
  <body>
         <!-- Header -->
  <header id="header-inner">
      <div class="container">
        <nav id="main-nav">
          <img src="img/logo.png" alt="My Portfolio" id="logo" />
          <ul>
            
            <li><a href="logout.php"> LOGOUT </a>  <i class="fa fa-user" aria-hidden="true"></i></li>
            <!-- <li><a href="account.php">Cart</a>    <i class="fa fa-shopping-cart" aria-hidden="true"></i></li> -->
          </ul>
        </nav>
      </div>
    </header>
	<div id="addcart"> <h2> ADD ITEMS TO YOUR CART </h2></div>
		<section id="product-showcase">
			<?php
				$query = "SELECT * FROM products ORDER BY id ASC";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
                ?>
                <div class="product-con">
                <div class="card">
                <form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">
						<img src="<?php echo $row["product_image"]; ?>" class="card-img" /><br />

						<h4 ><?php echo $row["product_name"]; ?></h4>

						<h4  class="card-price">₹ <?php echo $row["product_price"];  ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["product_price"]; ?>" />

                        <input type="submit" name="add_to_cart" style="margin-top:5px;"  value="Add to Cart" id="button-c"  />
                </div>

            </form>
        
                    </div>
			<?php
					}
				}
			?>
    
				<table >
					<tr>
						<th width="35%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>₹ <?php echo $values["item_price"]; ?></td>
						<td>₹ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove X</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" >Total</td>
						<td >₹ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
				<div id="buy">
					<label for="payment" id="buy-label">Select Payment Option</label>
					<select name="payment" id="payment">
						<option value="cod">Cash On Delivery</option>
					</select>
					<a href="#" id="btn-buy"> Buy </a>

				</div>
			
			
            </section>
<!-- Footer -->
<footer id="main-footer">
        <div class="footer-content container">
            <p>TimelineZ.com &copy; 2020 </p>

    </footer>
 
</div>
</body>
</html>