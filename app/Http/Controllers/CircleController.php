<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use Illuminate\Http\Request;

class CircleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Circle::paginate(25);

        return view('dashboard.circles' , compact('data'));
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
       $circle =  Circle::updateOrCreate([
            'id'=> $request->get('id')
        ],[
            'name'=> $request->get('name'),
            'user_id'=> auth()->user()->id,
            'status'=> $request->get('status'),
            'short_description'=> $request->get('short_description'),
            'long_description'=> $request->get('long_description')
        ]);

        if(request()->hasFile('image')) {
            $img_path = '/uploads/';

            $img = $request->file('image');
            $imgName = str_replace(' ', '_', $img->getClientOriginalName());

            $img->move(public_path() . $img_path , $imgName);

            $circle->image = $img_path . $imgName;
            $circle->save();
        }

        flash('Updated Successfully');

        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function show(Circle $circle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function edit(Circle $circle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Circle $circle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circle  $circle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Circle::find($id)->delete();

        flash('Deleted Successfully');

        return back();
    }
}
