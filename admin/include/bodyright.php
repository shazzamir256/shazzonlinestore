
<?php

if(!isset($_GET['viewall_cat'])){                            /* remove it from below without click*/

if(!isset($_GET['viewall_sub_cat'])){                        /* remove it from below without click*/

if(!isset($_GET['add_products'])){                       /* remove it from below without click*/

if(!isset($_GET['viewall_products'])){ 
?>                           
<div id="bodyright">

<?php

if(isset($_GET['edit_cat']))
{

include("edit_cat.php");

}

if(isset($_GET['edit_sub_cat']))
{

include("edit_sub_cat.php"); 

}

if(isset($_GET['edit_pro']))
{

include("edit_pro.php"); 

}

?>

</div>                                       <!-- end of bodyright-->


<?php } } } }?>
