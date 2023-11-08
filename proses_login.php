<?php 
    include ('koneksi.php');


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST["username"];
        $password=$_POST["password"];

        $sql="select * from login where username= '".$username."' && password= '".$password."'";
        $result=mysqli_query($conn,$sql);

        $row=mysqli_fetch_array($result);

        if($row["usertype"]=="user"){
            $_SESSION["username"]=$username;
            header("location: home.php");
        }
        elseif($row["usertype"]=="admin"){
            $_SESSION["username"]=$username;
            header("location: admin.php");
        }
    }
    
?>