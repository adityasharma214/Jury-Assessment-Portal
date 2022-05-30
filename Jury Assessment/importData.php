<?php
// Load the database configuration file
include_once 'connect.php';

if (isset($_POST['importSubmit'])) {

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

        // If the file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Parse data from CSV file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                // Get row data
                $Course_id   = $line[0];
                $Criteria  = $line[1];
                $Rating1  = $line[2];
                $Rating2 = $line[3];
                $Rating3 = $line[4];
                $Out_of = $line[5];
                if ($prevResult->num_rows > 0) {

                      }
                      else{
                        $conn->query("INSERT INTO `rubrics`(`Rubrics_id`, `Course_id`, `Criteria`, `Rating1`, `Rating2`, `Rating3`, `Out of`) VALUES ('', '$Course_id','$Criteria','$Rating1','$Rating2','$Rating3','$Out_of')");
              
                      }
            }
        }
        // Close opened CSV file
        fclose($csvFile);

        $qstring = '?status=succ';
    } else {
        $qstring = '?status=err';
    }
} else {
    $qstring = '?status=invalid_file';
}


// Redirect to the listing page
header("Location: rubrics_upload.php" . $qstring);
