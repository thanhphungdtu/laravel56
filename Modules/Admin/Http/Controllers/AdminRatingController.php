<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

    class AdminRatingController extends Controller
{
    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function index(){
        $ratings = $this->rating->ratingList();
        $viewData = [
            'ratings' => $ratings
        ];
        return view('admin::rating.index',$viewData);
    }

    public function action($action, $id){
        $msgRating = $this->rating->ratingAction($action,$id);
        return redirect()->route('admin.get.list.rating')->with('success',$msgRating);
    }
}
