<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Group::orderby('id', 'desc')->paginate(25);

        return view('dashboard.groups', compact('data'));
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

    public function import(Request $request)
    {
        set_time_limit(0);

        $request->validate([
            'file' => 'required',
        ]);

        if($request->hasFile('file')) {
            $file        = $request->file('file');
            $fileName    = str_replace(' ', '_', $file->getClientOriginalName());

            $file->move(public_path('uploads/') , $fileName);

            $csv_arr = $this->csvToArray(public_path('uploads/' . $fileName));


            $groups_arr = [];

            foreach ($csv_arr as $row){
                $event_id       = $row['event id'];
                $group_name     = $row['name'];
                $group_acts     = $row['activities'];
                $group_topics   = $row['topics'];
                $group_meet     = $row['meet in'];
//                $group_location = $row['location'];
                $table_number   = $row['table number'];
                $restaurant_id  = $row['restaurant id'];

                $group_user     = $row['user'];

                $groups_arr[$group_name]['event_id'] = $event_id;
                $groups_arr[$group_name]['name'] = $group_name;
                $groups_arr[$group_name]['activities'] = $group_acts;
                $groups_arr[$group_name]['topics'] = $group_topics;
                $groups_arr[$group_name]['meet_in'] = $group_meet;
                $groups_arr[$group_name]['table_number'] = $table_number;
                $groups_arr[$group_name]['restaurant_id'] = $restaurant_id;
                $groups_arr[$group_name]['users'][] = trim($group_user);
            };


            foreach ($groups_arr as $group_key => $item)
            {
                Group::create([
                    'event_id'      => $item['event_id'] ?? null,
                    'name'          => $item['name'] ?? null,
                    'users'         => json_encode($item['users']),
                    'activities'    => $item['activities'] ?? null,
                    'topics'        => $item['topics'] ?? null,
                    'meet_in'       => $item['meet_in'] ?? null,
                    'location'      =>  null,
                    'table_number'  => $item['table_number'] ?? null,
                    'restaurant_id' => $item['restaurant_id'] ?? null,
                ]);
            }

            flash('Groups Imported Successfully');

            return back();

        }else {
            flash()->error('Please add a file first');
        }

        return redirect()->back();
    }

    public function csvToArray($file_path)
    {
        $header = null;
        $data = [];
        if (($handle = fopen($file_path, 'r')) !== false)
        {
            while(($row = fgetcsv($handle, 0, ',')) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Group::updateOrcreate([
            'id'=> $request->get('id')
        ],[
            'name'          => $request->get('name'),
            'users'      => $request->get('users'),

        ]);

        flash('Processed Successfully!');

        return back();
    }

    public function export()
    {
        $groups = Group::get(); // Fetch all groups

        $file = fopen('groups.csv', 'w');

        // Write the headers to the CSV file
        fputcsv($file, ['event id', 'name', 'user' , 'activities', 'topics' , 'meet in' , 'location' , 'table number' , 'restaurant id' ]);

        // Process each group and its users
        foreach ($groups as $group) {
            $users = json_decode($group->users, true); // Decode the users array from the group

            // For each user, write a new row in the CSV file with the same group name
            foreach ($users as $user) {
                fputcsv($file, [
                    $group->event_id, // Group name
                    $group->name, // Group name
                    $user, // User email,
                    $group->activities, // Group name
                    $group->topics, // Group name
                    $group->meet_in, // Group name
                    $group->location, // Group name
                    $group->table_number, // Group name
                    $group->restaurant_id, // Group name
                ]);
            }
        }

        // Close the CSV file
        fclose($file);

        // Return the CSV file for download
        return response()->download('groups.csv');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::find($id)->delete();

        flash('Deleted Successfully');

        return back();
    }
}
