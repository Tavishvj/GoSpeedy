<?php
$hostname='localhost';
$uname='root';
$password='';
$db='jewellery';
$conn=mysqli_connect($hostname,$uname,$password,$db);
if(!$conn)
{
    die("cannot connect to database".mysqli_connect_error());
}

function filteration($data){
    foreach($data as $key => $value){
        $value = trim($value);
        $value = stripslashes($value);
        
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        $data[$key] = $value;
        
    }
    return $data;

}

function select($sql,$values,$datatypes){
    $conn=$GLOBALS['conn'];
    if($stmt= mysqli_prepare($conn,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return $res;

       }
       else{
        mysqli_stmt_close($stmt);
        die("query cannot be prepared");
       }
       

    }
    else{
        die("query cannot be executed - select");
    }
}

function selectAll($table){
    $conn = $GLOBALS['conn'];
    $res = mysqli_query($conn,"SELECT * FROM $table");
    return $res; 
}


function update($sql,$values,$datatypes)
{
    $conn=$GLOBALS['conn'];
    if($stmt= mysqli_prepare($conn,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;

       }
       else{
        mysqli_stmt_close($stmt);
        die("query cannot be prepared - update");
       }
       

    }
    else{
        die("query cannot be executed - update");
    }
}


function insert($sql,$values,$datatypes)
{
    $conn=$GLOBALS['conn'];
    if($stmt= mysqli_prepare($conn,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;

       }
       else{
        mysqli_stmt_close($stmt);
        die("query cannot be prepared - insert");
       }
       

    }
    else{
        die("query cannot be executed - insert");
    }
}


function delete($sql,$values,$datatypes)
{
    $conn=$GLOBALS['conn'];
    if($stmt= mysqli_prepare($conn,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
       if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;

       }
       else{
        mysqli_stmt_close($stmt);
        die("query cannot be prepared - deleted");
       }
       

    }
    else{
        die("query cannot be executed - deleted");
    }
}



?>