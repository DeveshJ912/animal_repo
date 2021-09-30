<?php
    # to connect database
     $conn=mysqli_connect('localhost','root','','animaldata');
?>
<?php      

# if filter button is clicked
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
    
   
    # checking queries for filter variables

    #if both category and life expectancy variables are selected for filter
    if($cat!='select' && $exp!='select' ){
        $getdata="SELECT * FROM animal WHERE category='$cat' and life='$exp'";
    }
    #if life expectancy variable selected for filter
    elseif($cat=='select' && $exp!='select'){
        $getdata="SELECT * FROM animal WHERE life='$exp'";
    }
    #if category variable selected for filter
    elseif($exp=='select' && $cat!='select'){
        $getdata="SELECT * FROM animal WHERE category='$cat'";
    }

    #if none was selected
    else{
        $getdata="SELECT * FROM animal";
    }

    
    # checking queries for sorting variables

    #if both sort by submission and sort alphabetically selected
    if($sub=="sub" && $alpha=="alpha"){
        $getdata.=" ORDER BY animalID DESC, name ASC";
    }

    #if sort by submission selected
    elseif($alpha=="" && $sub=="sub"){
        $getdata.=" ORDER BY animalID DESC";
    }

    #if sort alphabetically selected
    elseif($sub=="" && $alpha=="alpha"){
        $getdata.=" ORDER BY name ASC";
    }

    #if none was selected
    else{
        $getdata;
    }
}

# when form submit button click provided all values filled
else{
    $getdata="SELECT * FROM animal";


    

}


if(!isset($_POST['filterpage'])){
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

?>

<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Animal</title>
        <style>
            
        </style>
    </head>
    <body>
        <!--html filter form-->
        <div class="container">
            <form action='animal.php' method="POST">
                <input type="hidden" name="filterform" value="1">

                <!-- Category selection in filter -->
                <label for="category"><b>Category :</b></label>
                <select id="filter_cat" name="filter_cat">
                    <option value="select">Select</option>
                    <option <?php if (isset($cat) && $cat=="herbivores") echo "selected";?>>herbivores</option>
                    <option <?php if (isset($cat) && $cat=="omnivores") echo "selected";?>>omnivores</option>
                    <option <?php if (isset($cat) && $cat=="carnivores") echo "selected";?>>carnivores</option>
                    
                </select>

                <!-- life expectancy selection in filter -->
                <label for="life"><b>Life Expectency :</b></label>
                <select id="filter_life" name="filter_life">
                <option value="select">select</option>
                <option <?php if (isset($exp) && $exp=="0-1 year") echo "selected";?>>0-1 year</option>
                <option <?php if (isset($exp) && $exp=="1-5 years") echo "selected";?>>1-5 years</option>
                <option <?php if (isset($exp) && $exp=="5-10 years") echo "selected";?>>5-10 years</option>
                <option <?php if (isset($exp) && $exp=="10+ years") echo "selected";?>>10+ years</option>
                </select>

                <!-- sort by submission checkbox in filter -->
                <label for="sortsubmission"> <b>Sort by Submission</b></label>
                <input type="checkbox" id="sub" name="sub" value="sub" <?php if(isset($_POST['sub'])) echo "checked='checked'"; ?>>
                    
                <!-- sort alphabetically checkbox in filter -->
                <label for="sortalpha"><b>Sort Alphbetically</b></label>
                <input type="checkbox" id="alpha" name="alpha" value="alpha" <?php if(isset($_POST['alpha'])) echo "checked='checked'"; ?>>
                    
                <!-- filter button -->
                <input id="filter" type="submit" name="filterpage" value="Filter">
            </form>
            
           
        </div>

        <!-- add animal button-->
        
        <a href="submission.php"><button id="add" >ADD ANIMAL</button></a>
        <!-- visitors count show-->
        <?php echo "<b>Total Visitors:$c</b>";?>
        <hr>
        <?php 
        
        #Query to be submit to sql
        $data=$conn->query($getdata);  
        $rowdata=mysqli_num_rows($data); 
        if($rowdata >0){

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

    }
    else{
        echo "<h2 style='text-align: center;'>No Records Found!</h2>";
    }
        ?>
    </body>

</html>

