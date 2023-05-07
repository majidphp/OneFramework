<?php
use Aws\S3\S3Client;
include_once './Config.php';

class S3
{
    private $client;

    public function __construct()
    {
        $client = new Aws\S3\S3Client([
            'version' => 'latest',
            'region'  => S3_REGION,
            'endpoint' => S3_ENDPOINT,
            'use_path_style_endpoint' => false,
            'credentials' => [
                'key'    => S3_KEY,
                'secret' => S3_SECRET,
            ],
        ]);
        if ($client == false) {
            echo 'S3 login invalid';
            die;
        }
        $this->client = $client;
    }

    public function Upload($bucket, $path, $file)
    {
        $result = $this->client->putObject([
            'Bucket' => $bucket,
            'Key'    => pathinfo($file)['filename'],
            'Body'   => fopen($file, 'rb'),
            'ACL'    => 'public-read'
       ]);
       if ($result) {
            return $result['ObjectURL'];
       }
       return false;
    }

}
