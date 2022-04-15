<div class="ledger">
    <div class="body">
        <p>Donation Records</p>
       <table>
        <tr>
           <th>Transaction Number</th>

            <th>Full Name</th>

            <th>Selected Organization</th>

            <th>Contact Number</th>

            <th>Contact Number</th>

            <th>Date Confirmed</th>
        </tr>
        <tr>
            <?php
                echo showledger();
            ?>
        </tr>
       </table>
    </div>

</div>
<style>
    .ledger{
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