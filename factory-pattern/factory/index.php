<?php

class Config
{
    protected $data = [
        'upload' => [
            'default' => 's3',
            'services' => [
                's3' => [
                    'key' => '123',
                    'secret' => '456',
                ],
                'ftp' => [
                    'host' => 'abc',
                ],
            ],
        ],
    ];

    public function get($keys)
    {
        $data = $this->data;
        $keys = explode('.', $keys);

        foreach ($keys as $key) {
            if (array_key_exists($key, $data)) {
                $data = $data[$key];
                continue;
            }
        }

        return $data;
    }
}

class Uploader
{
    protected $adapter;

    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    public function upload($file, $destination)
    {
        return $this->adapter;
    }
}

class S3Adapter
{
    //
}

class FTPAdapter
{
    //
}

class AdapterFactory
{
    public function make(Config $config)
    {
        switch ($config->get('upload.default')) {
            case 's3':
                return new S3Adapter;
                break;
            case 'ftp':
                return new FTPAdapter;
                break;
        }
    }
}

class UploaderFactory
{
    protected $adapter;

    public function __construct(AdapterFactory $adapter)
    {
        $this->adapter = $adapter;
    }

    public function make(Config $config)
    {
        // ... some logic here maybe.
        return new Uploader($this->adapter->make($config));
    }
}

$config = new Config;

$factory = new UploaderFactory(new AdapterFactory);
$uploader = $factory->make($config);

var_dump($uploader->upload('file.txt', 'destination.txt'));
