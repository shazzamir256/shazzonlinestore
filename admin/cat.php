
<div id="bodyright">

<h2>View All Categories<img src="../images/categories1.png"></img></h2>

<form method="post" enctype="multipart/form-data"/>

<table>

<tr>

<th>Sr.No</th>

<th>Category Name</th>

<th>Edit</th>

<th>Delete</th>

</tr>



<?php

include("include/function.php");

echo viewall_category();

?>


</table>

</form>
<form method="post">

<h2 id="add_cat">Add New Category Here<img src="../images/categories1.png"><img src="../images/plus.png"></img></h2>

<table >

<tr>

<td>Enter Category Name :</td>

<td><input type="text" name="cat_name"/></td>

</tr>

</table>

<center><button name="add_cat">Add Category</button></center>

</div>

</form>

<?php



echo add_cat();



?>

