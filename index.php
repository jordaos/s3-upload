<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require 'vendor/autoload.php';
  include('db.php');
  use Aws\S3\S3Client;

  $db = new Database();
  $db->connect();
  $db->select('settings','value', NULL, 'mkey="bucket"',NULL); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
  $array = $db->getResult();
  $bucket = ($array[0]['value']);

  if (!empty($_FILES)) {
    $image = $_FILES['image'];
    
    $array_name = explode('.', $image['name']);
    $extension = end($array_name);
    $image_name = (substr(md5(mt_rand()), 0, 13)) . '.' . $extension; // nome aleatório

    $s3Client = new S3Client([
      'version'     => 'latest',
      'region'      => 'us-west-1',
      'credentials' => [
          'key'    => 'xxxxxx',
          'secret' => 'xxxxxx',
      ],
    ]);
    try {
      $result = $s3Client->putObject(array(
        'Bucket'     => $bucket,
        'Key'        => $image_name,
        'SourceFile' => $image['tmp_name'],
        'ACL'        => 'public-read'
      ));

      $db->insert('images', array('image'=> $image_name));

      header("Location: index.php");
      die();
    }catch (AwsException $e) {
      // output error message if fails
      echo $e->getMessage();
      echo "\n";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="FILE" name="image" />
    <input type="SUBMIT" />
  </form>

  <div>
<?php
  $db->select('images','image',NULL,NULL,NULL); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
  $array_images = $db->getResult();
  $url = "https://s3-us-west-1.amazonaws.com/$bucket/";
  
  foreach($array_images as $value) {
    $image_name = $value['image'];
    echo '<img src="' . $url . $image_name . '" />';
  }
?>
  </div>
</body>
</html>