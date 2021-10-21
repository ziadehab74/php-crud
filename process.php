<?php
session_start();
    $mysqli =mysqli_connect('localhost','root','','crud')
        or die(' Please Check Your Connection'.mysqli_error($mysqli));
    $update=false;
    $id= 0;
    $name='';
    $location='';
    $result='';
if (isset($_POST['save'])){
    $name=$_POST['name'];
    $location=$_POST['location'];
   
    $mysqli->query("INSERT INTO data (name, location) VALUES('$name','$location')")or 
    die($mysqli->error);
    $_SESSION['message']="Record has been saved!";
    $_SESSION['msg_type']="success";
    header("location:index.php");
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id")or die ($mysqli->error());
    $_SESSION['message']="Record has been deleted!";
    $_SESSION['msg_type']="danger";
    //echo $_SESSION['message'];
    //die;
    header("location:index.php");
}
if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update=true;
    $result=$mysqli->query("SELECT * FROM data WHERE id=$id")or die ($mysqli->error());
   if ($result->num_rows==1){
    $row =$result->fetch_array();
    $name=$row['name'];
    $location=$row['location'];
}
}
if(isset ($_POST ['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
  

    $location=$_POST['location'];
   // $location=$location['location'];
   
    $mysqli->query("UPDATE data SET name='$name',location='$location' WHERE id='$id'") or die($mysqli->error);
    $_SESSION['message']="Record has been updated!";
    $_SESSION['msg_type']="warning";
   
    header('location:index.php');
}