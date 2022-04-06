<div class="manage_donation">
    <div class="body">
        <p>Donation for approval</p>
       <table>
        <tr>
            <th>Transaction Number</th>

            <th>Full Name</th>

            <th>Selected Organization</th>

            <th>Contact Number</th>

            <th>Email Address</th>

            <th>Amount</th>

            <th>Proof of Payment</th>

            <th>Action</th>
        </tr>
        <tr>
            <?php
                echo viewall_donations();
            ?>
        </tr>
       </table>
    </div>

</div>
<style>
    .manage_donation{
        height: 100vh;
        width: 100%;
  
    }
    .body{
        margin-top: 7vh;
        margin-left: 2vw;
        background: #ddd;
        height: 90%;
        width: 95%;
        border-radius: 5px;
    }
    p{
        padding: 10px;
    }
    
</style>