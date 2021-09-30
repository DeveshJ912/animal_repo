<!Doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Submission</title>
    </head>


    <?php

    #variable initialization
    $nameErr = $imgErr = $catErr = $descErr = $captchaErr= "";
    $name = $img = $category = $lifeErr = $desc = "";
    $valid ="";
    $validname="";
    $validdesc="";
    $validimg="";
    $num1=$num2=0;
    
    
# if form submitted by post method

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    #adding of captcha numbers
    $sum=$_POST['num1']+$_POST['num2'];
    $valid = true;

    #checking if name is empty or not
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $valid=false;
  } else {
    $name = test_input($_POST["name"]);
    
    if($name== ""){
      $nameErr = "Name is required";
      $valid=false;

      
    } else {
      $name = $name;
      $validname=true;
    }


  }

  
  #checking if img is empty or not
  if (empty($_FILES['img']['tmp_name'])) {
    $imgErr = "Image is required";
    $valid=false;
  } else {
    $img = ($_FILES["img"]['name']);

    if($img== ""){
      $nameErr = "Image is required";
      $validimg=false;

      
    } else {
      $img = $img;
      $validimg=true;
    }
    
  }
    
  #checking if description is empty or not
  if (empty($_POST["desc"])) {
    $descErr = "Description is required";
    $valid=false;
  } else {
    $desc = test_input($_POST["desc"]);

    if($desc== ""){
      $descErr = "Description is required";
      $valid=false;

      
    } else {
      $desc = $desc;
      $validdesc=true;
    }



  }

  #checking if life expectation is empty or not
  if (($_POST['life'])=='select') {
    $lifeErr = "Life Expectancy is required";
    $valid=false;
  } else {
    $life = test_input($_POST["life"]);
    ?>
    <!-- to select life expectancy from select dropdown -->
    <script>
        var selected_life='<?php echo $life;?>';
        
        </script>
    <?php
  }

  #checking if captcha is correct or not
  if (($_POST['number'])==$sum) {
    $valid=true;
  } else {
    $captchaErr = "Captcha Error";
    $valid=false;
  }

  #checking if category is empty or not
  if (empty($_POST['category'])) {
    $catErr = "Category is required";
    $valid=false;
  } else {
    $category = test_input($_POST['category']);
    
    ?>
    <!-- to select category from radio button -->
    <script>
        var selected_category='<?php echo $category;?>';
        
        </script>
    <?php
  }
}


# $valid variable is true if all form values are present.
if($valid && $validname && $validdesc && $validimg){
    

    # to connect database
    $conn=mysqli_connect('localhost','root','','animaldata');
    
    #if form submitted get values from post method
    if(isset($_POST['submit'])){

        
        $name=$name;
        $img=$_FILES['img'];
        $life=$_POST['life'];
        $desc=$desc;
        $img=$img;
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

    else{
        echo "error";
    }

    
}

#to remove extra blank spaces and slashes
function test_input($data) {
 
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return ($data);
}
?>


    <body>
        <h1 style="text-align: center;"> Please fill animal details below</h1>
        
        <div class="con" >
        <p><span class="error">* required field</span></p>  
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" id="formid">
                <!-- Name element in form -->
                <div class="name">
                    <label for="name"><b>Animal name:</b></label>
                    <input type="text"  id="name" name="name" placeholder="Tommy" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
                    <span class="error">* <?php echo $nameErr;?></span>
                </div>
                <!-- category element in form -->
                <div class="category">
                    <label for="Category"><b>Category:</b></label>
                    <span class="error">* <?php echo $catErr;?></span>
                    <div class="radio">
                    <input type="radio" id="herbivores" name="category"  value="herbivores" <?php if (isset($_POST['category']) && $_POST['category'] == 'herbivores') echo ' checked="checked"';?>>
                        <label >herbivores</label><br>
                        <input type="radio" id="omnivores" name="category" value="omnivores" <?php if (isset($_POST['category']) && $_POST['category'] == 'omnivores') echo ' checked="checked"';?>>
                        <label >omnivores</label><br>
                        <input type="radio" id="carnivores" name="category" value="carnivores" <?php if (isset($_POST['category']) && $_POST['category'] == 'carnivores') echo ' checked="checked"';?>>
                        <label >carnivores</label><br>
                    </div>
                </div>
                <!-- image element in form -->
                <div class="image">
                    <label for="imgfile"><b>Select an Image:</b></label>
                    <span class="im">
                        <input type="file" id="img" name="img"  onchange="return fileValidation()" value="<?php echo isset($_POST["img"]) ? $_POST["img"] : ''; ?>">
                    </span>
                    <span class="error">* <?php echo $imgErr;?></span>
                    <br>
                    <sub > Allowed file types: JPG, JPEG, PNG only.</sub>
                </div>
                
                <!-- description element in form -->
                <div class="description">
                    
                    <label for="desc" ><b>Animal Description:</b></label><span class="error">* <?php echo $descErr;?></span>
                    <br>
                    <br>
                    <textarea id="desc" name="desc" rows="3" cols="30"  ><?php echo $desc;?></textarea>
                    
                </div>

                <!-- life expectancy element in form -->
                <div class="life">
                <label for="life"><b>Life expectancy :</b></label>
                    <select id="life" name="life">
                        <option value="select">select</option>
                        <option <?php if (isset($life) && $life=="0-1 year") echo "selected";?>>0-1 year</option>
                        <option <?php if (isset($life) && $life=="1-5 years") echo "selected";?>>1-5 years</option>
                        <option <?php if (isset($life) && $life=="5-10 years") echo "selected";?>>5-10 years</option>
                        <option <?php if (isset($life) && $life=="10+ years") echo "selected";?>>10+ years</option>
                    </select>
                    <span class="error">* <?php echo $lifeErr;?></span>
                </div>
                <br>

                <!-- captcha element in form -->
                <div id="captcha">
                    <?php $num1=rand(1,100);
                          $num2=rand(1,100);?>
                    <input type="hidden" name="num1" value="<?php echo $num1; ?>">
                    <input type="hidden" name="num2" value="<?php echo $num2; ?>">
                    <label id ="captchacolor" for="captcha"><b>Captcha :</b> &emsp;</label><?php echo "$num1+$num2";?>
                    <span class="error">* <?php echo $captchaErr;?></span>
                    <br>
                    <br>
                    <input type="text"  id="number" name="number" placeholder="Enter Captcha Here">
                    <br>
                </div>
                <br>
                <!-- submit button in form -->
                <input  id = "submit"   type="submit" name="submit" value="Submit">
                
            </form>
            
            
        </div>
        <script>
            
            // checked submitted radio category by user
            document.getElementById(selected_category).checked=true;

            // select submitted life expectancy by user
            document.getElementById(selected_life).selected=true;


            function fileValidation() {
                var fileInput = document.getElementById('img');
              
                var filePath = fileInput.value;
          
            // Allowing file type
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
              
                if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            } 
        }

        </script>
    </body>
</html>