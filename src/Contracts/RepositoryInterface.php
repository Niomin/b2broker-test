<?php

namespace Niomin\B2BrokerTest\Contracts;

use Niomin\B2BrokerTest\Models\B2BrokerRequest;

interface RepositoryInterface
{
    public function find(int $id): B2BrokerRequest;

    public function delete(int $id);

    public function update(int $id, string $text): B2BrokerRequest;

    public function create(string $text): B2BrokerRequest;

}