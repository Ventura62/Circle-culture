<?php

namespace App\Http\Controllers;

use App\Models\UpcomingDate;
use Illuminate\Http\Request;

class UpcomingDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UpcomingDate::all();

        return view('dashboard.upcoming_dates', compact('data'));
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
        UpcomingDate::updateOrCreate(
            [
                'id'=>$request->get('id')
            ],[
            'date'=> $request->get('date')
        ]);


        flash('Updated Successfully!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UpcomingDate  $upcomingDate
     * @return \Illuminate\Http\Response
     */
    public function show(UpcomingDate $upcomingDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UpcomingDate  $upcomingDate
     * @return \Illuminate\Http\Response
     */
    public function edit(UpcomingDate $upcomingDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UpcomingDate  $upcomingDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UpcomingDate $upcomingDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UpcomingDate  $upcomingDate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UpcomingDate::find($id)->delete();

        flash('Deleted Successfully');

        return back();
    }
}
