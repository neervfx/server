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
