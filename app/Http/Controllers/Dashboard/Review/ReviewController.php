<?php

namespace App\Http\Controllers\Dashboard\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Review\StoreReviewRequest;
use App\Http\Requests\Dashboard\Review\UpdateReviewRequest;
use App\Models\Physican;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create','store');
        $this->middleware('permission:update')->only('edit','update');
        $this->middleware('permission:delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::select()->with([
            'user' => function ($q) {
                $q->select('id', 'name');
            }, 'user' => function ($q) {
                $q->select('id', 'name');
            }
        ])->get();
        return view('dashboard.review.index',compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select()->get();
        $doctors = Physican::select()->get();
        return view('dashboard.review.create',compact('doctors','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $data = $request->except('_token');

        $review = Review::create($data);

        if (!$review)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('reviews.index')->with('success','The data has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::where('id',$id)->with([
            'user' => function ($q) {
                $q->select('id', 'name');
            }, 'user' => function ($q) {
                $q->select('id', 'name');
            }
        ])->first();
        $users = User::select()->get();
        $doctors = Physican::select()->get();
        return view('dashboard.review.edit',compact('review','doctors','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, $id)
    {
        $data = $request->except('_token','_method');

        $review = Review::where('id',$id)->update($data);

        if (!$review)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('reviews.index')->with('success','The data has been saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review)
            return redirect()->route('reviews.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Successfully deleted!');
    }
}
