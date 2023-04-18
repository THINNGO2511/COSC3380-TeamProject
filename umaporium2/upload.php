<?php
include 'connect.php';
$dbh = new Dbh;

if(isset($_POST['Submit'])) {
    if($_GET['function']=='add'){//for item add page
        //first we rename and upload the image to it's appropriate destination
        $file = $_FILES['imagefile'];
        $fileTmpName = $file['tmp_name'];

        $pid = $dbh->getNextPID();
        $fileNewName = "pid_$pid.png";
        $fileDestination = "product_img/$fileNewName";
        move_uploaded_file($fileTmpName, $fileDestination);


        // upload product data
        $name = $_POST['pname'];
        $description = $_POST['pdesc'];
        $category = $_POST['pcategory'];
        $subcategory = $_POST['psubcat'];
        $brand = $_POST['pbrand'];
        $size = $_POST['size'];
        $color =  $_POST['pcolor'];
        $price = $_POST['price'];

        if(empty($description)){
        $description = 'N/A';  
        }
        if(empty($subcategory)){
        $subcategory = 'N/A'; 
        }
        
        $dbh->insertProduct($name, $color, $category, $subcategory, $description, $brand, $size, $price);

        //redirect to item add page with success message
        header("Location: itemadd.php?upload=success");
    }

    if($_GET['function']=='edit'){// for item edit page
        
        //first we rename and upload the image to it's appropriate destination
        $file = $_FILES['imagefile'];
        if(isset($file)){
            $fileTmpName = $file['tmp_name'];

            $pid = $dbh->getNextPID();
            $fileNewName = "pid_$pid.png";
            $fileDestination = "product_img/$fileNewName";
            move_uploaded_file($fileTmpName, $fileDestination);
        }
        

        $pid = $_POST['pid'];
        $name = $_POST['pname'];
        $description = $_POST['pdesc'];
        $category = $_POST['pcategory'];
        $subcategory = $_POST['psubcat'];
        $brand = $_POST['pbrand'];
        $size = $_POST['size'];
        $color =  $_POST['pcolor'];
        $price = $_POST['price'];

        if (!empty($name)) {
            $dbh->itemedit('p_name', $name, $pid);
        }

        if (!empty($color)) {
            $dbh->itemedit('color', $color, $pid);
        }

        if (!empty($category)) {
            $dbh->itemedit('category', $category, $pid);
        }

        if (!empty($subcategory)) {
            $dbh->itemedit('subcategory', $subcategory, $pid);
        }

        if (!empty($description)) {
            $dbh->itemedit('description', $description, $pid);
        }

        if (!empty($brand)) {
            $dbh->itemedit('brand', $brand, $pid);
        }

        if (!empty($size)) {
            $dbh->itemedit('c_sizes', $size, $pid);
        }

        if (!empty($price)) {
            $dbh->itemedit('price', $price, $pid);
        }

        //redirect to item add page with success message
        header("Location: itemedit.php?upload=success");

    }

} 
