<?php
    session_start();
    if (isset($_SESSION['userDetails']))
    {
        $userDetails = $_SESSION['userDetails'];
    }
    // var_dump($userDetails['result']);
    
    require ('vendor/autoload.php');
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',20);
    $pdf->Cell(0,15,"Registration Details",1,1,"C");
    $pdf->Cell(0,10,"",0,1,"C");
    $pdf->SetFont('Arial','I',16);

    $pdf->Cell(20,15,"Name :",0,0,"");
    $pdf->Cell(0,15,$userDetails['name'],0,1,"");

    $pdf->Cell(44,15,"Phone Number :",0,0,"");
    $pdf->Cell(0,15,$userDetails['number'],0,1,"");
    
    $pdf->Cell(20,15,"Email :",0,0,"");
    $pdf->Cell(0,15,$userDetails['email'],0,1,"");
    $pdf->Cell(0,10,"",0,1,"C");

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(95,12,"Subject",1,0,"C");
    $pdf->Cell(0,12,"Marks",1,1,"C");

    $pdf->SetFont("Arial","I",16);
    foreach ($userDetails['result'] as $value) {
        $subject = explode('|', $value)[0];
        $marks = explode('|', $value)[1];
        $pdf->Cell(95,12,$subject,1,0,"C");
        $pdf->Cell(0,12,$marks,1,1,"C");
    }

    $pdf->Image($userDetails['image'],10,180,190);

    $pdf->Output();
?>
