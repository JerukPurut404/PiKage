<?php
include_once('../source/database.php');
include_once('../source/config.php');

$conn = database_connect();
$curl = curl_init();

function handlefile($file, $fileid){
  $location = $file['tmp_name'];
  $ext = '.png';
  $filename = "uploads/$fileid$ext";
  move_uploaded_file($location, $filename);
  return $filename;
}

function insertImageInDb($conn,$type,$size,$filename,$link){
  $stmt = $conn->prepare('INSERT INTO photos (type, size, filename, link) VALUES (?, ?, ?, ?)');
  $stmt->bind_param('siss', $type, $size, $filename, $link);
  $stmt->execute();
  $stmt->close();
}

function createLink($fileid){
  $link = 'https://' . $_SERVER['HTTP_HOST'] . '/ThroughTheFire/public/imagedownload.php?link=' . $fileid;
  return $link;
}

function UguuAPI($curl, $filename){
  curl_setopt($curl, CURLOPT_URL, "https://uguu.se/upload");
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3');
  $data = array("files[]" => new CurlFile($filename, "image/png", $filename));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  $response = curl_exec($curl);
  $json_response = json_decode($response, true);
  return $json_response['files'][0]['url'];
}

$response=['succeeded' => false, 'message' => '', 'downloadlink' => null, 'upload_path' => null];

$file = $_FILES['image'];
if ($file['error'] == 0){
  $fileid = uniqid();
  $link = createLink($fileid);
  $filename = handlefile($file, $fileid);
  $type = $file['type'];
  $size = $file['size'];
  insertImageInDb($conn,$type, $size, $filename, $link);
  $response['succeeded'] = true;
  $response['downloadlink'] = $link;
  $response['upload_path'] = UguuAPI($curl, $filename);
}
else{
  $response['message'] = 'error during upload ' . $file['error'];
} 

$json_response = json_encode($response);
echo $json_response;