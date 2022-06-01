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
            $this->Cell(80, 10, 'Date Delivered', 1,0,'C');
            $this->Ln();
        }

        function content(){
            $this->SetLeftMargin(46);
            $this->SetFont('Times', 'B', 12);
            $this->Cell(60, 10, '123123123', 1,0,'C');
            $this->Cell(80, 10, 'Special Dog Execellence(x1), Pedigree(x1)', 1,0,'C');
            $this->Cell(80, 10, '2022-05-31 11:47:10 AM', 1,0,'C');   
            $this->Ln(); 
        }

        function totalAmount(){
            $this->SetRightMargin(30);
            $this->Cell(0, 10, 'Total Amount:', 0,true,'R');
            $this->Cell(0, 10, 'P550.00', 0,true,'R');
            $this->Ln();
        }

        function userdetails(){
            $this->SetRightMargin(30);
            $this->SetFont('Arial', '', 12);
            $this->Cell(0, 10, "User Details:", 0, true, 'R');
            $this->Cell(0, 10, "Username: Ian John Ticod", 0, true, 'R');
            $this->Cell(0, 0, "Location: 63 Zone Ube Pakna-an Mandaue City", 0, true, 'R');
            $this->Cell(0, 10, "Order Placed: 2022-05-30", 0, true, 'R');
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