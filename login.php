<?php
session_start(); // Start a session
include('connection.php'); // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Retrieve user input
    $id= $_POST['technician_id'];
    $email =  $_POST['email'];
    $password = $_POST['password'];

     
  $query = "SELECT * FROM technician WHERE technician_id = '$id' AND email= '$email' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['technician_id'] = $row['technician_id'];
    header("Location: dashboard.php");
  } else {
    echo "Invalid username or password!";
  }
}


mysqli_close($conn);


?>
<form method="POST">

<label for="id">ID:</label><br>
        <input type="text" id="id" name="technician_id" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <select id="type_of_service" name="type_of_service" required>
            <option value="">Select Service Type</option>
            <option value="plumber">Plumber</option>
            <option value="electrician">Electrician</option>    
        </select>


        <button type="submit" name="login">Login</button>
    </form>