<html>
    <head>

    </head>
    <body>
        <div class="main">
        <div class ="left">

            <div class="ordersBtn">
                <a id= "orderBtnid"onclick = "orderBtn()" href="/Pet/user/index.php?orders"><img src = "../uploads/orderIcon.svg" style = "margin-right: 10px;height: 20px; width: 20px;">Orders</a>
            </div>
            <div class="purchase">
            <a id = "pur" onclick = "purBtn()"><img src = "../uploads/buy.svg" style = "margin-right: 10px;height: 20px; width: 20px;">Purchase</a>
            </div>
            <div class="transactions">
            <a id = "trans" onclick = "transBtn()" ><img src = "../uploads/deal.svg" style = "margin-right: 10px;height: 20px; width: 20px;">Transactions</a>
            </div>
        </div>
        <!-- //////////////////////////////////////// -->
        <div class="right">
            <?php
            if(!isset($_GET['orders'])){
            ?>
            <div class="container">
                    <?php
                    if(isset($_GET['orders'])){
                        include("checkout.php");
                    }
                    ?>
            </div>
            <?php }?>
        </div>
        <!-- //////////////////////////////////////// -->
        </div>
       
    </body>
    <style>
        body{
            
        }
        .left{
            width: 15vw;
            height: 85vh;
            background: white;
            display: inline-flex;
           margin-left: 10px;
           margin-top: 30px;
            flex-direction: column;
        }
        .right{
            width: 80vw;
            background: #eee;
            height: 80vh;
            margin-top: 10px;
            border-radius: 10px;

        }
        .main{
            display: flex;
        }
        .ordersBtn{
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
      
        }
        .ordersBtn a{
            color: #777;
            background: #fff;
            padding-top: 20px;
            padding-bottom: 20px;
            width: 80%;
            text-align: left;
            padding-left: 10px;
            border-radius: 7px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }
        .ordersBtn a:hover{
            background: #5AF3A6;
            transition: .8s;
        }
        .purchase{
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
      
        }
        .purchase a{
            color: #777;
            background: #fff;
            padding-top: 20px;
            padding-bottom: 20px;
            width: 80%;
            text-align: left;
            padding-left: 10px;
            border-radius: 7px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }
        .purchase a:hover{
            background: #5AF3A6;
            transition: .8s;
        }
        
        .transactions{
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
      
        }
        .transactions a{
            color: #777;
            background: #fff;
            padding-top: 20px;
            padding-bottom: 20px;
            width: 80%;
            text-align: left;
            padding-left: 10px;
            border-radius: 7px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }
        .transactions a:hover{
            background: #5AF3A6;
            transition: .8s;
        }
        
        
    </style>
    <script>
        function orderBtn() {
         document.getElementById("orderBtnid").style.background = "#5AF3A6";
         document.getElementById("orderBtnid").style.color = "black";
         document.getElementById("pur").style.background = "white";
         document.getElementById("trans").style.background = "white";
        }

        function purBtn() {
         document.getElementById("orderBtnid").style.background = "white";
         document.getElementById("pur").style.background = "#5AF3A6";
         document.getElementById("pur").style.color = "black";
         document.getElementById("trans").style.background = "white";
        }
        function transBtn() {
         document.getElementById("orderBtnid").style.background = "white";
         document.getElementById("pur").style.background = "white";
         document.getElementById("trans").style.background = "#5AF3A6";
         document.getElementById("trans").style.color = "black";
        }
    </script>
</html>