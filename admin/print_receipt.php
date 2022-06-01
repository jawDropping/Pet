<?php
    require("../fpdf184/fpdf.php");

    class myPDF extends FPDF{
        function header(){
            $this->Image('../uploads/logo.png',10,6,30);
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(276, 5, 'ORDER RECEIPT', 0, 0, 'C');
            $this->Ln();
            $this->Cell(276,10,'Your E-receipt for your order',0,0,'C');
            $this->Ln(20);
        }
        
        function headerTable(){
            $this->SetLeftMargin(46);
            $this->SetFont('Times', 'B', 12);
            $this->Cell(60, 10, 'Order #', 1,0,'C');
            $this->Cell(80, 10, 'Items', 1,0,'C');
            $this->Cell(80, 10, 'Date Placed', 1,0,'C');
            $this->Ln();
        }

        function content(){
            
            include("inc/db.php"); 
            if(isset($_GET['order_id']))
            {
                

                $q = $con->query("
                SELECT od.order_id, od.order_date, od.delivery_status, sum(od.qty * od.price), GROUP_CONCAT(concat(od.pro_name, '(x', od.qty, ')') SEPARATOR ', ') items FROM
                (select o.order_id, p.pro_name, count(p.pro_name) qty, p.pro_price price, o.delivery_status, o.order_date
                from orders_tbl o join product_tbl p on o.pro_id = p.pro_id
                WHERE o.user_id = o.user_id
                group by o.order_id, p.pro_name, o.delivery_status, o.order_date) od
                group by od.order_id, od.delivery_status, od.order_date    
                ");

                
                $orders = $q->fetchAll(PDO::FETCH_ASSOC);
                foreach ($orders as $order) 
                {
                    $mandaue = $order['sum(od.qty * od.price)']+10;
                    $cebu = $order['sum(od.qty * od.price)']+12;
                    $concolacion = $order['sum(od.qty * od.price)']+12;
                    $lapulapu = $order['sum(od.qty * od.price)']+12;

                    $order_id = $order['order_id'];
                    $view_details = $con->prepare("SELECT * FROM orders_tbl WHERE order_id = '$order_id'");
                    $view_details->setFetchMode(PDO:: FETCH_ASSOC);
                    $view_details->execute();
                
                    $row = $view_details->fetch();
                    $user_id = $row['user_id'];
            
                    $fetch_username=$con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                    $fetch_username->setFetchMode(PDO:: FETCH_ASSOC);
                    $fetch_username->execute();
        
                    $row_username = $fetch_username->fetch();
                    $user_username = $row_username['user_username'];
                    $user_contactnumber = $row_username['user_contactnumber'];
                    $user_address = $row_username['user_address'];
                    
                    $this->SetFont('Times', 'B', 12);
                    $this->Cell(60, 10, $order_id, 1,0,'C');
                    $this->Cell(80, 10, $order['items'], 1,0,'C');
                    $this->Cell(80, 10, $order['order_date'], 1,0,'C');   
                    $this->Ln();

                    if($row_username['municipality'] == "Mandaue City")
                    {
                        $this->Cell(220, 10, 'Total Amount:', 0,true,'R');
                        $this->Cell(220, 10, $mandaue, 0,true,'R');
                        $this->Ln();
                    }
                    if($row_username['municipality'] == "Cebu City")
                    {
                        $this->Cell(220, 10, 'Total Amount:', 0,true,'R');
                        $this->Cell(220, 10, $cebu, 0,true,'R');
                        $this->Ln();
                    }
                    if($row_username['municipality'] == "Consolacion")
                    {
                        $this->Cell(220, 10, 'Total Amount:', 0,true,'R');
                        $this->Cell(220, 10, $consolacion, 0,true,'R');
                        $this->Ln();
                    }
                    if($row_username['municipality'] == "Lapu-lapu")
                    {
                        $this->Cell(220, 10, 'Total Amount:', 0,true,'R');
                        $this->Cell(220, 10, $lapulapu, 0,true,'R');
                        $this->Ln();
                    }

                    $this->Cell(220, 10, "User Details:", 0, true, 'R');
                    $this->Cell(220, 10, "Username: $user_username", 0, true, 'R');
                    $this->Cell(220, 0, "Location: $user_address", 0, true, 'R');
                    $this->Cell(220, 10, "Contact Number: $user_contactnumber", 0, true, 'R');
                }
            }
        }

        function totalAmount(){
            $this->SetRightMargin(30);
           
            $this->Ln();
        }

        function userdetails(){
            $this->SetRightMargin(30);
            $this->SetFont('Arial', '', 12);
            
        }

        function storedetails(){

        }

        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        
    }

    $pdf = new myPDF();
    
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->content();
    $pdf->totalAmount();
    $pdf->userdetails();
    $pdf->Output();
?>  