<div id="bodyright">

<form method="post" enctype="multipart/form-data">

<h2>Add New Product Here</h2>

<table>

<tr>

<td>Enter Product Name :</td>

<td><input type="text" name="pro_name"/></td>

</tr>

<tr>

<td>Select Category Name :</td>

<td>

<select name="cat_name">

<?php  

include("include/function.php");   

echo viewall_cat();

?>

</select>

</td>

</tr>



<tr>

<td>Enter Sub-Category Name :</td>

<td><select name="sub_cat_name">

<?php  

   

echo viewall_sub_cat();

?>

</select></td>

</tr>

<tr>

<td>Enter Product Image 1 :</td>

<td><input type="file" name="pro_img1"/></td>

</tr>

<td>Enter Product Image 2 :</td>

<td><input type="file" name="pro_img2"/></td>

</tr>

<td>Enter Product Image 3 :</td>

<td><input type="file" name="pro_img3"/></td>

</tr>

<td>Enter Product Image 4 :</td>

<td><input type="file" name="pro_img4"/></td>

</tr>

<tr>

<td>Enter Feature 1 :</td>

<td><input type="text" name="pro_Feature1"/></td>

</tr>

<tr>

<td>Enter Feature 2 :</td>

<td><input type="text" name="pro_Feature2"/></td>

</tr>

<tr>

<td>Enter Feature 3 :</td>

<td><input type="text" name="pro_Feature3"/></td>

</tr>

<tr>

<td>Enter Feature 4 :</td>

<td><input type="text" name="pro_Feature4"/></td>

</tr>

<tr>

<td>Enter Feature 5 :</td>

<td><input type="text" name="pro_Feature5"/></td>

</tr>

<tr>

<td>Enter Price :</td>

<td><input type="text" name="pro_price"/></td>

</tr>

<tr>

<td>Enter Model No. :</td>

<td><input type="text" name="pro_model"/></td>

</tr>

<tr>

<td>Enter Warranty :</td>

<td><input type="text" name="pro_warranty"/></td>

</tr>

<tr>

<td>For Whom :</td>

<td>

<select name="for_whom">

<option></option>

<option value="men">Men</option>

<option value="women">Women</option>

<option value="kids">Kids</option>

</select>

</td>


</tr>


<tr>

<td>Enter Keyword :</td>

<td><input type="text" name="pro_keyword"/></td>

</tr>





</table>

<center><button name="add_product">Add Product</button></center>

</div>

</form>

<?php



echo add_pro();

?>
