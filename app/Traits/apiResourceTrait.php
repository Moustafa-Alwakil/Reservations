<?php

namespace App\Traits;

trait apiResourceTrait
{

    public function returnSuccessMessage($msg = "", $status = 200)
    {
        return response()->json(
            [
                'status' => true,
                'message' => $msg
            ],
            $status
        );
    }


    public function returnData($key = 'data', $value = [], $status = 200)
    {
        return response()->json(['status' => true, $key => $value], $status);
    }


    public function returnError($msg = 'Error', $status = 400, $validator = null)
    {
        return response()->json([
            'status' => false,
            'message' => $msg,
            'details' => $validator ? $validator : (object)[],
        ], $status);
    }


    public function returnValidationError($validator, $msg = 'Validation Error', $status = 403)
    {
        $jsonError = (object)[];
        foreach ($validator->errors()->toArray() as $k => $vs) {
            foreach ($vs as $val) {
                $jsonError->{$k} = $val;
            }
        }
        return $this->returnError($msg, $status, $jsonError);
    }


    public function returnDataWithToken($guard, object $value, $token, $key = 'data', $status = 200)
    {
        $value->access_token =  $token;
        $value->expire_in = auth($guard)->factory()->getTTL() * 60;
        return response()->json(
            [
                'status' => true,
                $key => $value,
            ],
            $status
        );
    }
}
