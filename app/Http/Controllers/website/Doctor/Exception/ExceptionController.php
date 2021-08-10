<?php

namespace App\Http\Controllers\Website\Doctor\Exception;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Exception\DestroyExceptionRequest;
use App\Http\Requests\Website\Doctor\Exception\StoreExceptionRequest;
use App\Models\Exception;

class ExceptionController extends Controller
{
    public function store(StoreExceptionRequest $request)
    {
        $data = $request->except('_token','b');
        $storeException = Exception::create($data);

        if (!$storeException) {
            return response()->json([
                'status' => false,
            ]);
        }

        return response()->json([
            'status' => true,
            'b'=>$request->b,
            'clinic_id'=>$request->clinic_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    }

    public function destroy(DestroyExceptionRequest $request)
    {
        $exception = Exception::select()->where(['date'=>$request->date , 'start_time'=>$request->start_time ,'clinic_id'=>$request->clinic_id]);

        if (!$exception) {
            return response()->json([
                'status' => false,
            ]);
        }
        $deleteException = $exception->delete();

        if(!$deleteException) {
            return response()->json([
                'status' => false,
            ]);
        }

        return response()->json([
            'status' => true,
            'b'=>$request->b,
            'clinic_id'=>$request->clinic_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    }
}
