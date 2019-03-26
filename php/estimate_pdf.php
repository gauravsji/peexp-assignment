    <?php
    include_once("../dbconnect/dbconnect.php");
    $enquiry_id=$_GET["enquiry_id"];
    require('fpdf/fpdf.php');
    $query_result = "SELECT * FROM enquiry e
        LEFT OUTER JOIN sales_lead sl ON e.sales_lead_id=sl.sales_lead_id
        LEFT OUTER JOIN customer c ON e.customer_id=c.customer_id
        LEFT OUTER JOIN project p ON e.project_id = p.project_id
        LEFT OUTER JOIN users u ON u.id = e.enquiry_assignee
        WHERE e.delete_status <> 1 and e.enquiry_id =" . $enquiry_id ; 
    $result = mysqli_query($conn, $query_result);
    $enquiry_result = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $pdf = new FPDF('P','mm','A4');
    $pdf->cMargin = 20;
    $total = 0;

    class PDF extends FPDF
    {
    // Page header
    function Header()
    {
    //Title
    $this->Ln(7);
        $this->SetFont('Arial','B',18);
    	$this->Ln(6);
        $this->Cell(0,1,'SMARTSTOREY',0,1,'C');
        $this->Ln(6);
        //Ensure table header is output
        parent::Header();
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','B',8);
    	
    	$message = "For any queries please contact us at sales@smartstorey.com or call us at +91-8884732111/+91-9901650420"; 
    	//$this->MultiCell(0, 0, $message);
    	$this->Cell(0,1,$message,0,1,'C');
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }
    $pdf = new PDF();
    $pdf->open();
    $pdf->AddPage();
    $pdf->AliasNbPages();   // necessary for x of y page numbers to appear in document
    $pdf->SetAutoPageBreak(false);
    $pdf->SetAutoPageBreak(true, 20); // Pages with auto-break, with a bottom margin of 40 pts.
     //$pdf->SetFillColor(36, 96, 84); 
    // document properties
    $pdf->SetAuthor('Smartstorey');
    $pdf->SetTitle('Estimate');
     $pdf->SetSubject("ESTIMATE"); 
    $pdf->SetKeywords("Smartstorey-Estimate"); 
    $pdf->SetCreator("Smartstorey"); // creator is usually the application that generated the PDF

    //$pdf->SetMargins(5, 5, 5,5); 



    //$pdf->Cell(0,1,'PURCHASE ORDER',0,1,'C');
    // Add date report ran


    $image = "../images/favicon.png";
    $pdf->Cell(85, 40, $pdf->Image($image, $pdf->GetX()+5, $pdf->GetY()-15, 37.78), 0, 0, 'L', false );
    //$pdf->Ln(55);

    $pdf->SetFont('Arial','',10);
    $pdf->Cell(55,0,'ESTIMATE');
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(22);
    //$pdf->Cell(0,0,'From: ');
    $pdf->SetLeftMargin(20);
    $pdf->SetFont('Arial','B',10);
    //$pdf->Cell(100,0,'From:');
    $pdf->Cell(123,0,'From:');

    $pdf->Cell(24,0,'Enquiry Date:');
    $pdf->SetFont('Arial','',10);
    $enquiry_date=$enquiry_result['enquiry_date'];
    $enquiry_date = date("d-m-Y", strtotime($enquiry_date));
    $pdf->Cell(20,0,''.$enquiry_date);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(2);
    $pdf->Cell(123,1,'Smartstorey');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(24,0,'Estimate No.:');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,0,''.$enquiry_id);
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(5);
    $pdf->Cell(123,1,'3rd Floor, Sampurna Chambers,');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(24,0,'Project Name:');
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(5);
    $pdf->Cell(123,1,'Opposite Vijaya Bank, Vasavi Temple Street,');
    $project_name=$enquiry_result['project_name'];
     $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,0,''.$project_name);
    $pdf->Ln(5);
    $pdf->Cell(100,1,'Basavanagudi, Bangalore');
    //$pdf->Ln(2);
    //$pdf->Multicell(0,5,"Smartstorey\n3rd Floor, Sampurna Chambers,\nOpposite Vijaya Bank, Vasavi Temple Street\nBasavanagudi Bangalore\nPhone: +91 8884732111, +91 9901650420"); 

    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(500,0,'To:');
    $pdf->Ln(4);
    $pdf->SetFont('Arial','',10);
    $customer_name=$enquiry_result['customer_name'];
    $pdf->Cell(40,0,''.$customer_name);
    $pdf->Ln(4);

    $customer_address=$enquiry_result['customer_address'];
    $pdf->Cell(40,0,''.$customer_address);
    //$from_address="Smartstorey Near ";
    //$pdf->Cell(0,0,'From: '.$from_address);
    $pdf->Ln(10);
    $pdf->Multicell(165,5,"Greetings from Smartstorey!\nPlease find the quote for the inquiry made with us. "); 
    //$pdf->SetDrawColor(0, 0, 0); //black
     
    //table header

    $pdf->SetFillColor(170, 170, 170); //gray
    $pdf->setFont("Arial","B","9");
    $pdf->setXY(1, 115); 
    //$pdf->SetTextColor(0); 
    //$pdf->SetFillColor(98, 60, 11); 
    $pdf->SetLeftMargin(20);   
    $pdf->Cell(65, 7, "Product Name", 1, 0, "", 1);
    // CHANGE THESE TO REPRESENT YOUR FIELDS
    $pdf->Cell(45, 7, "Product Description", 1, 0, "", 1);
    $pdf->Cell(15, 7, "Quantity", 1, 0, "", 1);
    $pdf->Cell(15, 7, "Price", 1, 0, "", 1);
    $pdf->Cell(15, 7, "Tax", 1, 0, "", 1);
    $pdf->Cell(15, 7, "Total", 1, 0, "", 1);
     
    $y = 122;
    $x = 1;  
     
    $pdf->setXY($x, $y);
     
    $pdf->setFont("Arial","","9");
     
    $query_result1 = "SELECT * FROM enquiry_product where delete_status <> 1 and enquiry_id=".$enquiry_id; 
    $result1 = mysqli_query($conn, $query_result1);
    while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
    {       
            $pdf->SetLeftMargin(20);
            $pdf->Cell(65, 8, $row['enquiry_product_name'], 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
            $pdf->Cell(45, 8, $row['enquiry_product_description'], 1);
            $pdf->Cell(15, 8, $row['enquiry_product_quantity'], 1);
    		$pdf->Cell(15, 8, $row['enquiry_selling_price'], 1);
    		$pdf->Cell(15, 8, $row['enquiry_tax'], 1);
    		$pdf->Cell(15, 8, $row['enquiry_total'], 1);
            $y += 8;
            $total = $total + $row['enquiry_total'];
    		
            if ($y > 260)    // When you need a page break
    		{
                $pdf->AddPage();
                $y = 40;
    			
    		}
            
            $pdf->setXY($x, $y);
    }
    $y = $y+5;
    $pdf->SetFont('Arial','B',9);
    $pdf->setXY($x, $y);
    $pdf->SetLeftMargin(20);
    $pdf->Cell(155, 8, "Transport:", 1);
    $pdf->Cell(15, 8, $enquiry_result['enquiry_transport_charge'], 1);
    $total = $total + $enquiry_result['enquiry_transport_charge'];


    $y = $y+8+5;
    $x = 1;
    $pdf->SetFont('Arial','B', 9);
    $pdf->setXY($x, $y);
    $pdf->SetLeftMargin(20);
    $pdf->Cell(155, 8, "Total:", 1);
    $pdf->Cell(15, 8, $total, 1);

    //$pdf->SetFont('Arial', ''); 
    //$pdf->Cell(200, 15, $row['order_product_name'], 0, 2); 
    //$pdf->Cell(200, 15, $row['order_product_name'] . ', ' . $row['order_product_name'], 0, 2); 
    //$pdf->Cell(200, 15, $row['order_product_name'] . ' ' . $row['order_product_name']); 
    //$pdf->Ln(100);
    //$pdf->Ln(15,$pdf->y,200,$pdf->y);


    $pdf->Output();
    ?>