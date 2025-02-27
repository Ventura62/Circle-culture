<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use App\Models\Group;
use App\Models\Notification;
use App\Models\Resturant;
use App\Models\UpcomingDate;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::get();

        $resturants = Resturant::get();

        $upcoming_dates = UpcomingDate::all();

        $data = Event::orderby('id', 'desc')->paginate(25);

        return view('dashboard.events', compact('data' ,'groups' , 'resturants' , 'upcoming_dates'));
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
//        $request->validate([
//            'name'=>'required',
//            'group_id'=>'required|integer',
//            'restaurant_id'=>'required|integer',
//            'table_number'=>'required',
//        ]);

        Event::updateOrcreate([
            'id'=> $request->get('id')
        ],[
            'name'      => $request->get('name'),
            'time'          => $request->get('time'),
            'is_active'      => $request->get('is_active'),
        ]);

        flash('Processed Successfully!');

        return back();
    }

    public function activate($id)
    {
        Event::find($id)->update([
            'is_active'=> 1
        ]);

        // Send Notification to Group users
        $groups = Group::where('event_id' , $id)->get();

        foreach ($groups as $group){
            $group_users =  json_decode($group->users, true);

            foreach ($group_users as $group_user){

                $group_user = trim($group_user);

                $user = User::where('email', $group_user)->first();

                Notification::create([
                    'user_id'=> $user->id,
                    'message'=> 'You have been assigned to group :' . $group->name
                ]);
            }
        }

        flash('Event Activated Successfully');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Feedback::where('event_id' , $id)->get();

        return view('dashboard.feedbacks', compact('data' , 'id'));
    }


    public function export($id)
    {
        $event = Event::find($id);

        $feedbacks = Feedback::where('event_id', $id)->get(); // Fetch all groups

        $file = fopen('feedbacks.csv', 'w');

        // Write the headers to the CSV file
        fputcsv($file, ['Event Name', 'User', 'Group' , 'Experience Rate', 'Rating' , 'Feedback'  ]);

        // Process each group and its users
        foreach ($feedbacks as $feedback) {
            $jsonstring  = json_decode($feedback->feedback_json, true);

            // For each user, write a new row in the CSV file with the same group name
            fputcsv($file, [
                $event->name ,
                $feedback->user->name ,
                $feedback->user->group()->name  ?? '' ,
                $jsonstring['exp_feedback']['answer'] ?? '',
                $jsonstring['rating']['rating'] ?? '',
                $jsonstring['txt_feedback']['feedback'] ?? '',
            ]);
        }

        // Close the CSV file
        fclose($file);

        // Return the CSV file for download
        return response()->download('feedbacks.csv');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();

        Group::where('event_id',$id)->delete();

        flash('Deleted Successfully');

        return back();
    }
}
