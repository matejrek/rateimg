<?php

namespace App\Http\Controllers;

use App\Models\Objava;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\PublicRating;

class ObjavaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $objave = Objava::withCount('ratingsLike')->withCount('publicRatingsLike')->withCount('ratingsDislike')->withCount('publicRatingsDislike')->get();
        return view('objava.index', compact('objave'));
        //return $objave;
    }

    public function public(){

        $publicObjave = Objava::where('type',1)->withCount('ratingsLike')->withCount('publicRatingsLike')->withCount('ratingsDislike')->withCount('publicRatingsDislike')->get();
 
        return view('objava.public', compact('publicObjave'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('objava.create');
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $requestArr = $request->all();
        $objava = new Objava();
        $objava->user_id = auth()->user()->id;
        $objava->type = $requestArr['tipObjave'];
        $objava->name = $requestArr['name'];

        //save img
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $objava->imgPath = $imageName;

        $objava->save();
        //return $requestArr;

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objava  $objava
     * @return \Illuminate\Http\Response
     */
    public function show(Objava $objava)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objava  $objava
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objava = Objava::findOrFail($id);
        return view('objava.edit', compact('objava'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objava  $objava
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $objava = Objava::where('id', $id)->first();
        if( auth()->user()->id == $objava->user_id){
            $objava->name = $request->name;
            $objava->type = $request->tipObjave;
            $objava->save();
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objava  $objava
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objava $objava, $id)
    {
        $objava = Objava::where('id', $id)->first();
        if( auth()->user()->id == $objava->user_id){
            $objava->delete();
        }
        return redirect('/');
    }

    public function like(Request $request, $id){
        if( auth()->user() ){
            $exists = Rating::all()->where('user_id', auth()->user()->id)->where('objava_id',$id)->first();
            if( $exists != null ){
                $exists->delete();
            } 

            $rating = new Rating();
            $rating->user_id = auth()->user()->id;
            $rating->objava_id = $id;
            $rating->type=1;
            $rating->save();

            
        }
        else{
            $exists = PublicRating::all()->where('user_ip', $request->ip())->where('objava_id',$id)->first();
            if( $exists != null  ){
                $exists->delete();
            } 

            $publicRating = new PublicRating();
            $publicRating->user_ip = $request->ip();
            $publicRating->objava_id = $id;
            $publicRating->type=1;
            $publicRating->save();
        }
        return redirect('/');
    }

    public function dislike(Request $request, $id){
        if( auth()->user() ){
            $exists = Rating::all()->where('user_id', auth()->user()->id)->where('objava_id',$id)->first();
            if( $exists != null  ){
                $exists->delete();
            } 

            $rating = new Rating();
            $rating->user_id = auth()->user()->id;
            $rating->objava_id = $id;
            $rating->type=0;
            $rating->save();
        }
        else{
            $exists = PublicRating::all()->where('user_ip', $request->ip())->where('objava_id',$id)->first();
            if( $exists != null  ){
                $exists->delete();
            } 

            $publicRating = new PublicRating();
            $publicRating->user_ip = $request->ip();
            $publicRating->objava_id = $id;
            $publicRating->type=0;
            $publicRating->save();

        }
        return redirect('/');
    }

}
