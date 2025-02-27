<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use ZipArchive;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Submission::orderby('id' ,'desc')->paginate(25);

        return view('dashboard.submissions', compact('data'));
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


    public function reset()
    {

        Submission::where('user_id' ,auth()->user()->id)->delete();

        flash('Submission reset successfully');

        return redirect()->route('start');

    }


    public function export()
    {
        $questions = Question::get(); // Fetch all questions
        $submissions = Submission::get(); // Fetch all submissions

        $file = fopen('submissions.csv', 'w');

        $headers = [
            'Name', 'Email', 'Booking Date'
        ];
        foreach ($questions as $question) {
            $headers[] = $question['name'];
        }

        // Write headers to the CSV file
        fputcsv($file, $headers);

        // Process each submission
        foreach ($submissions as $row) {
            $answers = json_decode($row->answers_arr, true); // Decode the answers array from the submission

            $booking_date  = isset($row->booking_date) ?  \Carbon\Carbon::parse($row->booking_date)->format('F jS, Y h:i A') : null;

            $rowData = [
                $row->user->name ?? '',
                $row->user->email ?? '',
                $booking_date,
            ];

            // Map each question to its corresponding answer
            foreach ($questions as $question) {
                $questionId = $question['id'];
                $answerString = ''; // Default value if no answer is provided

                foreach ($answers as $answer) {
                    if (isset($answer[$questionId])) {
                        $answer_val = $answer[$questionId]['answer'];
                        if(is_array($answer_val)){
                            $answerString = '';
                            foreach ($answer_val as $item){
                                $answerString .= $item . ", ";
                            }
                        }else{
                            $answerString = $answer[$questionId]['answer'];
                        }
                        break; // Exit loop once the answer is found
                    }
                }

                $rowData[] = $answerString; // Add answer to the row data
            }

            // Write row data to the CSV file
            fputcsv($file, $rowData);
        }

        // Close the CSV file
        fclose($file);

        return response()->download('submissions.csv');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create the submission
         Submission::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'city' => $request->get('city'),
            'social_media' => $request->get('social_media'),
        ]);


        // Flash message
        flash('Your request has been submitted successfully')->success();

        return redirect()->to('/success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Submission::find($id)->delete();

        flash('Deleted Successfully');

        return redirect()->back();
    }
}
