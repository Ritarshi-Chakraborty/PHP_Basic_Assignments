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
            $this->pdf->Cell(22, 15, "Name :", 0, 0, "");
            $this->pdf->Cell(0, 15, $this->data['name'], 0, 1, "");

            $this->pdf->Cell(46, 15, "Phone Number :", 0, 0, "");
            $this->pdf->Cell(0, 15, $this->data['number'], 0, 1, "");

            $this->pdf->Cell(30, 15, "Email ID :", 0, 0, "");
            $this->pdf->Cell(0, 15, $this->data['email'], 0, 1, "");
            $this->pdf->Cell(0, 6, "", 0, 1, "C");
        }

        // Method to add result table (subjects and marks)
        protected function addResultTable() {
            // Distance from bottom of page to stop at
            $bottomMargin = 20;
            
            // Check if there's enough space left on the page
            if ($this->pdf->GetY() + 12 + $bottomMargin > $this->pdf->GetPageHeight()) {
                $this->pdf->Cell(0, 6, "", 0, 1, "C");
            }
            else {
                $this->pdf->Cell(0, 15, "", 0, 1, "C");
            }

            $this->pdf->SetFont('Arial', 'B', 16);
            $this->pdf->Cell(95, 12, "Subject", 1, 0, "C");
            $this->pdf->Cell(0, 12, "Marks", 1, 1, "C");
            $this->pdf->SetFont('Arial', 'I', 16);
            
            foreach ($this->data['result'] as $value) {
                $subject = trim(explode('|', $value)[0]);
                $marks = trim(explode('|', $value)[1]);
                // Check if there's enough space left on the page
                if ($this->pdf->GetY() + 12 + $bottomMargin > $this->pdf->GetPageHeight()) {
                    // Add new page
                    $this->pdf->AddPage();
                    $this->pdf->Cell(0, 6, "", 0, 1, "C");
                    $this->pdf->SetFont('Arial', 'B', 16);

                    $this->pdf->Cell(95, 12, "Subject", 1,  0, "C");
                    $this->pdf->Cell(0, 12, "Marks", 1, 1, "C");
                    $this->pdf->SetFont('Arial', 'I', 16);
                }
                $this->pdf->Cell(95, 12, $subject, 1, 0, "C");
                $this->pdf->Cell(0, 12, $marks, 1, 1, "C");
            }
        }

        // Method to add the user image to the PDF
        protected function addUserImage() {
            $imagePath = $this->data['image'];
            $desiredWidth = 150;
            $marginLeft = 30;
            $bottomMargin = 20;

            // Get image dimensions
            list($width, $height) = getimagesize($imagePath);

            // Calculate aspect ratio height based on desired width
            $aspectHeight = ($desiredWidth / $width) * $height;

            // Current Y and page height
            $currentY = $this->pdf->GetY();
            $pageHeight = $this->pdf->GetPageHeight();

            // Calculate if image would overflow
            if ($currentY + $aspectHeight + $bottomMargin > $pageHeight) {
                // Adjust height so it fits within the page, respecting bottom margin
                $availableHeight = $pageHeight - $currentY - $bottomMargin;
                $this->pdf->Image($imagePath, $marginLeft, $currentY, $desiredWidth, $availableHeight);
            } 
            else {
                // Enough space, show normally
                $this->pdf->Image($imagePath, $marginLeft, $currentY, $desiredWidth);
            }

            // Adjust Y to account for image space taken (even if clipped)
            $this->pdf->SetY($currentY + min($aspectHeight, $pageHeight - $currentY - $bottomMargin));

        }

        // Method to output the PDF to the browser
        function generatePDF() {
            $this->setupPage();
            $this->addPersonalDetails();
            $this->addUserImage();
            $this->addResultTable();
            $this->pdf->Output();
        }
    }

    $pdf = new UserData($userDetails);
    $pdf->generatePDF();
?>
