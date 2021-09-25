<?php

    # to connect database
    $conn=mysqli_connect('localhost','root','','animaldata');


    // if(isset($_POST['submit'])){
    // if(isset($_POST['filterpage'])){
    //     $filter = $_POST['filterform'];
    // }
    
    #if form submitted get values from post method
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $img=$_FILES['img'];
        $life=$_POST['life'];
        $desc=$_POST['desc'];
        $category=$_POST['category'];
        
        #to save image in uploads folder
        $target_Path = "uploads/";
        $target_Path = $target_Path.basename( $_FILES['img']['name'] );
        move_uploaded_file( $_FILES['img']['tmp_name'], $target_Path );
        $path = "uploads/".$_FILES['img']['name'];
       
        # insert data in sql table
        $sql = "INSERT INTO animal(name, category,img,descinfo,life)VALUES('$name','$category','$path','$desc','$life')";
        if ($conn->query($sql) === TRUE) {
            #redirect to animal list page
            header('Location: '.'animal.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>
   