<?php

return [
    'ttl'   => 15000,
    'route' => [
        'prefix' => 'b2broker',
    ],
    'db'    => [
        'tablename' => 'b2broker_request',
        'connection' => ''
    ],
    'repositoryClass' => Niomin\B2BrokerTest\Repositories\B2BrokerRequestRepository::class
];
