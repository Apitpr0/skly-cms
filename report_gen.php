<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
// Get the appointments
$sql = "SELECT * FROM appointment";
$result = mysqli_query($connection, $sql);

// Start building the report HTML
$html = '<html><head><title>Appointment Report</title></head><body>';
$html .= '<h1>Appointment Report</h1>';
$html .= '<table>';
$html .= '<tr><th>Appointment ID</th><th>Name</th><th>Date</th><th>Time</th><th>Reason</th></tr>';

// Loop through the appointments and add them to the report
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['appt_id'] . '</td>';
    $html .= '<td>' . $row['name'] . '</td>';
    $html .= '<td>' . $row['appointment_date'] . '</td>';
    $html .= '<td>' . $row['status'] . '</td>';
    $html .= '<td>' . $row['topics'] . '</td>';
    $html .= '</tr>';
}

// Close the table and HTML tags
$html .= '</table>';
$html .= '</body></html>';

// Close the database connection
mysqli_close($connection);

// Output the report as a PDF
require_once('vendor/autoload.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('appointment_report.pdf');
