<?php

namespace App\Http\Controllers;

use App\Models\Objava;
use Illuminate\Http\Request;

class ObjavaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $objave = Objava::all();
        return view('objava.index', compact('objave'));
    }

    public function public(){
        $publicObjave = Objava::all()->where('type',1);

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
    public function edit(Objava $objava)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objava  $objava
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objava $objava)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objava  $objava
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objava $objava)
    {
        //
    }



}
