<html>
 <head>
 <Title>Parkir Kendaraan Bermotor</Title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 </head>
 <body>

    <div class="container">

        <h1 class="text-center">Azure Cloud Development!</h1>
        <form action="index.php" method="POST">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="nama" id="name" required="">
        </div>
        <div class="form-group">
            <label for="email">NIM:</label>
            <input type="text" class="form-control" name="nim" id="nim">
        </div>
        <div class="form-group">
            <label for="NPK">Job:</label>
            <input type="text" class="form-control" name="nim" id="nim">
        </div>
        <input type="submit" class="btn btn-default" name="submit" value="Submit">
        
    </form>
 <?php
    $host = "registration1.database.windows.net";
    $user = "dicoding";
    $pass = "@Qwerty123";
    $db = "Registration";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['nama'];
            $nim = $_POST['nim'];
            $npk = $_POST['npk'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (nama, nim, npk, date) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $nim);
            $stmt->bindValue(3, $npk);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        echo "<h3>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Mahasiswa Yang sudah Tergistrasi Kendarrannya:".count($registrants)."</h2>";
                echo "<table class='table table-hover'><thead>";
                echo "<tr><th>Name</th>";
                echo "<th>NIM</th>";
                echo "<th>NPK</th>";
                echo "<th>Date</th></tr></thead><tbody>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['nama']."</td>";
                    echo "<td>".$registrant['nim']."</td>";
                    echo "<td>".$registrant['npk']."</td>";
                    echo "<td>".$registrant['date']."</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<h3>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </div>

</tbody>
</table>
 </body>
 </html>