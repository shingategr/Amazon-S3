# Amazon-S3
image upload on amazon s3 web server
What is Amazon S3?
Amazon Simple Storage Service (Amazon S3), S3 stands for “Simple Storage Service”, is an amazon service which provides us a highly scalable, durable and secure storage. It is easy and simple to use with a simple web service interface. We can store and retrieve our data from anywhere and anytime on the web. It makes buckets for us so we can store our data in our buckets.

Amazon S3 is an ideal option that reduces file load time and bandwidth usage. We know that uploading function is the sensitive part in any web project, a little bit mistake will allow hackers to upload the malicious files. Amazon S3 will provide you the safe side. Learn more at

http://aws.amazon.com/s3/.


Benefits of Cloud Object Storage
Storing data on an AWS Cloud object storage service delivers advantages in three key areas:

1. Durability, Availability, & Scalability.

2. Security & Compliance.

3. Flexible Management.

4. Query-in-Place.

5. Broadest Ecosystem.


best video from amazon when you integration of amazon S3 :





Get started with Amazon S3

1-Sign up for an AWS account link : https://aws.amazon.com/free/?pg=ln&p=s3

2-Learn with 10-minute Tutorials link : https://aws.amazon.com/getting-started/tutorials/?pg=ln&p=s3

3-Start building with AWS link : https://aws.amazon.com/getting-started/projects/?pg=ln&p=s3


You can download most recent version of Amazon PHP SDK by running following composer command

Amazon Account (Create Your Account)
PHP Knowledge


Following steps follow :

1-create project as per you like name 

2-open command prompt run following code :


composer require aws/aws-sdk-php


3-after donwload or run above code then open your project file or path

4-make following files and put the key and secret code in this files 
config.php 


<?php
// Bucket Name
$bucket="BucketName";

//AWS access info
if (!defined('API_KEY')) define('API_KEY', 'ACCESS KEY');
if (!defined('API_SECRET')) define('API_SECRET', 'ACCESS SECRET KEY');
if (!defined('BUKETNAME')) define('BUKETNAME', 'BUCKET NAME');

    // Set Amazon s3 credentials
      $client = S3Client::factory(
      array(
      'key'    => API_KEY,
      'secret' => API_SECRET
       )
      );
?>


5-create home.php files and put below code :

<?php
require 'vendor/autoload.php';
require_once 'config.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
    //
$s3 = S3Client::factory(
        array(
            'credentials' => array(
                'key' => API_KEY,
                'secret' => API_SECRET
            ),
            'version' => 'latest',
            'region'  => 'ap-south-1'
        )
    );
?>


above code amazon s3 all property access and mention region name as per your location

below function show listing of directory or bucket name :
<?php
//Start::bucket list::-
 $result = $s3->listBuckets();
foreach ($result['Buckets'] as $bucket) {
   // Each Bucket value will contain a Name and CreationDate
     echo "{$bucket['Name']} - {$bucket['CreationDate']}\n";
 }
//End::bucket list::-
?>


in you project paste image file such as example : test.jpg , when you upload files on amazon s3 server then use following code :
Single image upload on amazon web server :
<?php
//Start::single image upload on server::
$filepath = __DIR__ . '/test.jpg';
$key=basename($filepath);
//
$tmp="test.jpg";
try {
   $finalreturn= $s3->putObject([
        'Bucket' => 'blissbasket',
        'Key'    => $key,
        'SourceFile' => $tmp,
    ]);
   //image name
$imgname=$finalreturn['ObjectURL'];

} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}
// echo '<pre>';
// print_r($imgname);
// die;
?>



when you upload on subdirectory then first create folder and then move on this particular folder :
<?php
//Start::image upload folder on server::
 $filepath = __DIR__ . '/1_1/';
 $uploadsfiles=$s3->uploadDirectory($filepath, BUKETNAME);
//End:::image upload folder on server::
//Start::create folder on server::
 $uploadsfiles=$s3->putObject(array( 
                    'Bucket' => BUKETNAME,
                    'Key'    => "1_2/",
                    'Body'   => "",
                    'ACL'    => 'public-read'
                   ));
 $folderpath=$uploadsfiles['ObjectURL'];
// echo '<pre>';
// print_r($folderpath);
// die;
//End::create folder on server::
?>


then upload on particular folder image using following code:

<?php
//Start::single image upload on server::
$filepath = __DIR__ . '/1_1/test.jpg';
$key=basename($filepath);
//
$tmp="test.jpg";
try {
   $finalreturn= $s3->putObject([
        'Bucket' => 'blissbasket',
        'Key'    => '1_1/'.$key,
        'SourceFile' => $tmp,
    ]);
   //image name
$imgname=$finalreturn['ObjectURL'];

} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}
// echo '<pre>';
// print_r($imgname);
// die;
//End::single image upload on server::
?>


following full code of image upload 

<?php

require 'vendor/autoload.php';
require_once 'config.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
 //
$s3 = S3Client::factory(
        array(
            'credentials' => array(
                'key' => API_KEY,
                'secret' => API_SECRET
            ),
            'version' => 'latest',
            'region'  => 'ap-south-1'
        )
    );
//Start::single image upload on server::
$filepath = __DIR__ . '/1_1/ganesh.jpg';
$key=basename($filepath);
//
$tmp="ganesh.jpg";
try {
   $finalreturn= $s3->putObject([
        'Bucket' => 'blissbasket',
        'Key'    => '1_1/'.$key,
        'SourceFile' => $tmp,
    ]);
   //image name
$imgname=$finalreturn['ObjectURL'];

} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}
?>


