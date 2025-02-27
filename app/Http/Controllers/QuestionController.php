<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Question::orderby('field_order')->paginate(100);

        return view('dashboard.questions', compact('data'));
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

    public function sort(Request $request)
    {
        $newOrder               = $request->get('newOrder');

        // Update each record's order
        foreach ($newOrder as $id => $order) {
            Question::where('id', $id)->update(['field_order' => $order]); // Replace 'order_column' with your actual order column name
        }

        return response()->json([
            'status'=> 200,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Question::updateOrcreate([
            'id'=> $request->get('id')
        ],[
            'name'          => $request->get('name'),
            'type'          => $request->get('type'),
            'scale_1'       => $request->get('scale_1'),
            'scale_2'       => $request->get('scale_2'),
            'answers_arr'   => json_encode($request->get('answers_arr')),
        ]);

        flash('Processed Successfully!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::find($id)->delete();

        flash('Deleted Successfully');

        return back();
    }
}
