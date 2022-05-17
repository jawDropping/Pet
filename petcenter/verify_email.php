<form method = "POST">
    Email: <input type = 'text' name = 'email' /><br>
    V_key: <input type = 'text' name = 'v_key' /><br>
    <button name = 'submit'>Verify</button>
</form>

<?php
    include("inc/db.php");

    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $v_key = $_POST['v_key'];
        $sql = $con->prepare("SELECT * FROM pet_center_tbl WHERE email = '$email' AND v_key = '$v_key'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();
        
        $row = $sql->rowCount();
        $rows = $sql->fetch();
        $pet_center_id = $rows['pet_center_id'];

        if($row>0)
        {
            $update = $con->prepare("UPDATE pet_center_tbl SET verified = '1' WHERE pet_center_id = '$pet_center_id'");
            $update->execute();

            if($update->execute())
            {
                echo "<script>alert('Account Verified!');</script>";
                echo "<script>window.open('login.php', '_self');</script>";
            }
        }
        else
        {
            echo "<script>alert('Email or Verification Key is invalid!');</script>";
        }
    }
?>

