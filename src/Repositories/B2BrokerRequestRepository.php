<?php

namespace Niomin\B2BrokerTest\Repositories;

use Niomin\B2BrokerTest\Contracts\RepositoryInterface;
use Niomin\B2BrokerTest\Exceptions\B2BrokerException;
use Niomin\B2BrokerTest\Models\B2BrokerRequest;
use Exception;
use DateTime;

class B2BrokerRequestRepository implements RepositoryInterface
{
    /**
     * @param int $id
     * @return B2BrokerRequest
     * @throws B2BrokerException
     */
    public function find(int $id): B2BrokerRequest
    {
        $supportRequest = B2BrokerRequest::find($id);
        if (!$supportRequest ||
            $supportRequest->deleted ||
            (new DateTime())->getTimestamp() - $supportRequest->created_at->getTimestamp() > config('b2broker.ttl')
        ) {
            B2BrokerException::throwNotFoundException($id);
        }
        return $supportRequest;
    }

    /**
     * @param int $id
     * @throws B2BrokerException
     * @throws Exception
     */
    public function delete(int $id)
    {
        $supportRequest = $this->find($id);
        $supportRequest->deleted = true;
        $supportRequest->save();
    }

    /**
     * @param int $id
     * @param string $text
     * @return B2BrokerRequest
     * @throws B2BrokerException
     */
    public function update(int $id, string $text): B2BrokerRequest
    {
        $supportRequest = $this->find($id);
        $supportRequest->text = $text;
        $supportRequest->save();
        return $supportRequest;
    }

    public function create(string $text): B2BrokerRequest
    {
        $supportRequest = new B2BrokerRequest();
        $supportRequest->text = $text;
        $supportRequest->save();

        return $supportRequest;
    }
}