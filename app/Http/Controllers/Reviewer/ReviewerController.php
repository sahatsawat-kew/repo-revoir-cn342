<?php

namespace App\Http\Controllers\Reviewer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Review;


class ReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = Review::all();
        $restaurant = Restaurant::all();
        
        $data =[$restaurant,$review];
        return view('Reviewer.reviewerHome',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'detail' => '',
            'rating' => '',
            'user_id' => '',
            'resturant_id' => '',
            
        ]);
        
        $review = new Review;
        $review->detail = $request->detail;
        $review->rating = $request->rating;
        $review->Restaurant_restaurant_id  = $request->resturant_id;
        $review->User_user_id = auth()->user()->id;

        $review->save();


        return redirect()->route('reviewer.page.show',[$request->resturant_id]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurantView = Restaurant::find($id);
        $reviewThisRestaraurant = Review::all()->where('Restaurant_restaurant_id', $id);
        $rating = 0;
        $count = count($reviewThisRestaraurant);

        foreach ($reviewThisRestaraurant as $key => $value) {
            $rating += $reviewThisRestaraurant[$key]->rating;
        };

        if(count($reviewThisRestaraurant) <= 0){
            $totalRating = 0;
        }else{
            $totalRating = number_format(($rating / count($reviewThisRestaraurant)), 1, '.', '');
        };
        
        
        $data = [$restaurantView,$reviewThisRestaraurant,$totalRating,$count];

        return view('Reviewer.showRestaurant', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteComment = Review::find($id);
        $deleteComment->delete();
        return redirect();
    }
}
