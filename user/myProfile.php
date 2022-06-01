    <html>
    <head>
    <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel = "stylesheet" href="css/profile.css" />
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php 
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
        <div class="mainDiv">

        <?php
    if(!isset($_SESSION['user_id']))
    {
        header("Location: login.php");
    }
    else
    {
        include("inc/db.php");
        $user_id = $_SESSION['user_id'];
        $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
        $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user_username->execute();

        $row = $fetch_user_username->fetch();
        $id = $row['user_id'];

        echo 
        
        "<div class='profileTable'>
        <div class = 'contf'>
        <form method = 'POST' enctype = 'multipart/form-data' id = 'pikt'>
        <div class = 'photo'>
            <div class = 'piktur'>
                <img id = 'profs' src = '../uploads/user_profile/".$row['user_profilephoto']."' />
            </div>
            <div class = 'intpus'>
            <div id = 'arden'>
                <p class ='uss'>Change Profile Picture</p>
                <input type = 'file'  name = 'user_profilephoto' id = 'checks' class = 'fileUpload' value = '".$row['user_profilephoto']."' required/><br>
                </div>
                <button id = 'regss' name = 'update_profile'>Update Profile Picture</button>
            </div>
         </div>
         
        </form>
        
       <form method = 'POST' enctype='multipart/form-data' id = 'datapkt'>
            
           
            <div id = 'forBckgnd'>
            <div class='formt'>
            <div class = 'innerFormt'>
                <div class='username'>
                    <p class='us'>username </p>
                    <input class='user_name'type = 'text' name =  'user_username' value = '".$row['user_username']."' />
                </div>
                <div class='username'>
                    <p class = 'us'>password </p>
                    <input class='user_name' type = 'password' name = 'user_password' value = '".$row['user_password']."' />
                </div>
                <div class = 'username'>
                    <p class='us'>email </p>
                    <input class='user_name' type = 'email' name = 'user_email' value = '".$row['user_email']."' />
                </div>
                <div class = 'username'>
                    <p class = 'us'>Contact Number: </p>
                    <input  class = 'user_name 'type = 'text' name = 'user_contactnumber' value = '".$row['user_contactnumber']."' />
                </div>";
                ?>

                <div class = 'username'>
                    <p class = 'us'>Municipality: </p>
                        <select onchange = "myFuction();" type="text" name = "municipality" class='user_name' id = 'municipal' >
                            <option value=""></option> 
                            <option value="Cebu City">Cebu City</option>
                            <option value="Consolacion">Consolacion</option>
                            <option value="Mandaue City">Mandaue City</option>
                            <option value="Lapu-Lapu City">Lapu-Lapu City</option>
                    </select> 
                </div>
               

                <div class = 'username'>
                <p class = 'us'> Barangay: </p>
                <!-- Mandaue -->
                <select name = "barangay"  id = "mandaue" class='user_name'>
                         <option value=""> </option>
                         <option value="Alang-alang">Alang-alang</option>
                         <option value="Bakilid">Bakilid</option>
                         <option value="Banilad">Banilad</option>
                         <option value="Basak">Basak</option>
                         <option value="Cabancalan">Cabancalan</option>
                         <option value="Cambaro">Cambaro</option>
                         <option value="Canduman">Canduman</option>
                         <option value="Casili">Casili</option>
                         <option value="Casuntingan">Casuntingan</option>
                         <option value="Centro">Centro</option>
                         <option value="Cubacub">Cubacub</option>
                         <option value="Guizo">Guizo</option>
                         <option value="Ibabao-Estancia">Ibabao-Estancia</option>
                         <option value="Jagobiao">Jagobiao</option>
                         <option value="Labogon">Labogon</option>
                         <option value="Looc">Look</option>
                         <option value="Maguikay">Maguikay</option>
                         <option value="Mantuyong">Mantuyong</option>
                         <option value="Opao">Opao</option>
                         <option value="Paknaan">Paknaan</option>
                         <option value="Pagsabungan">Pagsabungan</option>
                         <option value="Subangdako">Subangdako</option>
                         <option value="Tabok">Tabok</option>
                         <option value="Tawason">Tawason</option>
                         <option value="Tingub">Tingub</option>
                         <option value="Tipolo">Tipolo</option>
                         <option value="Umapad">Umapad</option>
                    </select>
                     <!-- Cebu City -->
                     <select name = "barangay"  id = "Cebu" class='user_name'>
                         <option value=""> </option>
                         <option value="Adlaon">Adlaon</option>
                         <option value="Agsungot">Agsungot</option>
                         <option value="Apas">Apas</option>
                         <option value="Babag">Babag</option>
                         <option value="Bacayan">Bacayan</option>
                         <option value="Banilad">Banilad</option>
                         <option value="Basak Pardo">Basak Pardo</option>
                         <option value="Basak San Nikolas">Basak San Nikolas</option>
                         <option value="Binaliw">Binaliw</option>
                         <option value="Bonbon">Bonbon</option>
                         <option value="Budlaan">Budlaan</option>
                         <option value="Buhisan">Buhisan</option>
                         <option value="Bulacao">Bulacao</option>
                         <option value="Buot">Buot</option>
                         <option value="Busay">Busay</option>
                         <option value="Calamba">Calamba</option>
                         <option value="Cambinocot">Cambinocot</option>
                         <option value="Capitol Site">Capitol Site</option>
                         <option value="Carreta">Carreta</option>
                         <option value="Cogon Pardo">Cogon Pardo</option>
                         <option value="Cogon Ramos">Cogon Ramos</option>
                         <option value="Day-as">Day-as</option>
                         <option value="Duljo Fatima">Duljo Fatima</option>
                         <option value="Ermita">Ermita</option>
                         <option value="Guadalupe">Guadalupe</option>
                         <option value="Guba">Guba</option>
                         <option value="Hipodromo">Hipodromo</option>
                         <option value="Inayawan">Inayawan</option>
                         <option value="Kalubihan">Kalubihan</option>
                         <option value="Kalunasan">Kalunasan</option>
                         <option value="Kamagayan">Kamagayan</option>
                         <option value="Kamputhaw">Kamputhaw</option>
                         <option value="Kasambagan">Kasambagan</option>
                         <option value="Kinasang‑an Pardo">Kinasang‑an Pardo</option>
                         <option value="Labangon">Labangon</option>
                         <option value="Lahug">Lahug</option>
                         <option value="Lorega‑San Miguel">Lorega‑San Miguel</option>
                         <option value="Lusaran">Lusaran</option>
                         <option value="Luz">Luz</option>
                         <option value="Mabini">Mabini</option>
                         <option value="Mabolo">Mabolo</option>
                         <option value="Malubong">Malubong</option>
                         <option value="Mambaling">Mambaling</option>
                         <option value="Pahina Central">Pahina Central</option>
                         <option value="Pahina San Nicolas">Pahina San Nicolase</option>
                         <option value="Pamutan">Pamutan</option>
                         <option value="Pari-an">Pari-an</option>
                         <option value="Paril">Paril</option>
                         <option value="Pasil">Pasil</option>
                         <option value="Pit-os">Pit-os</option>
                         <option value="Poblacion Pardo">Poblacion Pardo</option>
                         <option value="Pulangbato">Pulangbato</option>
                         <option value="Pung-ol Sibugay">Pung-ol Sibugay</option>
                         <option value="Punta Princesa">Punta Princesa</option>
                         <option value="Quiot">Quiot</option>
                         <option value="Sambag I">Sambag I</option>
                         <option value="Sambag II">Sambag II</option>
                         <option value="San Antonio">San Antonio</option>
                         <option value="San Jose">San Jose</option>
                         <option value="San Nicolas Prope">San Nicolas Prope</option>
                         <option value="San Roque">San Roque</option>
                         <option value="Santa Cruz">Santa Cruz</option>
                         <option value="Santo Niño">Santo Niño</option>
                         <option value="Sapangdaku">Sapangdaku</option>
                         <option value="Sawang Calero">Sawang Calero</option>
                         <option value="Sinsin">Sinsin</option>
                         <option value="Sirao">Sirao</option>
                         <option value="Suba">Suba</option>
                         <option value="Sudlon I">Sudlon I</option>
                         <option value="Sudlon II">Sudlon II</option>
                         <option value="T. Padilla">T. Padilla</option>
                         <option value="Tabunan">Tabunan</option>
                         <option value="Tagba-o">Tagba-o</option>
                         <option value="Talamban">Talamban</option>
                         <option value="Talamban">Taptap</option>
                         <option value="Talamban">Tejero</option>
                         <option value="Talamban">Tinago</option>
                         <option value="Talamban">Tisa</option>
                         <option value="Talamban">To-ong</option>
                         <option value="Talamban">Zapatera</option>
                    </select>
                    <!-- Consolacion -->
                    <select name = "barangay"  id = "Consolacion" class='user_name'>
                         <option value=""> </option>
                         <option value="Cabangahan">Cabangahan</option>
                         <option value="Cansaga">Cansaga</option>
                         <option value="Casili">Casili</option>
                         <option value="Danglag">Danglag</option>
                         <option value="Garing">Garing</option>
                         <option value="Jugan">Jugan</option>
                         <option value="Lamac">Lamac</option>
                         <option value="Lanipga">Lanipga</option>
                         <option value="Nangka">Nangka</option>
                         <option value="Panas">Panas</option>
                         <option value="Panoypoy">Panoypoy</option>
                         <option value="Pitogo">Pitogo</option>
                         <option value="Poblacion Occidental">Poblacion Occidental</option>
                         <option value="Poblacion Oriental">Poblacion Oriental</option>
                         <option value="Polog">Polog</option>
                         <option value="Pulpogan">Pulpogan</option>
                         <option value="Sacsac">Sacsac</option>
                         <option value="Tayud">Tayud</option>
                         <option value="Tilhaong">Tilhaong</option>
                         <option value="Tolotolo">Tolotolo</option>
                         <option value="Tugbongan">Tugbongan</option>
                    </select>
                    <!-- Lapu-Lapu -->
                    <select name = "barangay"  id = "Lapulapu" class='user_name'>
                         <option value=""> </option>
                         <option value="Agus">Agus</option>
                         <option value="Babag">Babag</option>
                         <option value="Bankal">Bankal</option>
                         <option value="Basak">Basak</option>
                         <option value="Buaya">Buaya</option>
                         <option value="Calawisan">Calawisan</option>
                         <option value="Canjulao">Canjulao</option>
                         <option value="Gun‑ob">Gun‑ob</option>
                         <option value="Ibo">Ibo</option>
                         <option value="Looc">Looc</option>
                         <option value="Mactan">Mactan</option>
                         <option value="Maribago">Maribago</option>
                         <option value="Marigondon">Marigondon</option>
                         <option value="Pajac">Pajac</option>
                         <option value="Pajo">Pajo</option>
                         <option value="Poblacion">Poblacion</option>
                         <option value="Punta Engaño">Punta Engaño</option>
                         <option value="Pusok">Pusok</option>
                         <option value="Subabasbas">Subabasbas</option>
                    </select>
                    <?php echo"
                 </div>
                <div class = 'username'>
                <p class = 'us'> Street: </p>
                <input  class = 'user_name 'type = 'text' name = 'user_address' value = '".$row['user_address']."' />
                 </div>
                 <div></div>
                </div>
                <div class = 'bottomBtn'>
                <div class = 'btn'>
                    <button id = 'regs2'><a id = 'bckHm' href = 'Pet/index.php'>Back to Home</a></button>
                </div>
                <div class = 'btn'>
                    <button name = 'update_user' id = 'regs'>Update Profile</button>
                </div>
                
                </div>
                </div>
                </div>
                </div>
            </div>
            </div>
        </form>
        </div>";
        

        if(isset($_POST['update_user']))
        {
            $user_username = $_POST['user_username'];
            $user_password =  $_POST['user_password'];
            $user_contactnumber = $_POST['user_contactnumber'];
            $user_email = $_POST['user_email'];
            $user_address = $_POST['user_address'];
            $barangay = $_POST['barangays'];
            $municipality = $_POST['municipality'];

            if(is_numeric($user_contactnumber))
            {
                if(strlen($user_contactnumber) <= 11)
                {
                    if(strlen($pet_center_password) >= 9 &&
                    preg_match('/[A-Z]/', $pet_center_password) > 0 &&
                    preg_match('/[a-z]/', $pet_center_password) > 0)
                    {
                        echo "Password must at least 8 characters in length with at least 1 special character, 1 number!";
                    }
                    else
                    {
                        $update_user = $con->prepare("UPDATE users_table 
                        SET 
                            user_username='$user_username',
                            user_password = '$user_password',
                            user_contactnumber = '$user_contactnumber',
                            user_email = '$user_email',
                            user_address = '$user_address',
                            barangay = '$barangay',
                            municipality = '$municipality'
                        WHERE 
                            user_id = '$id'");

                        if($update_user->execute())
                        {
                            echo "<script>alert('Your Information Successfully Updated!');</script>";
                            echo "<script>window.open('index.php?login_user=".$_SESSION['user_id']."', '_self');</script>";
                        }
                    }
                }
                else
                {
                    echo "<script>alert('Contact Number must at least 11 digits only!');</script>";
                }
            }
            else
            {
                echo "<script>alert('Only digits allowed!');</script>";
            }

        }
        if(isset($_POST['update_profile']))
        {
            $user_profilephoto = $_FILES['user_profilephoto']['name'];
            $user_profilephoto_tmp = $_FILES['user_profilephoto']['tmp_name'];

            move_uploaded_file($user_profilephoto_tmp,"..uploads/user_profile/$user_profilephoto");

            $update_profile = $con->prepare("UPDATE users_table SET user_profilephoto = '$user_profilephoto' WHERE user_id = '$id'");

            if($update_profile->execute())
            {
                echo "<script>alert('Profile Updated!');</script>";
                echo "<script>window.open('index.php?login_user=".$_SESSION['user_id']."', '_self');</script>";
            }
        }
    }
    
?>


</div>
<?php
include ("inc/footer.php"); 
?>
</body>
<script>
     let input = document.querySelector("#checks");
            let button = document.querySelector(".button");
            button.disabled = true;

            input.addEventListener("change", stateHandle);

            function stateHandle() {
           if (document.querySelector(".input").value === "") {
              button.disabled = true; //button remains disabled
              button.style.background = "#fafafa";
              button.style.boxShadow = "none";
              button.style.color = "#888";
             } else {
                  button.disabled = false; //button is enabled
                  button.style.background = "#5a5bf3";
                  button.style.boxShadow = "5px 7px 8px #aaa";
                  button.style.color = "white";
                  }
            }



            function myFuction(){
            varOne = document.getElementById('municipal').value;
                if(varOne == 'Mandaue City'){
                    document.getElementById('mandaue').setAttribute('name', 'barangays');
                    document.getElementById('Cebu').setAttribute('name', 'barangay');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangay');
                    document.getElementById('Consolacion').setAttribute('name', 'barangay');
                    document.getElementById('mandaue').style.display = "block";
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "none";
                    console.log(varOne);
                }
                if(varOne == ''){
                    
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "none";
                    //console.log(varOne);
                }
                if(varOne == 'Cebu City'){
                    document.getElementById('mandaue').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').setAttribute('name', 'barangays');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangay');
                    document.getElementById('Consolacion').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').style.display = 'block';
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "none";
                    console.log(varOne);
                }
                if(varOne == 'Consolacion'){
                    document.getElementById('mandaue').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').setAttribute('name', 'barangay');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangay');
                    document.getElementById('Consolacion').setAttribute('name', 'barangays');
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "block";
                   console.log(varOne);
                }
                if(varOne == 'Lapu-Lapu City'){
                    document.getElementById('mandaue').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').setAttribute('name', 'barangay');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangays');
                    document.getElementById('Consolacion').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Lapulapu').style.display = "block";
                    document.getElementById('Consolacion').style.display = "none";
                    console.log(varOne);
                }
                
                
   
            

        }
</script>
</html>