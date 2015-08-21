<?php


namespace App\Http\Controllers;

class ApiController extends Controller {

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode('404')->respondWithError($message);
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected  function respond($data, $headers = [])
    {
        return Response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected  function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'code' => $this->getStatusCode()
            ]
        ]);
    }


    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = 'Unauthorized Request')
    {
        return $this->setStatusCode('401')->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden Access: Request Denied')
    {
        return $this->setStatusCode('403')->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnprocessed($message = 'Request was unable to be processed')
    {
        return $this->setStatusCode('422')->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondInternalError($message = 'Not Found')
    {
        return $this->setStatusCode('500')->respondWithError($message);
    }

    /**
     * @param string $message
     * @param array $metadata
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($message = "Data Processed Successfully", $metadata = array())
    {
        return $this->setStatusCode(201)->respond([
             'message' => $message,
             'metadata' => $metadata
            ]);
    }

} 