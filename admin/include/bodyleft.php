<div id="bodyleft">


<h3>Content Management<img src="../images/gearwhite.png"></img></h3>

<ul>

<li><a href="index.php"><i class="fa fa-home"style="font-size:17px;"><h2>Overview</h2></i></a></li>

<li><a href="index.php?viewall_cat">View All Categories</a></li>

<li><a href="index.php?viewall_sub_cat">View All Sub Categories</a></li>

<li><a href="index.php?add_products">Add New Products</a></li>

<li><a href="index.php?viewall_products">View All Products</a></li>
</ul>



</div>                            <!-- end of bodyleft-->


<?php

if(isset($_GET['viewall_cat']))
{
	
include("cat.php");	
	
}

if(isset($_GET['viewall_sub_cat']))
{
	
include("sub_cat.php");	
	
}


if(isset($_GET['viewall_products']))
{
	
include("viewall_products.php");	
	
}


if(isset($_GET['add_products']))
{
	
include("add_products.php");	
	
}
?>