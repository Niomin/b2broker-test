<?php

namespace Niomin\B2BrokerTest\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Niomin\B2BrokerTest\Exceptions\B2BrokerException;
use Niomin\B2BrokerTest\Models\B2BrokerRequest;

class B2BrokerController extends Controller
{
    public function index()
    {
        return response('Hello from B2Broker package');
    }

    public function create(Request $request)
    {
        try {
            $supportRequest = new B2BrokerRequest();
            $supportRequest->text = $request->get('text');
            $supportRequest->save();

            $response = $this->makeResponse($supportRequest);
            $statusCode = 200;

        } catch (Exception $e) {

            $response = ['code' => $e->getCode(), 'message' => $e->getMessage()];
            $statusCode = 400;

        }

        return response($response, $statusCode);
    }

    public function read(int $id)
    {
        try {

            $response = $this->makeResponse($this->find($id));
            $statusCode = 200;

        } catch (B2BrokerException $e) {

            $response = $e->getResponse();
            $statusCode = 400;

        }
        return response($response, $statusCode);
    }

    public function update(int $id, Request $request)
    {
        try {

            $supportRequest = $this->find($id);
            $supportRequest->text = $request->get('text');
            $supportRequest->save();
            $response = $this->makeResponse($supportRequest);
            $statusCode = 200;

        } catch (B2BrokerException $e) {

            $response = $e->getResponse();
            $statusCode = 400;

        }

        return response($response, $statusCode);
    }

    public function delete(int $id)
    {
        try {

            $supportRequest = $this->find($id);
            $supportRequest->deleted = true;
            $supportRequest->save();
            $response = ['id' => $id];
            $statusCode = 200;

        } catch (B2BrokerException $e) {

            $response = $e->getResponse();
            $statusCode = 400;

        } catch (Exception $e) {

            $response = ['code' => $e->getCode(), 'message'=> $e->getMessage()];
            $statusCode = 400;

        }

        return response($response, $statusCode);
    }

    /**
     * @param int $id
     * @return B2BrokerRequest
     * @throws B2BrokerException
     */
    protected function find(int $id)
    {
        $supportRequest = B2BrokerRequest::find($id);
        if (!$supportRequest ||
            $supportRequest->deleted ||
            (new \DateTime())->getTimestamp() - $supportRequest->created_at->getTimestamp() > config('b2broker.ttl')
        ) {
            B2BrokerException::throwNotFoundException($id);
        }
        return $supportRequest;
    }

    protected function makeResponse(B2BrokerRequest $supportRequest)
    {
        return ['request' => $supportRequest];
    }
}
