<!DOCTYPE html>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
    <title>Validasi</title>
</head>
<body>
    <?php
    // define variables and set to empty values
    $namaErr = $emailErr = $genderErr = $websiteErr = "";
    $nama = $email = $gender = $comment = $website = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nama"])) {
                $namaErr = "Nama harus diisi";
        }else {
            $nama = test_input($_POST["nama"]);
        }

    if (empty($_POST["email"])) {
        $emailErr = "Email harus diisi";
    }else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email tidak sesuai format"; 
        }
    }
    
    if (empty($_POST["website"])) {
        $website = "";
    }else {
        $website = test_input($_POST["website"]);
    }
    
    if (empty($_POST["comment"])) {
        $comment = "";
    }else {
        $comment = test_input($_POST["comment"]);
    }
    
    if (empty($_POST["gender"])) {
        $genderErr = "Gender harus dipilih";
    }else {
        $gender = test_input($_POST["gender"]);
        }
    }
    
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    ?>

<h2>Posting Komentar </h2>
 
<p><span class = "error">* Harus Diisi.</span></p>

<form method = "post" action = "<?php 
    echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table>
    <tr>
        <td>Nama:</td>
        <td><input type = "text" name = "nama">
        <span class = "error">* <?php echo $namaErr;?></span>
        </td>
    </tr>
    
    <tr>
        <td>E-mail: </td>
        <td><input type = "text" name = "email">
        <span class = "error">* <?php echo $emailErr;?></span>
        </td>
    </tr>
    
    <tr>
        <td>Website:</td>
        <td> <input type = "text" name = "website">
        <span class = "error"><?php echo $websiteErr;?></span>
        </td>
    </tr>
    
    <tr>
        <td>Komentar:</td>
        <td> <textarea name = "comment" rows = "5" cols = "40"></textarea></td>
    </tr>
    
    <tr>
        <td>Gender:</td>
        <td>
        <input type = "radio" name = "gender" value = "L">Laki-Laki
        <input type = "radio" name = "gender" value = "P">Perempuan
        <span class = "error">* <?php echo $genderErr;?></span>
        </td>
    </tr>
    <td>
    <input type = "submit" name = "submit" value = "Submit"> 
    </td>
    </table>
</form>

<?php
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $comment = $_POST['comment'];
    $gender = $_POST['gender'];

    // include database connection file
    include_once("koneksi.php");
        
    // Insert user data into table
    $result = mysqli_query($con, "INSERT INTO user(nama,email,website,comment,gender) 
    VALUES('$nama','$email', '$website','$comment','$gender')");

    echo "<table border=1 cellspacing=0>";
    echo "<tr>";
    echo "<th>Nama</th>";
    echo "<th>Email</th>";
    echo "<th>Website</th>";
    echo "<th>Comment</th>";
    echo "<th>Gender</th>";
    echo "</tr>";
    $ambil = $con->query("SELECT * FROM user");
    while($tampil = $ambil->fetch_assoc()){

        echo "<tr>";
        echo "<td>";
        echo $tampil['nama'];
        echo "</td>";
        echo "<td>";
        echo $tampil['email'];
        echo "</td>";
        echo "<td>";
        echo $tampil['website'];
        echo "</td>";
        echo "<td>";
        echo $tampil['comment'];
        echo "</td>";
        echo "<td>";
        echo $tampil['gender'];
        echo "</td>";
        echo "</tr>";
       
    }
    echo "</table>";
}
?>
    
</body>
</html>
