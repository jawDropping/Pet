<div class="partnerBody">
    <div class="body">
        <p>Donation Partnered Organizations</p>
       <table>
        <tr>
            <td>Name</td>
            <td>Location</td>
            <td>Contact Number</td>
            <td>Email Address</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        <tr>
            <?php
                echo viewall_partners();
            ?>
        </tr>
       </table>
    </div>

</div>
<style>
    .partnerBody{
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