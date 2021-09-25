<?php

    # to connect database
     $conn=mysqli_connect('localhost','root','','animaldata');


//     if(isset($_POST['submit'])){
//     if(isset($_POST['filterpage'])){
//         $filter = $_POST['filterform'];
//     }
    
//     if(isset($_POST['submit'])){
//         $name=$_POST['name'];
//         $img=$_FILES['img'];
//         $life=$_POST['life'];
//         $desc=$_POST['desc'];
//         $category=$_POST['category'];
        
//         $target_Path = "uploads/";
//         $target_Path = $target_Path.basename( $_FILES['img']['name'] );
//         move_uploaded_file( $_FILES['img']['tmp_name'], $target_Path );
//         $path = "uploads/".$_FILES['img']['name'];
//         //echo "<pre>";print_r($_FILES);
    
     
//         $sql = "INSERT INTO animal(name, category,img,descinfo,life)VALUES('$name','$category','$path','$desc','$life')";
//         if ($conn->query($sql) === TRUE) {
//             echo "";
//           } else {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//           }
    
        
//     }
    
// }
?>
   





   <?php 

        

        

       
       
if(isset($_POST['filterpage'])){
    
    #assigning category and life expectancy values
    $exp=$_POST['filter_life'];
    $cat=$_POST['filter_cat'];

    #checking check box values for alphabetically sorting
    if(isset($_POST['alpha'])){
        $alpha=$_POST['alpha'];
        
    } else{
        $alpha="";
        
    }
    
    #checking check box values for submission wise sorting
    if(isset($_POST['sub'])){
        $sub=$_POST['sub'];
    } else{
        $sub="";
    }
    
   #queries to run by filling filter form
    $pre_query="SELECT * FROM animal";
    $post_query="";

    # checking queries for filter variables
    if($cat!='select' && $exp!='select' ){
        $getdata="SELECT * FROM animal WHERE category='$cat' and life='$exp'";
    }
    elseif($cat=='select' && $exp!='select'){
        $getdata="SELECT * FROM animal WHERE life='$exp'";
    }
    elseif($exp=='select' && $cat!='select'){
        $getdata="SELECT * FROM animal WHERE category='$cat'";
    }
    else{
        $getdata="SELECT * FROM animal";
    }

    
    # checking queries for sorting variables
    if($sub=="sub" && $alpha=="alpha"){
        
        $getdata.=" ORDER BY animalID DESC, name ASC";
        
    }
    elseif($alpha=="" && $sub=="sub"){
        
        $getdata.=" ORDER BY animalID DESC";
    }
    elseif($sub=="" && $alpha=="alpha"){
        $getdata.=" ORDER BY name ASC";
        
    }
    else{
        $getdata;
    }
}
else{
    $getdata="SELECT * FROM animal";


    
#counting visitors
$counter =$conn->query("SELECT * FROM counter");
while($row=mysqli_fetch_array($counter)){
    $current_count = $row['counts'];
    $new_count = $current_count+1;
    $update_count= $conn->query("UPDATE counter SET counts='$new_count'");
    $c=$new_count;
} 


    
    

}

#showing visitors number
$c = $conn->query("SELECT * FROM counter");
$row=mysqli_fetch_array($c);
$c = $row['counts'];
//echo "<b>Total Visitors: $c</b>";












?>













   

<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Animal</title>
        <style>
            table, th, td {
              border: 2px solid black;
              border-collapse: collapse;
              margin-left: 40px;
              margin-top: 40px;
              width: 1200px;
              text-align: center;

            }
            .container{
                display: inline-block;
                margin-left: 20px;
                
            }
            #filter{
                align-self: center;
                background-color: #3251b9; /* Green */
                border: none;
                color: white;
                padding: 05px 12px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin-right: 30px;
                cursor: pointer;
                margin-left: 70px;
            }
            #add{
                align-self: center;
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 5px 12px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin-right: 30px;
                cursor: pointer;
                margin-left: 50px;
            }
        </style>
    </head>
    <body>
        <!--html filter form-->
        <div class="container">
            <form action='animal.php' method="POST">
                <input type="hidden" name="filterform" value="1">
                <label for="category"><b>Category :</b></label>
                <select id="filter_cat" name="filter_cat">
                    <option value="select">Select</option>
                    <option value="herbivores">Herbivores</option>
                    <option value="carnivores">Carnivores</option>
                    <option value="omnivores">Omnivores</option>
                </select>
                <label for="life"><b>Life Expectency :</b></label>
                <select id="filter_life" name="filter_life">
                    <option value="select">Select</option>
                    <option value="0-1 year">0-1 year</option>
                    <option value="1-5 years">1-5 years</option>
                    <option value="5-10 years">5-10 years</option>
                    <option value="10+ years">10+ years</option>
                </select>

                <label for="sortsubmission"> <b>Sort by Submission</b></label>
                <input type="checkbox" id="sub" name="sub" value="sub">
                    
                <label for="sortalpha"><b>Sort Alphbetically</b></label>
                <input type="checkbox" id="alpha" name="alpha" value="alpha">
                    
                <input id="filter" type="submit" name="filterpage" value="Filter">
            </form>
            
           
        </div>

        
        
        <a href="submission.php"><button id="add" >ADD ANIMAL</button></a>
        <?php echo "<b>Total Visitors:$c</b>";?>
        <hr>
        <?php 

        

        

       
       
        // if(isset($_POST['filterpage'])){
            
        //     #assigning category and life expectancy values
        //     $exp=$_POST['filter_life'];
        //     $cat=$_POST['filter_cat'];

        //     #checking check box values for alphabetically sorting
        //     if(isset($_POST['alpha'])){
        //         $alpha=$_POST['alpha'];
                
        //     } else{
        //         $alpha="";
                
        //     }
            
        //     #checking check box values for submission wise sorting
        //     if(isset($_POST['sub'])){
        //         $sub=$_POST['sub'];
        //     } else{
        //         $sub="";
        //     }
            
        //    #queries to run by filling filter form
        //     $pre_query="SELECT * FROM animal";
        //     $post_query="";

        //     # checking queries for filter variables
        //     if($cat!='select' && $exp!='select' ){
        //         $getdata="SELECT * FROM animal WHERE category='$cat' and life='$exp'";
        //     }
        //     elseif($cat=='select' && $exp!='select'){
        //         $getdata="SELECT * FROM animal WHERE life='$exp'";
        //     }
        //     elseif($exp=='select' && $cat!='select'){
        //         $getdata="SELECT * FROM animal WHERE category='$cat'";
        //     }
        //     else{
        //         $getdata="SELECT * FROM animal";
        //     }

            
        //     # checking queries for sorting variables
        //     if($sub=="sub" && $alpha=="alpha"){
                
        //         $getdata.=" ORDER BY animalID DESC, name ASC";
                
        //     }
        //     elseif($alpha=="" && $sub=="sub"){
                
        //         $getdata.=" ORDER BY animalID DESC";
        //     }
        //     elseif($sub=="" && $alpha=="alpha"){
        //         $getdata.=" ORDER BY name ASC";
                
        //     }
        //     else{
        //         $getdata;
        //     }
        // }
        // else{
        //     $getdata="SELECT * FROM animal";


            
        // #counting visitors
        // $counter =$conn->query("SELECT * FROM counter");
        // while($row=mysqli_fetch_array($counter)){
        //     $current_count = $row['counts'];
        //     $new_count = $current_count+1;
        //     $update_count= $conn->query("UPDATE counter SET counts='$new_count'");
        //     $c=$new_count;
        // } 

        
            
            

        // }

        #showing visitors number
        // $c = $conn->query("SELECT * FROM counter");
        // $row=mysqli_fetch_array($c);
        // $c = $row['counts'];
        // echo "<b>Total Visitors: $c</b>";




        #Query to be submit to sql
        $data=$conn->query($getdata);  
        
        #creating table in html
        echo "<table>";
        echo "<tr>
            <th style=width:'100px';>IMAGE</th>   
            <th>NAME</th>
            <th>CATEGORY</th>
            <th>DESCRIPTION</th>
            <th>LIFE EXPECTENCY</th>
            <th>DATE AND TIME</th>
            </tr>";

        # looping through sql table animal data
        while($row = mysqli_fetch_array($data)){
            
            echo "<tr><td>";
            echo "<img src='{$row['img']}' width='100' height='100' alt='animal image'";
            echo "</td><td>";
            echo $row['name'];
            echo "</td><td>";
            echo $row['category'];
            echo "</td><td>";
            echo $row['descinfo'];
            echo "</td><td>";
            echo $row['life'];
            echo "</td><td>";
            echo $row['createdon'];
            echo "</td></tr>";
        }
        echo "</table>"; 
        ?>
    </body>

</html>