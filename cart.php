<!DOCTYPE html>
<html>
<head>
<title>Online Store</title>

<link rel="stylesheet" href="css/style.css"/>

</head>
<body>
<?php

include("include/function.php");

include("include/header.php");

include("include/navbar.php");



?>
                
<div class="cart">

<form method="post"  enctype="multipart/form-data">


<?php

echo cart_display();

?>

</table>

</form>
</div>
				

<?php

include("include/footer.php");
?>






</body>
<html>