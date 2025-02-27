<?php

namespace App\Http\Controllers;


use App\Events\MessageSent;
use App\Models\ContactReport;
use App\Models\Event;
use App\Models\EventUpdate;
use App\Models\Feedback;
use App\Models\Group;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Question;
use App\Models\Submission;
use App\Models\UpcomingDate;
use App\Models\User;
use App\Models\UserVote;
use Carbon\Carbon;

use Google\Service\Exception;
use Google_Client;
use Google_Service_PeopleService;
use GuzzleHttp\Exception\GuzzleException;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * TODO : split this controller into services
     */

    public function test()
    {

//        auth()->user()->stripe_id = null;
//        auth()->user()->save();
//
//
//        $client = Http::withHeaders([
//            'Content-Type' => 'application/json',
//        ]);
//
//        $data = [];
//
//        $response = $client->post('https://tab4six.com/api/subscription/stripe_hook', $data);
//
//        if ($response->successful()) {
//            echo "Request successful! Status code: " . $response->getStatusCode() . "\n";
//            echo "Response body: " . $response->body() . "\n";
//        } else {
//            echo "Request failed! Status code: " . $response->getStatusCode() . "\n";
//            echo "Error message: " . $response->json('message') . "\n"; // Assuming error message in JSON
//        }

//        dd(Carbon::now()->toDateTimeString());
//        auth()->user()->submission->booking_date = "2026-01-02 14:01:00";
//        auth()->user()->submission->is_confirmed = 1;
//        auth()->user()->submission->save();

//        dd(Question::all()->toArray());
//
//        $message = Message::create([
//            'receiver_id'    => 1,
//            'sender_id'     => auth()->user()->id,
//            'message'       => 'wow',
//        ]);
//
//        broadcast(new MessageSent($message))->toOthers();

//        Session::forget('next_step');
//        Session::forget('answers');
//
//        $answers = Session::get('answers');


//        dd($answers);

        set_time_limit(0);
    }

    public function save_answers(Request $request)
    {
        Session::forget('answers');

        Session::forget('next_step');

        // Retrieve existing answers from session
        $old_answers = $request->get('old_answers');

        // Convert old answers to an array
        $existingArray = $old_answers ? json_decode($old_answers, true) : [];

        // Get new answers from the request
        $newArray = json_decode($request->get('answers_json'), true);

        // Merge the existing and new answers
        $mergedAnswers = array_merge($existingArray, $newArray);

        // Save merged answers back to the session
        Session::put('answers', $mergedAnswers);

        // Save the next step to the session
        Session::put('next_step', $request->input('next_step'));

        if(isset(auth()->user()->id)){
            $answers = Session::get('answers');

            if($answers) {
                Submission::updateOrCreate(
                    [
                        'user_id'        => auth()->user()->id,
                    ],[
                    'answers_arr'   => json_encode($answers)
                ]);

                Session::forget('answers');
                Session::forget('next_step');

                auth()->user()->has_submitted = 1;
                auth()->user()->save();
            }

        }

        // Return a response to redirect to login/signup
        return response()->json(['redirect_to' => route('register')], 200);
    }

    public function store_feedback(Request $request)
    {
        $json_data = $request->get('feedback_json');
        $feedbackData = json_decode($json_data, true); // Feedback JSON from the form

        Feedback::create([
            'user_id'=> auth()->user()->id,
            'group_id'=> auth()->user()->group()->id,
            'event_id'=> $request->get('event_id'),
            'feedback_json'=> $json_data
        ]);

        foreach ($feedbackData['voting'] as $vote) {
            if ($vote['vote'] === 'yes') {
                // Save the user vote into the user_votes table
                UserVote::updateOrCreate(
                    [
                        'user_id' => auth()->user()->id,
                        'voted_user_id' => User::where('email', $vote['email'])->first()->id,
                    ],
                    ['vote' => 'yes']
                );

                // if someone voted for logged in user
                if ($vote['email'] === auth()->user()->email) {
                    UserVote::updateOrCreate(
                        [
                            'user_id' => User::where('email', $vote['email'])->first()->id,
                            'voted_user_id' => auth()->user()->id,
                        ],
                        ['vote' => 'yes']
                    );
                }
            }
        }


        //reset submission for new booking
        auth()->user()->submission->is_confirmed = 0;
        auth()->user()->submission->save();

        return response()->json(['redirect_to' => route('chat')], 200);
    }

    public function feedback()
    {
        $eventId = $_GET['event_id'];

        $event = Event::find($eventId);

        if(isset($event)){
            $user_group = auth()->user()->group();

            if(isset($user_group) && $user_group->event_id == $event->id){

                $members = $user_group->users();

                return view('web.feedback', compact('eventId' , 'members'));
            }
        }


        return redirect()->route('group');

    }

    public function start()
    {
        if(isset(auth()->user()->submission)){
            return redirect()->route('group');
        }else {
            $questions = Question::orderby('field_order')->get();

            $next_step = Session::get('next_step');

            $old_answers = Session::get('answers');

            // Ensure old_answers is properly formatted as JSON
            $old_answers = $old_answers ? json_encode($old_answers) : '{}';

            return view('web.start' , compact('questions', 'next_step' , 'old_answers'));
        }
    }

    public function about()
    {
        return view('web.about');
    }

    public function group()
    {
        if(isset(auth()->user()->submission)){
            $upcoming_dates = UpcomingDate::all();

            return view('web.group', compact('upcoming_dates'));
        }else {
            return redirect()->route('start');
        }
    }

    public function change_date()
    {
        $upcoming_dates = UpcomingDate::all();

        return view('web.change_date', compact('upcoming_dates'));
    }

    public function store_booking_date(Request $request)
    {
        $date = $request->get('date');

        auth()->user()->submission->booking_date = $date;
        auth()->user()->submission->save();

        flash('Booking Date Changed Successfully!');

        return redirect()->route('group');
    }

    public function update_event($event_id , $status)
    {
        $group =  auth()->user()->group();

        $group_users =  json_decode($group->users, true);

        EventUpdate::updateOrCreate([
            'event_id'=> $event_id,
            'user_id'=> auth()->user()->id,
        ], [
            'status'=> $status
        ]);

        $notification_msg = '';

        if($status == 'confirmed'){
            $notification_msg = auth()->user()->name  . ' Confirmed to attend the dinner';

        }elseif ($status == 'late'){
            $notification_msg = auth()->user()->name  . ' Will be late';

        }elseif ($status == 'noshow'){
            $notification_msg = auth()->user()->name  . ' Can not make it this time';
        }

        // Send Notification to other Group users
        foreach ($group_users as $group_user){
            if(auth()->user()->email != $group_user){
                $user = User::where('email', $group_user)->first();

                Notification::create([
                    'user_id'=> $user->id,
                    'message'=> $notification_msg
                ]);
            }
        }

        return bacK();
    }

    public function cancel_event(Request $request)
    {
        $user       = auth()->user();

        $event_id = $request->get('event_id');

        $reason   = $request->get('reason');

        $group =  auth()->user()->group();

        EventUpdate::updateOrCreate([
            'event_id'=> $event_id,
            'user_id'=> auth()->user()->id,
        ], [
            'status'=> 'canceled',
            'note'=> $reason
        ]);



        return bacK();
    }

    public function remove_contact($id)
    {
        Message::where('sender_id' , auth()->user()->id )->where('receiver_id' , $id)->delete();

        Message::where('receiver_id' , auth()->user()->id )->where('sender_id' , $id)->delete();

        UserVote::where('user_id' , auth()->user()->id)->where('voted_user_id' , $id)->delete();

        UserVote::where('voted_user_id' , auth()->user()->id)->where('user_id' , $id)->delete();

        return back();
    }

    public function report_contact(Request $request)
    {
       $message     = $request->get('message');
       $contact_id  = $request->get('contact_id');

       ContactReport::create([
           'user_id'=> auth()->user()->id,
           'contact_id'=> $contact_id,
           'message'=> $message
       ]);

       flash('Report Submitted');

       return back();
    }

    public function chat()
    {
        $userId = auth()->id();

        $contacts = $this->getContacts();

        if(isset($_GET['user_id'])){

            $receiver_id = $_GET['user_id'];

            $user = User::find($receiver_id);

            $messages = DB::table('messages')
                ->where(function ($query) use ($userId, $receiver_id) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id', $receiver_id);
                })
                ->orWhere(function ($query) use ($userId, $receiver_id) {
                    $query->where('sender_id', $receiver_id)
                        ->where('receiver_id', $userId);
                })
                ->orderBy('created_at', 'asc') // Order messages by time (oldest to newest)
                ->get();


            // update read status for received messages with this user
            DB::table('messages')
                ->where(function ($query) use ($userId, $receiver_id) {
                    $query->where('receiver_id', $userId)
                        ->where('sender_id', $receiver_id);
                })->update(['is_read' => 1]);


            return view('web.chat' , compact('contacts' , 'receiver_id' ,'user' , 'messages'));
        }else {

            return view('web.contacts' , compact('contacts'));
        }
    }

    public function getContacts()
    {
        $userId = auth()->id();

        $contacts = [];

        // Get the contacts and prioritize those with recent messages
        $contacts_arr = DB::table('messages')
            ->select('users.id', 'users.name', 'users.email', 'users.profile_pic', 'messages.created_at', 'messages.message')
            ->join('users', function ($join) use ($userId) {
                $join->on('users.id', '=', DB::raw("CASE
                WHEN messages.sender_id = {$userId} THEN messages.receiver_id
                WHEN messages.receiver_id = {$userId} THEN messages.sender_id
            END"));
            })
            ->where(function ($query) use ($userId) {
                $query->where('messages.sender_id', $userId)
                    ->orWhere('messages.receiver_id', $userId);
            })
            ->distinct()
            ->orderByDesc('messages.created_at')  // Order by most recent message
            ->get();

        foreach ($contacts_arr as $key => $item) {
            $contacts[$item->email] = [
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'profile_pic' => $item->profile_pic,
                'last_message' => $contacts_arr[0]->message ,  // Store last message time
                'last_message_time' => $item->created_at, // Store last message time
                'unread_count' => 0, // Initialize unread message count
            ];
        }

        // Get the unread messages count for each contact
        $unreadCounts = DB::table('messages')
            ->select('sender_id', 'receiver_id', DB::raw('count(*) as unread_count'))
            ->where('is_read', 0)  // Only unread messages
            ->where(function ($query) use ($userId) {
                $query->where('receiver_id', $userId);
            })
            ->groupBy('sender_id', 'receiver_id')
            ->get();

        // Update unread message count for each contact
        foreach ($unreadCounts as $unread) {
            $contactKey = $unread->sender_id == $userId ? 'receiver_id' : 'sender_id';
            $contactEmail = User::find($unread->$contactKey)->email;
            if (isset($contacts[$contactEmail])) {
                $contacts[$contactEmail]['unread_count'] = $unread->unread_count;
            }
        }

        $matches = UserVote::query()
            ->select('uv2.user_id as matched_user_id') // Select the matched user's ID
            ->from('user_votes as uv1') // Alias the first table as uv1 (for "I voted")
            ->join('user_votes as uv2', function ($join) use ($userId) {
                $join->on('uv1.voted_user_id', '=', 'uv2.user_id') // My vote's target = Their vote's source
                ->where('uv2.voted_user_id', '=', $userId); // Their vote's target = Me
            })
            ->where('uv1.user_id', '=', $userId) // My vote's source = Me
            ->get()
            ->pluck('matched_user_id') // Get an array of matched user IDs
            ->toArray();

        $matchedUsers = User::whereIn('id', $matches)->get();

        // Add matched users to the contacts array with their details
        foreach ($matchedUsers as $user) {
            if (!isset($contacts[$user->email])) {
                $contacts[$user->email] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_pic' => $user->profile_pic,
                    'last_message_time' => null,  // If there's no message yet
                    'unread_count' => 0, // No unread messages initially
                ];
            }
        }

        // Sort contacts by the most recent message first (if any)
        uasort($contacts, function ($a, $b) {
            // Prioritize users with messages
            $lastMessageA = $a['last_message_time'] ?? '1970-01-01 00:00:00';
            $lastMessageB = $b['last_message_time'] ?? '1970-01-01 00:00:00';

            if ($a['unread_count'] !== $b['unread_count']) {
                return $b['unread_count'] - $a['unread_count'];  // Prioritize unread messages
            }
            return strtotime($b['last_message_time']) - strtotime($a['last_message_time']);  // Sort by most recent message
        });

        return $contacts;

    }

    public function profile()
    {
        return view('web.profile');
    }

    public function notifications()
    {
        Notification::where('user_id', auth()->user()->id)->update([
            'is_read'=> 1
        ]);

        $data = Notification::where('user_id', auth()->user()->id)->orderby('id', 'desc')->get()->take(25);

        return view('web.notifications', compact('data'));
    }

    public function store_profile(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        // Validate email if present
        if ($request->has('email')) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id];
        }

        // Validate password if present
        if ($request->has('password')) {
            $rules['password'] = 'required_with:password_confirmation|confirmed';
            $rules['password_confirmation'] = 'required_with:password';
        }

        $request->validate($rules);


        // Update user details
        $user = User::find(auth()->user()->id);
        if (!$user) {
            flash()->error('User not found');
            return redirect()->back();
        }

        if(request()->hasFile('image')) {
            $img_path = '/uploads/';

            $img = $request->file('image');
            $imgName = str_replace(' ', '_', $img->getClientOriginalName());

            $img->move(public_path() . $img_path , $imgName);

            $user->profile_pic = $img_path . $imgName;
        }


        $user->name = $request->get('name');

        if ($request->has('enable_notifications')) {
            $user->enable_notifications = 1;
        }else {
            $user->enable_notifications = 0;

        }

        if ($request->has('email')) {
            $user->email = $request->get('email');
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        flash()->message('Data Updated Successfully');

        return redirect()->back();
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function dashboard()
    {
        if(auth()->user()->type == "admin"){
            return view('dashboard.index');
        }

        return redirect()->route('group');

    }

    public function google_auth()
    {
        $client = new Google_Client();
        try {
            $client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS_CLIENT'));

            $client->addScope(Google_Service_PeopleService::USERINFO_PROFILE);
            $client->addScope(Google_Service_PeopleService::USERINFO_EMAIL);

            $client->setAccessType("offline");
            $client->setPrompt("consent");

            $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

            $auth_url = $client->createAuthUrl();
            return redirect()->away($auth_url);
        } catch (\Exception $e) {
            return $e->getMessage();
        }


    }

    public function callback(Request $request)
    {
        $client = new Google_Client();
        try {
            $client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS_CLIENT'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->setAccessType("offline");

        $code  = $request->query('code');
        $token = $client->fetchAccessTokenWithAuthCode($code);

        $people_service = new Google_Service_PeopleService($client);
        try {
            $profile = $people_service->people->get('people/me', [
                'personFields' => 'names,emailAddresses',
            ]);


            $old_user = User::where('email' , strtolower($profile->getEmailAddresses()[0]->getValue()))->first();

            $user = User::updateOrCreate([
                'email' => strtolower($profile->getEmailAddresses()[0]->getValue()),
            ], [
                'name'     => $profile->getNames()[0]->getDisplayName(),
                'password' => 'google_password',
                'type'     => 'client',
            ]);

//            if(!isset($old_user)){
//                Mail::send('emails.mail', array(
//                    'title' => "hi",
//                    'body' => "$user->email just registered on tab4six",
//                ), function($message) use($user)  {
//                    $message->to("info@tab4six.com", 'User Registered!')->subject($user->email  . " just registered on tab4six");
//                });
//            }

            $user = User::find($user->id)->makeHidden(['password', 'remember_token' ,'email_verified_at', 'updated_at' , 'type' , 'stripe_id' , 'pm_type' , 'pm_last_four' , 'trial_ends_at' , 'deleted_at']);

            return response($user, 200);

//            Auth::login($user);

//            $answers = Session::get('answers');
//
//            if($answers) {
//                Submission::updateOrCreate(
//                    [
//                        'user_id'        => auth()->user()->id,
//                    ],[
//                    'answers_arr'   => json_encode($answers)
//                ]);
//
//                Session::forget('answers');
//
//                $user->has_submitted = 1;
//                $user->save();
//            }

//            return redirect()->route('group');

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public function delete_account()
    {
        $user = auth()->user();

        Notification::where('user_id' , $user->id)->delete();
        Feedback::where('user_id' , $user->id)->delete();
        UserVote::where('user_id' , $user->id)->delete();
        UserVote::where('voted_user_id' , $user->id)->delete();
        Submission::where('user_id' , $user->id)->delete();
        Message::where('sender_id' , $user->id)->delete();
        Message::where('receiver_id' , $user->id)->delete();

        $user->delete();

        return back();
    }
}