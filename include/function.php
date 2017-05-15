<?php

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
 

 
function add_cart(){
	
include("include/db.php");
	
if(isset($_POST['cart_btn']))

{
	
$pro_id=$_POST['pro_id'];                                              /*targeting pro_id declaring it as input type hidden in line 100 of function elextronics() to insert ip with product in cart */                     
	
$ip=getIp();
	
$check_cart=$con->prepare("select * from cart where pro_id='$pro_id' and ip_add='$ip'" );   /* This query checks double entry of one product in cart table,if user try to insert one product twice,it refuses */
	
$check_cart->execute();
	

$row_check=$check_cart->rowCount();
	

if($row_check==1){
	
	echo "<script>alert('This Product is Already Added In Your Cart');</script>";	
	
}
	
else {
	
$add_cart=$con->prepare("insert into cart(pro_id,qty,ip_add)values('$pro_id','1','$ip')");	
	
	
if($add_cart->execute())

{
	
    echo    "<script>window.open('index.php','_self');</script>";	
	
	
	
}
	
else 
{	

    echo    "<script>alert('Please Try Again');</script>";	
	
}	
}	
}	
}



function delete_cart_items()

{
	
include("include/db.php");	
	
if(isset($_GET['delete_id']))

{
	
$pro_id=$_GET['delete_id'];	
	
$delete_pro=$con->prepare("delete from cart where pro_id='$pro_id'");	
	
if($delete_pro->execute()){
	
	echo "<script>alert('Product Deleted Successfully')</script>";
	
	echo "<script>window.open('cart.php','_self')</script>";
}	
	
}	
	
}

function electronics()

{

include("include/db.php");


	
	$fetch_cat=$con->prepare("select * from main_cat where cat_id='1'");
	
	$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
	
	$fetch_cat->execute();
	
	
	$row_cat=$fetch_cat->fetch();
	
    $cat_id=$row_cat['cat_id'];
	
	echo "<h2>".$row_cat['cat_name']."</h2>";
	
	
	$fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
	
	$fetch_pro->setFetchMode(PDO:: FETCH_ASSOC); 
	
	$fetch_pro->execute();
	
	
	while($row_pro=$fetch_pro->fetch()):
	
	echo "
	
	       <form method='post' enctype='multipart/form-data'>
		   
		   <li>
		   
		   <a href='pro_details.php?pro_id=".$row_pro['pro_id']."'>
		   
		   <h4>".$row_pro['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_pro['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
		   
		   <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>                      
		   
		   <button id='pro_btn' name='cart_btn'>Cart</button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </form>
		   
		   </li> ";
	
	         

	
	endwhile;
	}



function cart_count(){
	
include("include/db.php");	
	
$ip=getIp();
	
$get_cart_item=$con->prepare("select * from cart where ip_add='$ip'");	
	
$get_cart_item->execute();

$count_cart=$get_cart_item->rowCount();                                 /* counting rows from table cart in database*/	

echo $count_cart;

}

	
function cart_display(){
	
include("include/db.php");		
	
$ip=getIp();
	
$get_cart_item=$con->prepare("select * from cart where ip_add='$ip'");	

$get_cart_item->setFetchMode(PDO:: FETCH_ASSOC);	
	
$get_cart_item->execute();

$cart_empty=$get_cart_item->rowCount();

$net_total=0;

if($cart_empty==0){                                              /* 0 means if no product in cart*/        
	
echo "<center><h2>No Product Found In Cart <a href='index.php'>Continue Shopping</a></h2></center>";	
	
}

else 

{

if(isset($_POST['up_qty'])){
	
$quantity=$_POST['qty'];	
	
foreach($quantity as $key=>$value){
	
$update_qty=$con->prepare("update cart set qty='$value' where cart_id='$key'");
	
if($update_qty->execute()){
	
	echo"<script>window.open('cart.php','_self')</script>";
	
	
}	
	
}
	
}

echo "<table cellpadding='0' cellspacing='0'>

<tr>

<th>Image</th>

<th>Product Name</th>

<th>Quantity</th>

<th>Price</th>

<th>Remove</th>

<th>Sub-Total</th>

</tr>";


while($row=$get_cart_item->fetch()):

$pro_id=$row['pro_id'];


$get_pro=$con->prepare("select * from products where pro_id ='$pro_id'");

$get_pro->setFetchMode(PDO:: FETCH_ASSOC);

$get_pro->execute();

$row_pro=$get_pro->fetch();

echo 

"<tr>

<td><img src='images/pro_img/".$row_pro['pro_img1']."'/></td>

<td>".$row_pro['pro_name']."</td>

<td><input type='text' name='qty[".$row['cart_id']."]' value='".$row['qty']."'/><input type='submit' name='up_qty' value='Save'/></td>

<td>".$row_pro['pro_price']."</td>

<td><a href='delete.php?delete_id=".$row_pro['pro_id']."'>Delete</a></td>

<td>";

$qty=$row['qty'];

$pro_price=$row_pro['pro_price'];

$sub_total=$pro_price*$qty;

echo $sub_total;

$net_total=$net_total+$sub_total;

echo "</td>

</tr>";

endwhile;
	
echo"<tr>

<td></td>                                              

<td><button id='buy_now'>Continue Shopping</button></td>

<td><button id='buy_now'>Checkout</button></td>

<td></td>

<td><b>Net Total=</b></td>

<td><b>$net_total</b></td>

</tr>";
	
}

}	
	

function Vehicles()

{

include("include/db.php");


	
	$fetch_cat=$con->prepare("select * from main_cat where cat_id='11'");
	
	  
	$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
	
	$fetch_cat->execute();
	
	
	$row_cat=$fetch_cat->fetch();
	
    $cat_id=$row_cat['cat_id'];
	
	echo "<h2>".$row_cat['cat_name']."</h2>";
	
	
	$fetch_pro=$con->prepare("select * from products where cat_id='$cat_id' LIMIT 0,3");
	
	$fetch_pro->setFetchMode(PDO:: FETCH_ASSOC); 
	
	$fetch_pro->execute();
	
	
	while($row_pro=$fetch_pro->fetch()):
	
	echo "
	
	       <li>
		   
		   <a href='pro_details.php?pro_id=".$row_pro['pro_id']."'>
		   
		   <h4>".$row_pro['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_pro['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	}


function pro_details()

{
	
	include("include/db.php");
	
	
	if(isset($_GET['pro_id'])){
		
		$pro_id=$_GET['pro_id'];
		
		$pro_fetch=$con->prepare("select * from products where pro_id='$pro_id'");
	
	    $pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
	
	    $pro_fetch->execute();
	
	    $row_pro=$pro_fetch->fetch();
	
	    $cat_id=$row_pro['cat_id'];
		
		echo "<div id='pro_img'>
		
		<img src='images/pro_img/".$row_pro['pro_img1']."' />
		
		<ul>
		
		<li><img src='images/pro_img/".$row_pro['pro_img1']."' /></li>
		
		<li><img src='images/pro_img/".$row_pro['pro_img2']."' /></li>
		
		<li><img src='images/pro_img/".$row_pro['pro_img3']."' /></li>
		
		<li><img src='images/pro_img/".$row_pro['pro_img4']."' /></li>
		
		</ul>
		    </div>
	
	    <div id ='pro_features'>
		
		<h2>".$row_pro['pro_name']."</h2> 
		
		<ul>
		
		<li>".$row_pro['pro_feature1']."</li>
		
		<li>".$row_pro['pro_feature2']."</li>
		
		<li>".$row_pro['pro_feature3']."</li>
		
		<li>".$row_pro['pro_feature4']."</li>
		
		<li>".$row_pro['pro_feature5']."</li>
		
		</ul>
		
		<ul>
		
		<li>Model No. :".$row_pro['pro_model']."</li>
		
		<li>Warranty  : ".$row_pro['pro_warranty']."</li>
		
		</ul>
		
		<br clear='all '/>
		
		<center>
		
		
		
		<h4>Selling Price :"."Rs"."&nbsp;".$row_pro['pro_price']."</h4>
		
		
		
		<form method='post'>
		
		<input type='hidden' value='".$row_pro['pro_id']."' name='pro_id'/>  
		
		<button id='buy_now' name='buy_now'>Buy Now</button>
		
		<button id='buy_now' name='cart_btn'>Add To Cart</button>
		
		</form>
		
		</center> 
		
		</div><br clear='all'/>
		
		<div id='sim_pro'>
		
		<h2>Related Products</h2>
		
		<ul>";
		
		echo add_cart();
		
		$sim_pro=$con->prepare("select * from products where pro_id!=$pro_id AND cat_id='$cat_id' LIMIT 0,5");
		
		$sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
		
		$sim_pro->execute();
		
		while($row=$sim_pro->fetch()):
		
		echo "<li>
		
		<a href='pro_details.php?pro_id=".$row['pro_id']."'>
		
		<img src='images/pro_img/".$row['pro_img1']."'/>
		
		<p>".$row['pro_name']."</p>
		
		<p>Price :"."Rs"."&nbsp;".$row['pro_price']."</p>
		
		</a>
		
		</li>";
		
		endwhile;
		
		echo "</ul>
		
		</div>";
	
			
	
	}
	
	
	
}

function all_cat()

{
	
	include("include/db.php");
	
	$all_cat=$con->prepare("select * from main_cat");
	
	$all_cat->setFetchMode(PDO:: FETCH_ASSOC); 

	$all_cat->execute();
	
	while($row=$all_cat->fetch()):
	
	echo "<li><a href='cat_detail.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";
	
	endwhile;
	}


    function cat_detail(){
	
	include("include/db.php");
	  		 
	if(isset($_GET['cat_id'])){
		
	$cat_id=$_GET['cat_id'];
	
	$cat_pro=$con->prepare("select * from products where cat_id='$cat_id'");	
		
	$cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
  
    $cat_pro->execute();

	
	$cat_name=$con->prepare("select * from main_cat where cat_id='$cat_id'");
	
    $cat_name->setFetchMode(PDO:: FETCH_ASSOC);
	
	$cat_name->execute();
	
	$row=$cat_name->fetch();
	
	$row_main_cat=$row['cat_name'];
	
	
	echo "<h2>$row_main_cat</h2>";                             /* Display name of product*/
	
	
	while($row_cat=$cat_pro->fetch()):
	
	echo "
	
	       <li>
		   
		   <a href='pro_details.php?pro_id=".$row_cat['pro_id']."'>
		   
		   <h4>".$row_cat['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_cat['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_cat['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
		
	} 
		 
	  }

	  
	  function viewall_sub_cat() {
		  
	  include("include/db.php");

      if(isset($_GET['cat_id'])){
		  
		$cat_id=$_GET['cat_id'];  
		
        $sub_cat=$con->prepare("select * from sub_cat where cat_id='$cat_id'");		
		  
	    $sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
	  
	    $sub_cat->execute();
		
		echo "<h2>Sub Categories</h2>";
		
		while($row=$sub_cat->fetch()):
		
		
		echo 
			  
			  "<li><a href='cat_detail.php?sub_cat_id=".$row['sub_cat_id']."'>".$row['sub_cat_name']."</a></li>";
			  
			  
		endwhile;
	  
	  
		
	  
	  }	  
		  
		  
	  }

	
	function sub_cat_detail(){
	
	include("include/db.php");
	  		 
	if(isset($_GET['sub_cat_id'])){
		
	$sub_cat_id=$_GET['sub_cat_id'];
	
	$sub_cat_pro=$con->prepare("select * from products where sub_cat_id='$sub_cat_id'");	
		
	$sub_cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
  
    $sub_cat_pro->execute();

	
	$sub_cat_name=$con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id'");
	
    $sub_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
	
	$sub_cat_name->execute();
	
	
	$row=$sub_cat_name->fetch();
	
	$row_sub_cat=$row['sub_cat_name'];
	
	
	echo "<h2>$row_sub_cat</h2>";                             /* Display name of product*/
	
	
	while($row_sub_cat=$sub_cat_pro->fetch()):
	
	echo "
	
	       <li>
		   
		   <a href='pro_details.php?pro_id=".$row_sub_cat['pro_id']."'>
		   
		   <h4>".$row_sub_cat['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_sub_cat['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_sub_cat['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
		
	} 
		 
	  }
	  
	 function viewall_cat() {
		  
	  include("include/db.php");

      if(isset($_GET['sub_cat_id'])){
		  
		$main_cat=$con->prepare("select * from main_cat");		
		  
	    $main_cat->setFetchMode(PDO:: FETCH_ASSOC);
	  
	    $main_cat->execute();
		
		echo "<h2>Categories</h2>";
		
		while($row=$main_cat->fetch()):
		
		
		echo 
			  
			  "<li><a href='cat_detail.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";  /* redirecting sub categories to main categories when click in right menu*/
			  
			  
		endwhile;
	  
	  
		
	  
	  }	  
		  
		  
	  }
 
	  function bd_men(){
		  
	  include("include/db.php");  
		  
	  if(isset($_GET['bd_men'])){
		  
	  $fetch_pro=$con->prepare("select * from products where for_whom='men'");
	  
	  $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
	  
	  $fetch_pro->execute();

      echo "<h2>Birthday Gifts For Men</h2>"; 

	  while($row_men=$fetch_pro->fetch()):
		
		
		echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_men['pro_id']."'>
		   
		   <h4>".$row_men['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_men['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_men['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
	  }  
		  
	  }
	  
	  function bd_women(){
		  
	  include("include/db.php");  
		  
	  if(isset($_GET['bd_women'])){
		  
	  $fetch_pro=$con->prepare("select * from products where for_whom='women'");
	  
	  $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
	  
	  $fetch_pro->execute();

      echo "<h2>Birthday Gifts For Women</h2>"; 

	  while($row_men=$fetch_pro->fetch()):
		
		
		echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_men['pro_id']."'>
		   
		   <h4>".$row_men['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_men['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_men['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
	  }  
		  
	  }

      function bd_kids(){
		  
	  include("include/db.php");  
		  
	  if(isset($_GET['bd_kids'])){
		  
	  $fetch_pro=$con->prepare("select * from products where for_whom='Kids'");
	  
	  $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
	  
	  $fetch_pro->execute();

      echo "<h2>Birthday Gifts For Kids</h2>"; 

	  while($row_men=$fetch_pro->fetch()):
		
		
		echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_men['pro_id']."'>
		   
		   <h4>".$row_men['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_men['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_men['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
	  }  
		  
	  }

	 
	 
	 function watch()
	 
	 {
		 
		 include("include/db.php"); 
		 
		 if(isset($_GET['men_watch'])){
			 
			$men_watch="watch";
			
			$watch=$con->prepare("select * from products where for_whom='men' and pro_name like '%$men_watch%'");
			 
			 $watch->setFetchMode(PDO:: FETCH_ASSOC);
			 
			 $watch->execute();
			 
			 echo "<h2>Watches For Men</h2>"; 

	         while($row_watch=$watch->fetch()):
		
		
		     echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_watch['pro_id']."'>
		   
		   <h4>".$row_watch['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_watch['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_watch['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
		 }
	 }	 
	 
		 
		 function perfumeforshamsa()
	 
	       {
		 
		 include("include/db.php"); 
		 
		 if(isset($_GET['shamsa'])){
			 
			$shamsa="perfume";
			
			$shamsa=$con->prepare("select * from products where for_whom='women' and pro_name like '%$shamsa%'");
			 
			$shamsa->setFetchMode(PDO:: FETCH_ASSOC);
			 
			$shamsa->execute();
			 
			 echo "<h2>Perfume For Shamsa</h2>"; 

	         while($row_shamsa=$shamsa->fetch()):
		
		
		     echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_shamsa['pro_id']."'>
		   
		   <h4>".$row_shamsa['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_shamsa['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_shamsa['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
		 }
	 }	 
	 
	function Lipstickforshamsa()
	 
	       {
		 
		 include("include/db.php"); 
		 
		 if(isset($_GET['shamsa_lipstick'])){
			 
			$shamsa="lipstick";
			
			$shamsa=$con->prepare("select * from products where for_whom='women' and pro_name like '%$shamsa%'");
			 
			$shamsa->setFetchMode(PDO:: FETCH_ASSOC);
			 
			$shamsa->execute();
			 
			 echo "<h2>Perfume For Shamsa</h2>"; 

	         while($row_shamsa=$shamsa->fetch()):
		
		
		     echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_shamsa['pro_id']."'>
		   
		   <h4>".$row_shamsa['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_shamsa['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_shamsa['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
		 }
	 }	 

         function Shoesforshamsa()
	 
	       {
		 
		 include("include/db.php"); 
		 
		 if(isset($_GET['shamsa_shoes'])){
			 
			$shamsa="shoes";
			
			$shamsa=$con->prepare("select * from products where for_whom='women' and pro_name like '%$shamsa%'");
			 
			$shamsa->setFetchMode(PDO:: FETCH_ASSOC);
			 
			$shamsa->execute();
			 
			 echo "<h2>Perfume For Shamsa</h2>"; 

	         while($row_shamsa=$shamsa->fetch()):
		
		
		     echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_shamsa['pro_id']."'>
		   
		   <h4>".$row_shamsa['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_shamsa['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_shamsa['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
		 }
	 }	 

	 function Toysforkids()
	 
	       {
		 
		 include("include/db.php"); 
		 
		 if(isset($_GET['toys'])){
			 
			$toys_kids="toys";
			
			$toys_kids=$con->prepare("select * from products where for_whom='kids' and pro_name like '%$toys_kids%'");
			 
			$toys_kids->setFetchMode(PDO:: FETCH_ASSOC);
			 
			$toys_kids->execute();
			 
			 echo "<h2>Toys For Kids</h2>"; 

	         while($row_toys_kids=$toys_kids->fetch()):
		
		
		     echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_toys_kids['pro_id']."'>
		   
		   <h4>".$row_toys_kids['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_toys_kids['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_toys_kids['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
		 }
	 }	 

	 
	 function Cottforkids()
	 
	       {
		 
		 include("include/db.php"); 
		 
		 if(isset($_GET['cott'])){
			 
			$toys_kids="cott";
			
			$toys_kids=$con->prepare("select * from products where for_whom='kids' and pro_name like '%$toys_kids%'");
			 
			$toys_kids->setFetchMode(PDO:: FETCH_ASSOC);
			 
			$toys_kids->execute();
			 
			 echo "<h2>Toys For Kids</h2>"; 

	         while($row_toys_kids=$toys_kids->fetch()):
		
		
		     echo 
			  
			 " <li>
		   
		   <a href='pro_details.php?pro_id=".$row_toys_kids['pro_id']."'>
		   
		   <h4>".$row_toys_kids['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row_toys_kids['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_toys_kids['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         

	
	endwhile;
	  	  
		  
		 }
	 }	 
	 
	 function search(){
		 
	 include("include/db.php"); 
		 
	 if(isset($_GET['search'])){
	 
	 $user_query=$_GET['user_query'];	 
		 
	 $search=$con->prepare("select * from products where pro_name like '%$user_query%' or pro_keyword like '%$user_query%'");	 
	 
	 $search->setFetchMode(PDO:: FETCH_ASSOC);
	 
	 $search->execute();
	 
	 echo "<div id='bodyleft'><ul>";
	 
	 if($search->rowCount()==0){
		 
		echo "<h2>Product Not Found With This Keyword</h2>";
		 
	 }
	 
	 else {
	 
	 while($row=$search->fetch()):
	 
	 

	 echo "
	
	       <li>
		   
		   <a href='pro_details.php?pro_id=".$row['pro_id']."'>
		   
		   <h4>".$row['pro_name']."</h4>
		   
		   <img src='images/pro_img/".$row['pro_img1']."'/>
		   
		   <center>
		   
		   <button id='pro_btn'><a href='pro_details.php?pro_id=".$row['pro_id']."'>View</a></button>
		   
		   <button id='pro_btn'><a href='#'>Cart</a></button>
		   
		   <button id='pro_btn'><a href='#'>Wishlist</a></button>
		   
		   </center>
		   
		   </a>
		   
		   </li> ";
	
	         
	 endwhile;
	 
	 }

	echo "</ul></div>";
	 
	 }
	 }
	 
	 
	?>