<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
include_once("../../dbconnect/dbconnect.php");
require('invoice_functions.php');
$query_result = "SELECT * FROM ss_order o, customer c where o.customer_id=c.customer_id and o.order_id=1566"; 
$result = mysqli_query($conn, $query_result);
$order_result = mysqli_fetch_array($result,MYSQLI_ASSOC);

//echo $order_result['project_id'];

$query_project = "SELECT * FROM project where project_id =".$order_result['project_id']; 
$result_project = mysqli_query($conn, $query_project);
$project_result = mysqli_fetch_array($result_project,MYSQLI_ASSOC);

$query_products = "SELECT * FROM order_product where order_id=1566"; 
$result_products = mysqli_query($conn, $query_products);

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "SMARTSTOREY LLP", 
                  "D2, 3rd Floor,Sampurna Chambers\n" .
                  "Vasavi Temple Street\n".
                  "Basavanagudi\n" .
                  "Bangalore - 560004 \n".
				  "GST: 29ADCFS7940N1ZC	");
				  
//$pdf->addSociete($project_result['billing_details'] );
$pdf->fact_dev( $order_result['order_id']);
$pdf->temporaire( "SMARTSTOREY" );
$pdf->addDate( $order_result['order_date']);
$pdf->addClient($order_result['customer_id']); 
$pdf->addPageNumber("1");
$pdf->addClientAdresse($project_result['billing_details']);
$pdf->addshippingAdresse($project_result['project_site_address']);
$pdf->addReglement("Bank Transfer");
$pdf->addEcheance($order_result['order_date']);
$pdf->addNumTVA($order_result['order_brief_details']);
//$pdf->addReference("Devis ... du ....");
$pdf->SetFont('Arial','',8);
$cols=array( "SL NO"    => 10,
             "DESCRIPTION"  => 70,
             "HSN Code"  => 20,
             "QUANTITY"     => 15,
             "UNIT PRICE"      => 26,
             "TAX" => 20,
			 "Inc/Excl" => 10,
             "TOTAL"          => 26 );
$pdf->addCols( $cols);
$cols=array( "SL NO"    => "C",
             "DESCRIPTION"  => "L",
             "HSN Code"  => "L",
             "QUANTITY"     => "C",
             "UNIT PRICE"      => "L",
             "TAX" => "C",
             "Inc/Excl"          => "C" ,
             "TOTAL"          => "C" );
//$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;
$count = 1;
$inv_total = 0;
$inc_exc = "a";
$tax_amount = 0;
$without_tax = 0;
while($row_products = mysqli_fetch_array($result_products))
						{
							if ($row_products['tax_inclusive'] == 0)
							{
							$inc_exc = "Exc";
							$tax_amount = $tax_amount + ($row_products['order_selling_price'] *  $row_products['order_tax'] / 100);
							}
							else
							{
							$inc_exc = "Inc";
							}							
							
$line = array( "SL NO"    => $count,
               "DESCRIPTION"  => $row_products['order_product_name']."-".$row_products['order_product_description'],
               "HSN Code"  => "9503",
               "QUANTITY"     => $row_products['order_product_quantity'],
               "UNIT PRICE"      =>  $row_products['order_selling_price'],
               "TAX" => $row_products['order_tax'],
               "Inc/Excl" => $inc_exc,
               "TOTAL"          => $row_products['order_total']);
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
$count = $count + 1;
$inv_total = $inv_total+ $row_products['order_total'];
						}

//$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
//$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
  //                  array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
//$tab_tva = array( "1"       => 19.6,
  //                "2"       => 5.5);
/*$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => "Avec un acompte, svp..." );
*/
//$pdf->addTVAs( $params, $tab_tva, $tot_prods);
//$pdf->addCadreEurosFrancs();
$pdf->addtotalbox($tax_amount);
$pdf->Output();
?>
