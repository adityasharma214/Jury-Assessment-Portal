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
                $Name = $line[1].' - '.$line[0];
                $Criteria  = $line[2];
                $Rating1  = $line[3];
                $Rating2 = $line[4];
                $Rating3 = $line[5];
                $Out_of = $line[6];

                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT `Course_id - Name`, `Criteria` FROM `rubrics` WHERE `Course_id - Name`='$line[1].' - '.$line[0]' AND `Criteria`='$Criteria' AND `Rating1`='$Rating1' AND `Rating2`='$Rating2' AND AND `Rating3`='$Rating3'";
                $prevResult = $conn->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $conn->query("UPDATE `rubrics` SET `Course_id`='".$Course_id."',`Course_id - Name`='".$Name."',`Criteria`='".$Criteria."',`Rating1`='".$Rating1."',`Rating2`='".$Rating2."',`Rating3`='".$Rating3."',`Out of`='".$Out_of."' modified = NOW() WHERE `Course_id` = '".$Course_id."'");
                    echo "Already Uploaded";
                }else{
                    // Insert member data in the database
                    $conn->query("INSERT INTO `rubrics`(`Rubrics_id`, `Course_id`, `Course_id - Name`, `Criteria`, `Rating1`, `Rating2`, `Rating3`, `Out of`) VALUES ('', '$Course_id','$Name','$Criteria','$Rating1','$Rating2','$Rating3','$Out_of')");
                    echo "Rubrics Uploaded Successfully";
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
header("Location: Rubrics.php" . $qstring);
