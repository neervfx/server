// Create connection
    $db = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $data1 = $_GET['data1'];
    $data2 = $_GET['data2'];
    $data3 = $_GET['data3'];
    $data4 = $_GET['data4'];
    $hash = $_GET['hash']; 

    $secretKey = "sdfgsdhsdhrhdf"; // your secret key, it hase to be same in your unity project
    $real_hash = md5($data1 . $secretKey);

    //save timestamp for future use
    $unixTimestamp = time();                                    //optional
    $mysqlTimestamp = date("Y-m-d H:i:s", $unixTimestamp);      //optional


    if($real_hash == $hash) {
        //Save your data, and if in case data already exist then replace it.
        $query = $db->prepare("INSERT INTO mytable (data1,data2,data3,data4,time) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE data2=VALUES(data2), data3=VALUES(data3), data4=VALUES(data4), time=VALUES(time)");
        $query->bind_param("sssss", $data1, $data2, $data3, $data4, $mysqlTimestamp);
        $query->execute();
        echo "Data saved";
    }
    else{
        echo "error";
    }
    mysqli_close($db);
?>
