<?php

namespace App\Http\Controllers\Website\Doctor\Exception;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Exception\StoreExceptionRequest;
use App\Models\Exception;

class ExceptionController extends Controller
{
    public function store(StoreExceptionRequest $request)
    {
        $data = $request->except('_token');
        Exception::create($data);
        
        return response()->json([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

    }
}
