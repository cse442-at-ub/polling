<?php
//include_once 'dbConfig.php';
// Load the database configuration file
$dbHost     = "oceanus.cse.buffalo.edu:3306";
$dbUsername = "yli55";
$dbPassword = "50054188";
$dbName     = "cse442_2021_summer_team_b_db";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_POST['importSubmit'])) {

    if (empty($_POST['course'])) {
        $feadBackErr = "Course Title is required";
        echo nl2br("<h2>Please Input Course Title, which is required to import the roster file</h2> \r\n");
    }

    //echo nl2br("18  '" . $_POST['course'] . "' \r\n");
    //echo nl2br("18 \r\n");
    $tablename = $_POST['course'];

    // check if table exists already
    $result = $db->query("SELECT * FROM $tablename ");

    if ($result->num_rows > 0) {
        // deleta data 
        $secresult = $db->query("DELETE FROM $tablename ");
        if ($secresult == true) {
            //echo "deleta all data"; // works now it will be delete all origional record for import new roster file
        } else {
            //echo "Not deleta all data";
        }
    } else {
        //echo "table is empty";
    }

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
                $UBIT   = $line[0];
                $Name   = $line[1];
                $Email  = $line[2];
                $Course  = $line[3];
                $sql = "INSERT INTO " . $_POST['course'] . " (UBIT,Name,Email,Course) VALUES ('" . $UBIT . "', '" . $Name . "', '" . $Email . "', '" . $Course . "')";
                if ($db->query($sql) === TRUE) {
                    //echo "Insert successfully";
                    echo "<br>";
                } else {
                    //echo "Error Insert: " . $conn->error;
                }
                // Check whether member already exists in the database with the same email
                // $prevQuery = "SELECT id FROM members WHERE email = '" . $line[1] . "'";
                // $prevResult = $db->query($prevQuery);

                // if ($prevResult->num_rows > 0) {
                //     // Update member data in the database
                //     $db->query("UPDATE members SET name = '" . $name . "', phone = '" . $phone . "', status = '" . $status . "', modified = NOW() WHERE email = '" . $email . "'");
                // } else {
                //     // Insert member data in the database
                //     $db->query("INSERT INTO members (name, email, phone, created, modified, status) VALUES ('" . $name . "', '" . $email . "', '" . $phone . "', NOW(), NOW(), '" . $status . "')");
                // }
            }
            //echo "<h2>Student Roster has been imported successfully.</h2>";
            //echo "<br>";
            if (!empty($_POST['course'])) {
                echo "<h2>Student Roster has been imported successfully.</h2>";
                echo "<br>";
            }

            // Close opened CSV file
            fclose($csvFile);

            $qstring = '?status=succ';
        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
        echo "<h2>Please upload a valid CSV file.</h2>";
    }
}
?>
<div class="row">


    <!-- Data list table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#UBIT</th>
                <th>----Name----</th>
                <th>----Email----</th>
                <th>----Course---- </th>

            </tr>
        </thead>
        <tbody>
            <?php
            // echo nl2br("28  '" . $_POST['course'] . "' \r\n"); $tablename
            //echo nl2br("28  '" . $tablename . "' \r\n");
            // Get member rows
            $result = $db->query("SELECT * FROM $tablename "); // this format is the best among these 3
            //$result = $db->query("SELECT * FROM members ORDER BY id DESC"); // this works as well
            //$result = $db->query("SELECT * FROM " . $tablename . "  ORDER BY id DESC"); // Works now!! all double quote 
            //$result = $db->query('SELECT * FROM ' . $tablename . '  ORDER BY id DESC');
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['UBIT']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Course']; ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="5">No Student Roster found...</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>