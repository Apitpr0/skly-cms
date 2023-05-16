<?php
require_once('vendor/autoload.php'); // Include TCPDF using composer's autoloader
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');

// Get the appointments
$sql = "SELECT * FROM appointment";
$result = mysqli_query($connection, $sql);

// Start building the report HTML
$html = '<html><head><title>Appointment Report</title>';
$html .= '<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">';
$html .= '</head><body class="bg-gray-100">';
$html .= '<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">';
$html .= '<h1 class="text-3xl font-bold leading-tight text-gray-900 mb-6">Laporan Temujanji</h1>';
$html .= '<table class="table-auto w-full">';
$html .= '<thead>';
$html .= '<tr class="bg-gray-100">';
$html .= '<th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Temujanji</th>';
$html .= '<th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>';
$html .= '<th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarikh</th>';
$html .= '<th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Masa</th>';
$html .= '<th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sebab</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody class="bg-white divide-y divide-gray-200">';

// Loop through the appointments and add them to the report
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>';
    $html .= '<td class="px-4 py-2">' . $row['appt_id'] . '</td>';
    $html .= '<td class="px-4 py-2">' . $row['name'] . '</td>';
    $html .= '<td class="px-4 py-2">' . $row['appointment_date'] . '</td>';
    $html .= '<td class="px-4 py-2">' . $row['status'] . '</td>';
    $html .= '<td class="px-4 py-2">' . $row['topics'] . '</td>';
    $html .= '</tr>';
    $html .= '<br>'; // Add line break
}

// Close the table and HTML tags
$html .= '</tbody></table>';
$html .= '</div></body></html>';

// Close the database connection
mysqli_close($connection);

// Output the report as a PDF using TCPDF
ob_clean(); // Clear output buffer
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();
$pdf->writeHTML($html, true, false);

$pdf->Output('appointment_report.pdf', 'D');
exit(); // Stop script execution
