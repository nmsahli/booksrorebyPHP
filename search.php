<?php
session_start();
include_once("config.php");

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

if(isset($_GET['search']) && !empty($_GET['search'])){
	$searchQuery = $_GET['search'];
	
	$results = $mysqli->query("SELECT * FROM `books` WHERE
			`book_code` LIKE '%$searchQuery%'
		OR	`book_name` LIKE '%$searchQuery%'
		OR  `book_desc` LIKE '%$searchQuery%'
		");
} else
	die;
?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Eqraa Bookstore | Search</title>
	  <link href="css/style.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="css/responsee.css">   
	  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
   </head>
   <body class="size-1280">
      <!-- HEADER -->
      <header>
         <div class="line">
            <div class="box">
               <div class="s-6 l-2"> 
                  <img src="img/logo.png"> 
               </div>
               <div class="s-12 l-8 right">
                  <div class="margin">
                     <form  class="customform s-12 l-8" method="get" action="search.php">
                        <div class="s-9"><input name="search" type="text" placeholder="Search books" title="Search books" /></div>
                        <div class="s-3"><button type="submit">Search</button></div>
                     </form>
                     <div class="s-12 l-4">
                        <p class="right">
						<?php
						if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0){
							echo count($_SESSION["cart_products"]).' item|s / ';
							foreach($_SESSION["cart_products"] as $cItm) @$tot+=$cItm["book_price"];
							echo $currency.$tot;
						}
						?>
						</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- TOP NAV -->  
         <div class="line">
            <nav>
               <p class="nav-text">Main navigation</p>
               <div class="top-nav s-12 l-10">
                  <ul>
                     <li><a href="./">Home</a></li>
                     <li>
                        <a>Categories</a>
                        <ul>
                           <li><a href="categ.php?cat=stories">Stories</a></li>
                           <li><a href="categ.php?cat=textbooks">Textbooks</a></li>
                           <li><a href="categ.php?cat=cookbooks">Cookbooks</a></li>
                           <li><a href="categ.php?cat=childrens">Children's books</a></li>
                        </ul>
                     </li>
                     <li><a href="search_order.php">Search By Order ID</a></li>
                     <li><a href="contact.html">Contact Us</a></li>
                     <li><a href="about.html">About us</a></li>
                  </ul>
               </div>

            </nav>
         </div>
      </header>
	  <!-- View Cart Box Start -->
		<?php
		if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
		{
			echo '<div class="cart-view-table-front" id="view-cart">';
			echo '<h3>Your Shopping Cart</h3>';
			echo '<form method="post" action="cart_update.php">';
			echo '<table width="100%"  cellpadding="6" cellspacing="0">';
			echo '<tbody>';

			$total =0;
			$b = 0;
			foreach ($_SESSION["cart_products"] as $cart_itm)
			{
				$product_name = $cart_itm["book_name"];
				$product_price = $cart_itm["book_price"];
				$product_code = $cart_itm["book_code"];
				$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
				?>
				<tr class="<?=$bg_color?>">
				<td><?=$product_code?></td>
				<td><?=$product_name?></td>
				<td><?=$currency.' '.$product_price?></td>
				<td><input type="checkbox" name="remove_code[]" value="<?=$product_code?>" /> Remove</td>
				</tr>
				<?php
				$total = $product_price;
			}
			?>
			<td colspan="4">
			<button type="submit">Update</button><a href="view_cart.php" class="button">Checkout</a>
			</td>
			</tbody>
			</table>
			
			<input type="hidden" name="return_url" value="<?=$current_url?>" />
			</form>
			</div>
			<?php
		}
		?>
		<!-- View Cart Box End -->

      <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
         <div class="box">
            <div class="margin2x">
               <!-- CONTENT -->
               <section class="s-12 m-8 l-9 right">
                  <h1>Search: <?=$searchQuery?></h1>
                  <div class="margin">
				  
				  <?php
				  if(mysqli_num_rows($results) > 0){
					//fetch results in HTML
					while($row = $results->fetch_array()) {
					?>
					 <div class="s-12 m-6 l-4">
						<img src="img/<?=$row['book_img_name']?>">
						<h4 class="margin-bottom"><strong><?=$row['book_name']?></strong> | <?=$currency.$row['price']?></h4>
						<h5><?=$row['book_desc']?></h5>
						<form class="customform s-12 margin-bottom2x" method="post" action="cart_update.php">
						<input type="hidden" name="book_code" value="<?=$row['book_code']?>" />
						<input type="hidden" name="category" value="<?=$row['category']?>" />
						<input type="hidden" name="type" value="add" />
						<input type="hidden" name="return_url" value="<?=$current_url?>" />
						   <div><button class="button rounded-btn submit-btn s-12" type="submit">Add to Cart</button></div>
						</form>
					 </div>
					 <?php }
				  } else {
					  echo '<br /><h2>No match found..</h2>';
				  }
					  ?>
                  </div>
               </section>
               <!-- ASIDE NAV -->
               <aside class="s-12 m-4 l-3">
                  <div class="aside-nav minimize-on-small">
                     <p class="aside-nav-text">Sidebar navigation</p>
                  <ul>
                     <li><a href="./">Home</a></li>
                     <li>
                        <a>Categories</a>
                        <ul>
                           <li><a href="categ.php?cat=stories">Stories</a></li>
                           <li><a href="categ.php?cat=textbooks">Textbooks</a></li>
                           <li><a href="categ.php?cat=cookbooks">Cookbooks</a></li>
                           <li><a href="categ.php?cat=childrens">Children's books</a></li>
                        </ul>
                     </li>
                     <li><a href="search_order.php">Search By Order ID</a></li>
                     <li><a href="contact.html">Contact Us</a></li>
                     <li><a href="about.html">About us</a></li>
                  </ul>
                  </div>
               </aside>
            </div>
         </div>
      </div>
      <!-- FOOTER -->
      <footer class="line">
         <div>
            <p>Copyright 2017, Eqraa Store.</p>
         </div>
      </footer>
      <script type="text/javascript" src="js/responsee.js"></script>      
   </body>
</html>