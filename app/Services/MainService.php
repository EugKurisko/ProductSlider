<?php

namespace App\Services;

class MainService
{
    /**
     * @var array
     */
    protected $headers;

    public function __construct()
    {
        $this->headers = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ];
    }
}
