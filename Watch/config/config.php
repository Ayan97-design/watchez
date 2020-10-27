<?php
 $conn= mysqli_connect('localhost','root','rahul.x3','watchdb');
 //check connection
 if(mysqli_connect_errno()){
     echo 'failed to connect mysql' .mysqli_connect_errno();
 }
