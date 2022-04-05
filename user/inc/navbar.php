<div id = "navbar">
            <ul>
                <li>
                    <a href="/Pet/user/index.php">Pet Store</a>
                </li>
                <li>
                    <a href="/Pet/user/index.php">Discover</a>
                </li>
                
                <li> 
                    <a href = "#">Services</a>
                </li>
                <li>
                    <a href = '/Pet/user/viewall_pets.php'>View Pets</a>
                </li>
                
                <li> <a href = "/Pet/user/index.php?donation">Donate</a></li>
                <li> <a href = "/Pet/user/index.php?myPet">My Pet</a></li>
           
            </ul>
        </div>
        <?php
        if(isset($_GET['myPet'])){
            include("myPet.php");
        }
        if(isset($_GET['donation'])){
            include("donation.php");
        }
        if(isset($_GET['orders'])){
            include("orders.php");
        }
    ?>