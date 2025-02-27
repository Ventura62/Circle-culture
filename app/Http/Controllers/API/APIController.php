<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CircleCommentResource;
use App\Http\Resources\CircleResource;
use App\Http\Resources\QuestionResource;
use App\Models\ContactReport;
use App\Models\EventUpdate;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Submission;
use App\Models\UpcomingDate;
use App\Models\User;
use App\Models\UserVote;
use App\Repository\CircleCommentRepository;
use App\Repository\CircleRepository;
use App\Repository\NotificationRepository;
use App\Repository\QuestionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    protected $questionRepository;

    protected $notificationRepository;

    protected $circleRepository;

    protected $circleCommentRepository;

    public function __construct(QuestionRepository $questionRepository ,
                                NotificationRepository $notificationRepository ,
                                CircleRepository $circleRepository,
                                CircleCommentRepository $circleCommentRepository)
    {
        $this->questionRepository = $questionRepository;

        $this->notificationRepository = $notificationRepository;

        $this->circleRepository = $circleRepository;

        $this->circleCommentRepository = $circleCommentRepository;
    }

    public function getCircles(Request $request)
    {
        $perPage     = $request->input('limit', 25); // You can set a default value or use a configurable value.

        $data      = $this->circleRepository->paginate($perPage);

        $resource    = CircleResource::collection($data);

        return response()->json([
            'data'      => $resource,
            'total'     => $data->total(),
            'next'      => $data->nextPageUrl(),
            'prev'      => $data->previousPageUrl()
        ], 200);
    }

    public function getCircle($circle_id)
    {
        $data = $this->circleRepository->find($circle_id);

        if (!$data) {
            return response()->json(['error' => 'Circle not found'], 404);
        }

        $resource = new CircleResource($data);

        return response()->json([
            'data' => $resource,
        ], 200);
    }

    public function getCircleComments($circle_id)
    {
        $data = $this->circleCommentRepository->paginate($circle_id);

        $resource   = CircleCommentResource::collection($data);

        return response()->json([
            'data'      => $resource,
            'total'     => $data->total(),
            'next'      => $data->nextPageUrl(),
            'prev'      => $data->previousPageUrl()
        ], 200);
    }

    public function getProfile($id)
    {
        $user = User::find($id)->makeHidden(['password', 'remember_token' ,'email_verified_at', 'updated_at' , 'type' , 'stripe_id' , 'pm_type' , 'pm_last_four' , 'trial_ends_at' , 'deleted_at']);

        if($user){
            return response()->json($user , 200);
        }

        return response()->json(['message'=> 'User not found'] , 404);
    }

    public function storeProfile(Request $request)
    {
        // Define validation rules
        $rules = [
            'id' => ['required', 'exists:users,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
            'password' => ['nullable', 'confirmed'],
            'profile_pic' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ];

        // Validate input
        $request->validate($rules);

        // Find user
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $img_path = '/uploads/';
            $img = $request->file('profile_pic');
            $imgName = uniqid() . '_' . str_replace(' ', '_', $img->getClientOriginalName());
            $img->move(public_path($img_path), $imgName);
            $user->profile_pic = $img_path . $imgName;
        }

        // Dynamically update all fields
        $updatableFields = [
            'name', 'phone', 'location', 'gender', 'birthdate', 'social_1', 'social_2',
            'question_1', 'question_2', 'question_3', 'email', 'password', 'enable_notifications'
        ];

        foreach ($updatableFields as $field) {
            if ($request->has($field)) {
                if ($field === 'password') {
                    $user->password = Hash::make($request->password);
                } elseif ($field === 'enable_notifications') {
                    $user->enable_notifications = (bool) $request->enable_notifications;
                } else {
                    $user->$field = $request->$field;
                }
            }
        }

        // Save updated user
        $user->save();

        // Return sanitized user data
        return response()->json(
            $user->makeHidden([
                'password', 'remember_token', 'email_verified_at', 'updated_at',
                'type', 'stripe_id', 'pm_type', 'pm_last_four', 'trial_ends_at', 'deleted_at'
            ]),
            200
        );
    }





    /**Old Functions */
    public function getQuestions(Request $request)
    {
        $perPage     = $request->input('limit', 25); // You can set a default value or use a configurable value.

        $data      = $this->questionRepository->paginate($perPage);

        $resource    = QuestionResource::collection($data);

        return response()->json([
            'data'      => $resource,
            'total'     => $data->total(),
            'next'      => $data->nextPageUrl(),
            'prev'      => $data->previousPageUrl()
        ], 200);
    }

    public function getNotifications(Request $request)
    {
        $perPage     = $request->input('limit', 25);

        $months      = $this->notificationRepository->paginate($perPage);

        $resource    = NotificationRepository::collection($months);

        return response()->json([
            'data'      => $resource,
            'total'     => $months->total(),
            'next'      => $months->nextPageUrl(),
            'prev'      => $months->previousPageUrl()
        ], 200);
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


        return response()->json($contacts , 200);
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

        return response()->json(['message' => "saved successfully!"], 200);
    }

    public function getGroup()
    {
        if(isset(auth()->user()->submission)){
            $upcoming_dates = UpcomingDate::all();

            return response()->json([
                'data'=> $upcoming_dates->toArray()
            ] , 200);
        }else {
            return response()->json([
                'message'=> 'User has no submissions yet'
            ] , 400);
        }
    }

    public function getUpcomingDates()
    {
        $upcoming_dates = UpcomingDate::all();

        return response()->json([
            'data'=> $upcoming_dates->toArray()
        ] , 200);
    }

    public function getMessages(Request $request)
    {
        $userId = auth()->user()->id;

        $receiver_id  = $request->get('user_id');

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

        return response()->json(['data' => $messages->toArray()]);
    }

    public function readMessages(Request $request)
    {
        $userId = auth()->user()->id;

        $receiver_id  = $request->get('user_id');

        DB::table('messages')
            ->where(function ($query) use ($userId, $receiver_id) {
                $query->where('receiver_id', $userId)
                    ->where('sender_id', $receiver_id);
            })->update(['is_read' => 1]);


        return response()->json(['message'=> "Updated Successfully"] ,200);
    }

    public function remove_contact(Request $request)
    {
        $contact_id = $request->get('id');

        $request->validate([
            'id'         => 'required|integer',
        ]);

        Message::where('sender_id' , auth()->user()->id )->where('receiver_id' , $contact_id)->delete();

        Message::where('receiver_id' , auth()->user()->id )->where('sender_id' , $contact_id)->delete();

        UserVote::where('user_id' , auth()->user()->id)->where('voted_user_id' , $contact_id)->delete();

        UserVote::where('voted_user_id' , auth()->user()->id)->where('user_id' , $contact_id)->delete();

        return response()->json(['message'=> "contact removed successfully for user #" . auth()->user()->id] , 200);
    }

    public function report_contact(Request $request)
    {
        $request->validate([
            'id'         => 'required|integer',
            'message'         => 'required|string',
        ]);

        $message     = $request->get('message');
        $contact_id  = $request->get('contact_id');

        ContactReport::create([
            'user_id'=> auth()->user()->id,
            'contact_id'=> $contact_id,
            'message'=> $message
        ]);

        return response()->json(['message'=> "contact reported successfully by user #" . auth()->user()->id] , 200);
    }

    public function update_event(Request $request)
    {
        $request->validate([
            'event_id'         => 'required|integer',
            'status'         => 'required|string',
        ]);

        $event_id  = $request->get('event_id');
        $status = $request->get('status');

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

        return response()->json(['message'=> "event status updated successfully to " . $status] , 200);
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

        return response()->json(['message'=> "Account Deleted Successfully "] , 200);
    }

    public function store_booking_date(Request $request)
    {
        $date = $request->get('date');

        auth()->user()->submission->booking_date = $date;
        auth()->user()->submission->save();

        return response()->json(['message'=>'Booking Date Changed Successfully!'] , 200);
    }

    public function reset()
    {
        Submission::where('user_id' ,auth()->user()->id)->delete();

        flash('Submission reset successfully');

        return response()->json(['message'=>'Submission reset successfully']  , 200);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id'         => 'required|integer',
            'sender_id'         => 'required|integer',
            'message'         => 'required|string',
        ]);

        $message = Message::create([
            'receiver_id' => $request->receiver_id,
            'sender_id' => auth()->user()->id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!'] , 200) ;
    }
}
