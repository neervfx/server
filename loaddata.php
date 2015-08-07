// Create connection
    $db = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Strings must be escaped to prevent SQL injection attack. 
    $data1 = $_GET['data1'];
    $hash = $_GET['hash']; 

    $secretKey="sdfgsdhsdhrhdf";
    $real_hash = md5($id . $secretKey);

    if($real_hash == $hash) { 
        // Send variables for the MySQL database class. 

        $query = "SELECT * FROM mytable WHERE id ='$data1'";
        $result = $db->query($query);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            echo $row['data2'] . "\t" . $row['data3'] . "\t" . $row['data4'] . "\n";
        }
    }
    else{
        echo "error";
    }

    mysqli_close($db);
?>
