<?php
session_start();
include_once("config.php");

//add book to session or create new one
if(isset($_POST["type"]) && $_POST["type"]=='add' /*&& $_POST["product_qty"]>0*/ )
{
	foreach($_POST as $key => $value){ //add all post vars to new_product array
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
	//remove unecessary vars
	unset($new_product['type']);
	unset($new_product['return_url']);
	
	$category = $_POST["category"];
	
 	//we need to get book name and price from database.
    $statement = $mysqli->prepare("SELECT book_name, price FROM books WHERE category = '$category' AND book_code=? LIMIT 1");
    $statement->bind_param('s', $new_product['book_code']);
    $statement->execute();
    $statement->bind_result($product_name, $price);
	
	while($statement->fetch()){
		
		//fetch book name, price from db and add to new_product array
        $new_product["book_name"] = $product_name; 
        $new_product["book_price"] = $price;
        
        if(isset($_SESSION["cart_products"])){  //if session var already exist
            if(isset($_SESSION["cart_products"][$new_product['book_code']])) //check item exist in products array
            {
                unset($_SESSION["cart_products"][$new_product['book_code']]); //unset old array item
            }           
        }
        $_SESSION["cart_products"][$new_product['book_code']] = $new_product; //update or create book session with new item  
    } 
}


//update or remove items
if(isset($_POST["remove_code"]))
{
	//remove an item from book session
	if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])){
		foreach($_POST["remove_code"] as $key){
			unset($_SESSION["cart_products"][$key]);
		}	
	}
}

//back to return url
$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
header('Location:'.$return_url);

?>