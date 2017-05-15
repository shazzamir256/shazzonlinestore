<div id="bodyright">

<h2>View All Sub Categories</h2>

<form method="post" enctype="multipart/form-data"/>

<table>

<tr>

<th>Sr.No</th>

<th>Sub Category Name</th>

<th>Edit</th>

<th>Delete</th>

</tr>



<?php

include("include/function.php");

echo viewall_sub_category();

?>


</table>

</form>
<form method="post">

<h2>Add New Sub Category Here</h2>

<table>

<tr>

<td>Select Category Name :</td>

<td>

<select name="main_cat">

<?php



echo viewall_cat();



?>

</select>

</td>

</tr>


<tr>

<td>Enter Sub Category Name :</td>

<td><input type="text" name="sub_cat_name"/></td>

</tr>

</table>

<center><button name="add_sub_cat">Add Sub Category</button></center>

</div>

</form>

<?php



echo add_sub_cat();

?>
