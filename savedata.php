//	The MIT License (MIT)
//	
//	Copyright (c) 2015 neervfx
//		
//	Permission is hereby granted, free of charge, to any person obtaining a copy
//	of this software and associated documentation files (the "Software"), to deal
//	in the Software without restriction, including without limitation the rights
//	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//	copies of the Software, and to permit persons to whom the Software is
//	furnished to do so, subject to the following conditions:
//		
//	The above copyright notice and this permission notice shall be included in all
//	copies or substantial portions of the Software.
//		
//	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
//	SOFTWARE.

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
