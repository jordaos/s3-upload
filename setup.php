<?php
  require 'vendor/autoload.php';
  include('db.php');

  use Aws\S3\S3Client;

  $s3Client = new S3Client([
    'version'     => 'latest',
    'region'      => 'us-west-1',
    'credentials' => [
        'key'    => 'xxxxxx',
        'secret' => 'xxxxxx',
    ],
  ]);

$BUCKET_NAME = substr(md5(mt_rand()), 0, 13); // nome aleatório

//Creating S3 Bucket
try {
    $result = $s3Client->createBucket([
        'Bucket' => $BUCKET_NAME,
    ]);
    
    $db = new Database();
    $db->connect();
    $db->insert('settings', array('mkey'=> 'bucket', 'value' => $BUCKET_NAME));
}catch (AwsException $e) {
    // output error message if fails
    echo $e->getMessage();
    echo "\n";
}

?>