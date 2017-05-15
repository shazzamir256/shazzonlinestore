<div id="header">

<div id="logo">

<a href="index.php"><img src="images/shopping-logo.png"></img></a>

</div>                                       <!--end of logo-->

<div id="link">

<ul>

<li><a href="#">Download App</a></li>

<li><a href="#">Sign Up</a>

<form method="post" enctype="multipart/form-data">

<table>

<tr>

<td>Enter your Name:</td>

<td><input type="text" name="u_name"/></td>

</tr>



<tr>

<td>Enter your Email:</td>

<td><input type="email" name="u_email"/></td>

</tr>


<tr>

<td>Upload Your Picture:</td>

<td><input type="file" name="u_img" style="width:198px"/></td>

</tr>

<tr>

<td>Enter your Address:</td>

<td><textarea name="u_add" rows="4"></textarea></td>

</tr>

<tr>

<td>Enter your Country:</td>

<td><input type="text" name="u_country"/></td>

</tr>

<tr>

<td>Enter your State:</td>

<td><input type="text" name="u_state"/></td>

</tr>

<tr>

<td>Enter your Pincode:</td>

<td><input type="text" name="u_pin"/></td>

</tr>


<tr>

<td>Enter your Date of Birth:</td>

<td><input type="date" name="u_date"/></td>

</tr>

<tr>

<td>Enter Your Phone No:</td>

<td><input type="tel" name="u_phone"/></td>

</tr>

</table>

<center>

<input type="submit" name="u_signup" value="Sign Up"/>

<input type="reset" name="reset" value="Reset"/>

</center>

</form>

</li>

<li><a href="#">Login</a></li>

</ul>

</div>                                    <!--end of link-->

<div id="search">

<form method="get" action="search.php" enctype="multipart/form-data">

<input type="text" name="user_query" placeholder="&nbsp;&nbsp;Search from Here.." />

<button name="search" id="search_btn" style="cursor:pointer;">Search</button>

<button id="cart_btn"><a href="cart.php">Cart <?php echo cart_count(); ?></a></button>

</form>

</div>                                       <!--end of search-->

</div>                       <!--end of header-->
