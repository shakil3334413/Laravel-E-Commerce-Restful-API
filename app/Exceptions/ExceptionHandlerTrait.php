<?php 
namespace App\Exceptions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
trait ExceptionHandlerTrait{


    public function apiException($request,$e)
    {
        if($this->isModel($e)){
            return response()->json([
                'errors'=>'Content Not Found',
            ],404);
        }
        if($this->isHTTP($e)){
            return response()->json([
                'errors'=>'Route Not Found'
            ],404);
        }

        return parent::render($request, $e);
    }

    public function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }
    public function isHTTP($e)
    {
        return $e instanceof NotFoundHttpException;
    }


}
