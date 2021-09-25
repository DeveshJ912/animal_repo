<!Doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Submission</title>
        <style>
            .con{
                align-self: center;
                height: 500px;
                width: 450px;
                padding: 20px;
                margin-left: 430px;
                border: 2px black solid;
            }

            #formid{
                padding-top: 30px;
                padding-left: 35px;
            }

            #desc {
                    margin-left: 145px;
                    margin-top: -12px;
                }

            #ver{
                align-self: center;
                background-color: #3251b9; /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin-right: 30px;
                cursor: pointer;
                margin-left: 70px;
            }
            #submitbutton{
                background-color: #678a68; /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
            .captcha{
                margin-left: 80px;
            }
        </style>
    </head>
    <body>
        <h1 style="text-align: center;"> Please fill animal details below</h1>

        <div class="con" >
            <form action="add.php" method="POST" enctype="multipart/form-data" id="formid">
                <label for="name"><b>Animal name:</b></label>
                <input style="margin-bottom: 20px;" type="text" required="required" id="name" name="name" placeholder="Tommy"><br>

                <label for="Category"><b>Category:</b></label>
                <input style="margin-left: 4.1%;margin-top: -10%;" type="radio" id="herb" name="category" checked value="herbivores">
                <label >herbivores</label><br>
                <input style="margin-left: 21.4%;margin-top: -10%;" type="radio" id="omni" name="category" value="omnivores">
                <label >omnivores</label><br>
                <input style="margin-left: 21.4%;margin-top: -10%;" type="radio" id="carn" name="category" value="carnivores">
                <label >carnivores</label><br>
                <br>
                <label for="imgfile"><b>Select an Image:</b></label>
                <input type="file" id="img" name="img" onchange="return fileValidation()"><br>
                <sub > Allowed file types: JPG, JPEG, PNG only.</sub>
                <br>
                <br>
                <div id="ad">
                <label style="margin-top:-10px;" for="desc"><b>Animal Description:</b></label>
                </div>
         
                <textarea id="desc" name="desc" rows="3" cols="30"></textarea><br><br>

                <label for="life"><b>Life expectancy :</b></label>
                <select id="life" name="life">
                    <option value="0-1 year">0-1 year</option>
                    <option value="1-5 years">1-5 years</option>
                    <option value="5-10 years">5-10 years</option>
                    <option value="10+ years">10+ years</option>
                </select>
                <br>
                <br>
                <br>
                <div class="captcha">
                    <label for="cap"><b>&emsp;&emsp;Captcha:&nbsp;</b></label><label id="fn"></label>+<label id="sn"></label>
                <br>
                <br>
                <input type="text" id="cap" name="cap" value=""  placeholder="Enter captcha here"><br><br>
                </div>
                
                <button type="button" id="ver" onclick="verify()">verify</button>
                
                <input  id = "submitbutton"  disabled type="submit" name="submit" value="Submit">
                
            </form>

        </div>
        <script>

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

            var first=document.getElementById("fn").innerHTML = Math.floor(Math.random() * 100);
            var second=document.getElementById("sn").innerHTML = Math.floor(Math.random() * 100);
            console.log(first+' '+second);

            var sum=parseInt(first)+parseInt(second);
            console.log(sum);
            function verify(){
                console.log("vgvvjv "+document.getElementById("cap").value);

                var user = document.getElementById("cap").value;
                if(sum==user){
                    //document.getElementById("submitbutton").style.display="block";
                    document.getElementById("submitbutton").disabled=false;
                    document.getElementById("submitbutton").style.backgroundColor="#4CAF50";
                    document.getElementById("submitbutton").style.cursor="pointer";
                }
                else{
                    alert("wrong captcha");
                }
            }
        </script>
    </body>
</html>