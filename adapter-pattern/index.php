<?php

class Youtube
{

    public function getVideoViewCount($id)
    {
        return 5000;
    }
}

interface YoutubeAdapterInterface
{
    public function getViews($id);
}

class YoutubeAdapter implements YoutubeAdapterInterface
{
    protected $client;

    public function __construct(Youtube $client)
    {
        $this->client = $client;
    }

    public function getViews($id)
    {
        return $this->client->getVideoViewCount($id);
    }
}

$youtube = new YoutubeAdapter(new Youtube());

echo $youtube->getViews('abc');