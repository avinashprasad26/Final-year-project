<?php

session_start();

$conn = mysqli_connect('localhost','artproject','Akks@82829124','artdb');
if (!$conn) {
  die('Connection Failed : '.mysqli_connect_error);
}
$ids=$_SESSION['user_name'];

$showquery="select * from signup where username='$ids'";
$showdata=mysqli_query($conn,$showquery);
$rows=mysqli_fetch_array($showdata);
$current_user = $rows['idd'];

// function checkLikeStatus($post_id,$user_id){
// $query1 = "SELECT * FROM like_post WHERE post_id='$post_id' AND user_id = '$user_id' ";
// $query1run = mysqli_query($conn,$query1);
// return mysqli_fetch_assoc($query1run);
// }

if (isset($_GET['follow'])){
    $user_id = $_POST['user_id'];
    $query2 = "INSERT INTO follow_list(follower_id,user_id) values($current_user,$user_id) ";
    if(mysqli_query($conn,$query2)){
        $response['status'] = true;
    }
    else{
        $response['status'] =false;
    }
    echo json_encode($response);
}

if (isset($_GET['like'])){
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $query2 = "INSERT INTO like_post(post_id,user_id) values($post_id,$user_id) ";
    if(mysqli_query($conn,$query2)){
        $response['status'] = true;
    }
    else{
        $response['status'] =false;
    }
    echo json_encode($response);
    
}

// if (isset($_GET['unlike'])){
//     $user_id = $_POST['user_id'];
//     $post_id = $_POST['post_id'];
//     $query2 = "DELET FROM like_post WHERE user_id='$user_id' && post_id='$post_id' ";
//     if(!checkLikeStatus($post_id,$user_id)){
//         if(mysqli_query($conn,$query2)){
//         $response['status'] = true;
//     }
//     else{
//         $response['status'] =false;
//     }
//     echo json_encode($response);
//     }
    
// }

mysqli_close($conn);
?>