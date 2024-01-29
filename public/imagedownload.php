<?php
include_once("../source/database.php");
include_once("../source/config.php");
$id = $_GET['link'];
$conn = database_connect();
$searchResults = FindImage($conn, $id);
$conn->close();

function GetQueryResultsAssoc($result)
{
  $results = [];
  if ($result) {
    for ($i = 0; $i < $result->num_rows; $i++) {
      $row = $result->fetch_assoc();
      array_push($results, $row);
    }
  } else {
    die("Invalid Results");
  }
  return $results;
};

function FindImage($conn, $id)
{
  if ($conn) {
    try {
      $q = "SELECT * FROM photos WHERE filename = ?";
      $stmt = $conn->prepare($q);
      $stmt->bind_param("s", $filename);
      $filename = "uploads/$id.png";
      $stmt->execute();
      $result = $stmt->get_result();
      $searchResults = GetQueryResultsAssoc($result);
      return $searchResults;
    } catch (Exception $ex) {
      echo 'error during query' . $ex;
      die("Invalid Image");
    }
  }
  return [];
};

if (sizeof($searchResults) == 1) {
  $filename = $searchResults[0]['filename'];
  $filepointer = fopen($filename, 'rb');
  header("Content-Type: image/png");
  header("Content-Length: " . filesize($filename));
  fpassthru($filepointer);
  exit;
} else {
  die("invalid file");
}
