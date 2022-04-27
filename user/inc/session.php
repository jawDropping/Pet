<!-- <?php 
    include ("inc/db.php");
    session_start();
    
    if(isset($_SESSION['admin']))
    {
        header('location: admin/index.php');
    }

    if(isset($_SESSION['user_username']))
    {
        $user_id = $_POST['user_id'];
        $showUserName = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
        $showUserName->execute(['user_id'=>$_SESSION['user_username']]);
        $fetchUser = $showUserName->fetch();
    }
            
?>    
        
 -->
