<?php

namespace Niomin\B2BrokerTest\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Niomin\B2BrokerTest\Contracts\RepositoryInterface;
use Niomin\B2BrokerTest\Exceptions\B2BrokerException;
use Niomin\B2BrokerTest\Models\B2BrokerRequest;

class B2BrokerController extends Controller
{
    /** @var RepositoryInterface */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response('Hello from B2Broker package');
    }

    public function create(Request $request)
    {
        try {
            $supportRequest = $this->repository->create($request->get('text', ''));

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

            $response = $this->makeResponse($this->repository->find($id));
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

            $supportRequest = $this->repository->update($id, $request->get('text', ''));

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

            $this->repository->delete($id);
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

    protected function makeResponse(B2BrokerRequest $supportRequest)
    {
        return ['request' => $supportRequest];
    }
}
