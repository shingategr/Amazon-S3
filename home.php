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


//Start::bucket list::-
// $result = $s3->listBuckets();
// foreach ($result['Buckets'] as $bucket) {
//     // Each Bucket value will contain a Name and CreationDate
//     echo "{$bucket['Name']} - {$bucket['CreationDate']}\n";
// }
//End::bucket list::-
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
//Start::image upload folder on server::
// $filepath = __DIR__ . '/1_1/';
// $uploadsfiles=$s3->uploadDirectory($filepath, BUKETNAME);
// echo '<pre>';
// print_r($uploadsfiles);
// die;
//End:::image upload folder on server::
//Start::create folder on server::
// $uploadsfiles=$s3->putObject(array( 
//                    'Bucket' => BUKETNAME,
//                    'Key'    => "1_2/",
//                    'Body'   => "",
//                    'ACL'    => 'public-read'
//                   ));
// $folderpath=$uploadsfiles['ObjectURL'];
// echo '<pre>';
// print_r($folderpath);
// die;
//End::create folder on server::

// $filepath = 'ganesh.jpg';
// // 3. Delete the objects.
// $returnresult=$s3->deleteObject([
//     'Bucket' => BUKETNAME,
//     'Key'    => '1_1/'.$filepath
// ]);

// echo '<pre>';
// print_r($returnresult);
// die;
//End::single image upload on server::