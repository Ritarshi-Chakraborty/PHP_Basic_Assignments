<?php
    session_start();
    if (isset($_SESSION['userDetails'])) {
        $userDetails = $_SESSION['userDetails'];
    }
    
    require ('vendor/autoload.php');

    // PDF Generation Class
    class UserData {
        protected $pdf;
        protected $data;

        // Constructor accepts userDetails and initializes the PDF object
        function __construct($userDetails) {
            $this->pdf = new FPDF();
            $this->data = $userDetails;
        }

        // Method to set up the basic page
        protected function setupPage() {
            $this->pdf->AddPage();
            $this->pdf->SetFont('Arial', 'B', 20);
            $this->pdf->Cell(0, 15, "Registration Details", 1, 1, "C");
            $this->pdf->Cell(0, 10, "", 0, 1, "C");
        }

        // Method to add personal details of the user
        protected function addPersonalDetails() {
            $this->pdf->SetFont('Arial', 'I', 16);
            $this->pdf->Cell(20, 15, "Name :", 0, 0, "");
            $this->pdf->Cell(0, 15, $this->data['name'], 0, 1, "");

            $this->pdf->Cell(44, 15, "Phone Number :", 0, 0, "");
            $this->pdf->Cell(0, 15, $this->data['number'], 0, 1, "");

            $this->pdf->Cell(20, 15, "Email :", 0, 0, "");
            $this->pdf->Cell(0, 15, $this->data['email'], 0, 1, "");
            $this->pdf->Cell(0, 10, "", 0, 1, "C");
        }

        // Method to add result table (subjects and marks)
        protected function addResultTable() {
            $this->pdf->SetFont('Arial', 'B', 16);
            $this->pdf->Cell(95, 12, "Subject", 1, 0, "C");
            $this->pdf->Cell(0, 12, "Marks", 1, 1, "C");

            $this->pdf->SetFont('Arial', 'I', 16);
            foreach ($this->data['result'] as $value) {
                $subject = explode('|', $value)[0];
                $marks = explode('|', $value)[1];
                $this->pdf->Cell(95, 12, $subject, 1, 0, "C");
                $this->pdf->Cell(0, 12, $marks, 1, 1, "C");
            }
        }

        // Method to add the user image to the PDF
        protected function addUserImage() {
                $this->pdf->Image($this->data['image'], 10, 180, 190);
        }

        // Method to output the PDF to the browser
        function generatePDF() {
            $this->setupPage();
            $this->addPersonalDetails();
            $this->addResultTable();
            $this->addUserImage();
            $this->pdf->Output();
        }
    }

    $pdf = new UserData($userDetails);
    $pdf->generatePDF();
?>
