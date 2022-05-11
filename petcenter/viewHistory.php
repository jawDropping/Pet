<div class = "scroll" id ="bodyright">
    <h3>Services History</h3>
    <div class = "body">
    <form method = "POST" enctype = "multipart/form-data">
    <table id = "table" cellspacing ="0" cellpadding ="0">
        <thead>
            <th>User Name</th>
            <th>Coupon Code</th>
            <th>Transaction Code</th>
            <th>Amount</th>
            <th>Date Confirmed</th>
        </thead>
        <tbody>
            <tr>
                <?php 
                    include("inc/function.php");
                    echo viewHistory();
                ?>
            </tr>
        </tbody>
    </form>
        <input type = "button" id = "btnExport" value = "PRINT" />
        <button id = "pdf">Export to PDF</button>
        <button id = "csv">Export to EXCEL</button>
    </div>

    <script src="src/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="src/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="src/jspdf.min.js"></script>
    <script type="text/javascript" src="src/jspdf.plugin.autotable.min.js"></script>
    <script type="text/javascript" src="src/tableHTMLExport.js"></script>
  
    <script>
        $("body").on("click", "#btnExport", function(){
            var printme = document.getElementById('table');
            var wme = window.open("","","width=900,height=700");
            wme.document.write(printme.outerHTML);
            wme.document.close();
            wwe.focus();
            wwe.print();
            wme.close();
        })
    </script>

    <script>
        $("#pdf").on("click", function(){
            $("#table").tableHTMLExport({
                type: 'pdf',
                filename: 'report.pdf'
            });
        });

        $("#csv").on("click", function(){
            $("#table").tableHTMLExport({
                type: 'csv',
                filename: 'report.csv'
            });
        });
    </script>
</div>

