<?php

namespace App\Http\Controllers\Website\User\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\User\Review\DestroyReviewRequest;
use App\Http\Requests\Website\User\Review\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        $data = $request->except('_token', 'accept');
        $data['user_id'] = Auth::guard('web')->user()->id;

        $storeReview = Review::create($data);

        if (!$storeReview)
            return redirect()->back()->with('error', 'Something went wrong, please try again.');

        return redirect()->back()->with('success', 'Thanks for reviewing.');
    }
    public function destroy(DestroyReviewRequest $request)
    {
        $review = Review::find($request->id);

        if (!$review)
            return redirect()->back()->with('error', 'Something went wrong, please try again.');

        $deleteReview = $review->delete();

        if (!$deleteReview)
            return redirect()->back()->with('error', 'Something went wrong, please try again.');

        return redirect()->back()->with('success', 'You have successfully deleted your review.');
    }
}
