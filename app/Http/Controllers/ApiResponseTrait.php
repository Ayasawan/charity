<?php


namespace App\Http\Controllers;


//use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\Types\Mixed_;


trait ApiResponseTrait
{
    public function  apiResponse($data= null ,$message=null ,$status= null)
    {
        $array=[
            'data'=> $data,
            'message' =>$message,
            'status' => $status,
        ];
        return response($array,$status);
    }
    public function saveImage($photo,$folder){
        $file_extension =$photo->getClientOriginalExtension();
        $file_name =time().'.'.$file_extension;
        $path = $folder;
        $photo->move($path,$file_name);
        return $file_name;

    }

    public function successResponse(string $data ,$message, int $statusCode = Response::HTTP_OK):JsonResponse
    {

        if(!$message){
            $message = Response::$statusTexts[$statusCode];
        }

        return response()->json
        ([
            'status_code' => $statusCode,
            'message' =>  $message,
            'data' => $data
        ]);
    }


    public function errorResponse($message = '', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR):JsonResponse
    {

        if(!$message){
            $message = Response::$statusTexts[$statusCode];
        }

        return response()->json
        ([
            'status_code' => $statusCode,
            'message' => ['errors' => $message],
            'data' => null
        ]);
    }




    public function forbiddenResponse(string $message = ''):JsonResponse
    {

     return $this->errorResponse($message, Response::HTTP_FORBIDDEN);
    }


    public function okResponse(string $data,$message = ''):JsonResponse
    {
        return $this->successResponse($data, $message);
    }


    public function createdResponse( $data ,$message = ''):JsonResponse
    {
        return $this->successResponse($data, $message,Response::HTTP_CREATED);
    }



    public function nocontentResponse( string $message = ''):JsonResponse
    {
        return $this->successResponse([], $message,Response::HTTP_NO_CONTENT);
    }


    public function notFoundResponse( string $message = ''):JsonResponse
    {
        return $this->successResponse([], $message,Response::HTTP_NOT_FOUND);
    }


    public function conflictResponse($data,  $message = ''):JsonResponse
    {
        return $this->successResponse($data, $message,Response::HTTP_CONFLICT);
    }

    public function unprocessableResponse($data,  $message = ''):JsonResponse
    {
        return $this->successResponse($data, $message,Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
