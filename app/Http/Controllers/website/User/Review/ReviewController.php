<?php

namespace App\Http\Controllers\Website\User\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\User\Review\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        $data = $request->except('_token','accept');
        $data['user_id'] = Auth::guard('web')->user()->id;

        $storeReview = Review::create($data);

        if(!$storeReview)
            return redirect()->back()->with('error', 'Something went wrong, please try again.');

            return redirect()->back()->with('success', 'Thanks for reviewing.');
    }
}
