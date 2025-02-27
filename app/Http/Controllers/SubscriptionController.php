<?php

namespace App\Http\Controllers;

use App\Models\PaymentCharge;
use App\Models\Submission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Plan;
use Stripe\Stripe;

class SubscriptionController extends Controller
{

     ////test mode
//
    protected  $ticket_price_stripe = "price_1QdetsG20D0f90BGBcBygF9V";
    protected $payment_plans = [
       '1'=> 'price_1QaOWiG20D0f90BGoKEzqQYw',
       '3'=> 'price_1QaOXZG20D0f90BGUeSWaLpQ',
       '6'=> 'price_1QaOYCG20D0f90BGMSX4fPdR',
   ];


// live mode

//    protected  $ticket_price_stripe = "price_1Qdf49G20D0f90BGFNmZeFxr";
//
//    protected $payment_plans = [
//       '1'=> 'price_1QcI90G20D0f90BGgUt8mVbK',
//       '3'=> 'price_1QcI8xG20D0f90BGZeC1ycMR',
//       '6'=> 'price_1QcI8uG20D0f90BGcYg9NM07',
//   ];
//


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws ApiErrorException
     */
    public function index()
    {
        //https://dashboard.stripe.com/test/settings/billing/portal

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $portalSession = \Stripe\BillingPortal\Session::create([
            'customer' => auth()->user()->stripe_id,
            'return_url' => route('group'), // Redirect back to your app
        ]);

        return redirect($portalSession->url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request)
    {
        $booking_date  = $request->get('date');
        $submission_id = $request->get('submission_id');

        session()->put('submission_id', $submission_id);
        session()->put('booking_date', $booking_date);

        if(auth()->user()->subscribed()){
            auth()->user()->submission->booking_date = $booking_date;
            auth()->user()->submission->is_confirmed = 1;
            auth()->user()->submission->save();

            return redirect()->route('group');
        }

        return redirect()->route('plan');
    }

    public function plan()
    {
        return view('web.plan');
    }

    public function pay(Request $request)
    {
        $payment_plan   = $request->get('payment_plan');
        $coupon         = $request->get('coupon');


        if($payment_plan == "ticket"){
            return $this->createCheckoutSession( $coupon);
        }else {
            return $this->subscribe_stripe($this->payment_plans[$payment_plan] , null ,$coupon);
        }
    }

    public function subscribe_stripe($priceId,$flow = null , $coupon = null)
    {
        $user                   = User::where('id', auth()->user()->id)->first();
        $currentSubscription    = $user->subscription('default');

        $plan_trial_days        = 0;

        $submission_id = session()->get('submission_id');
        $booking_date = session()->get('booking_date');

        //check if there is a running subscription
        if (isset($currentSubscription) && ($currentSubscription->stripe_status)) {
            //check if flow exists and mark it as null as user has an old subscription already
            if ($flow) {
                $flow = null;
            }
        }

        if ($flow == 'trial' && !isset($user->stripe_id)) {
            $newSubscription = $user->newSubscription('default', $priceId)->trialDays($plan_trial_days)->checkout([
                'success_url' => url('/'),
                'cancel_url' => url('/'),
            ]);

            $user->update([
                'trial_ends_at' => now()->addDays($plan_trial_days)
            ]);
        } else if ($coupon) {
            $newSubscription = $user->newSubscription('default', $priceId)->withCoupon($coupon)->checkout([
                'success_url' => route('group'),
                'cancel_url' => route('group'),
                'metadata' => [
                    'user_id' => auth()->user()->id,
                    'submission_id' => $submission_id,
                    'booking_date' => $booking_date
                ]
            ]);
        } else {
            $newSubscription = $user->newSubscription('default', $priceId)->checkout([
                'success_url' => route('group'),
                'cancel_url' => route('group'),
                'metadata' => [
                    'user_id' => auth()->user()->id,
                    'submission_id' => $submission_id,
                    'booking_date' => $booking_date
                ]
            ]);
        }

        return $newSubscription;
    }

    public function createCheckoutSessionCustomPrice($amount,$price,$couponCode = null)
    {
        $line_items[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => "Pay $$price",
                ],
                'unit_amount' => $price * 100, // Amount in cents
            ],
            'quantity' => 1,
        ];

        $submission_id = session()->get('submission_id');
        $booking_date = session()->get('booking_date');

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create the checkout session
        try {
            $sessionData = [
                'payment_method_types' => ['card'],
                'line_items'            => [$line_items],
                'mode'                  => 'payment',
                'success_url'            => route('callback') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'            => route('group'),
                'metadata' => [
                    'user_id' => auth()->user()->id,
                    'submission_id' => $submission_id,
                    'booking_date' => $booking_date
                ]
            ];

            if ($couponCode) {
                $sessionData['discounts'] = [
                    [
                        'coupon' => $couponCode,
                    ]
                ];
            }

            $session = Session::create($sessionData);

            return redirect($session->url);
        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }
    }

    public function createCheckoutSession($couponCode = null)
    {
        $submission_id = session()->get('submission_id');
        $booking_date = session()->get('booking_date');

//        Stripe::setApiKey(env('STRIPE_SECRET'));
        // Create the checkout session
        try {

            $sessionData =  [
                'success_url'            => route('callback') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'            => route('group'),
                'metadata' => [
                    'user_id' => auth()->user()->id,
                    'submission_id' => $submission_id,
                    'booking_date' => $booking_date
                ]
            ];

            if ($couponCode) {
                $sessionData['discounts'] = [
                    [
                        'coupon' => $couponCode,
                    ]
                ];
            }
            return auth()->user()->checkout([$this->ticket_price_stripe],$sessionData);
        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        $sessionId = $request->query('session_id');

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::retrieve($sessionId);

            if ($session->payment_status == 'paid') {

                $submission_id = session()->get('submission_id');
                $booking_date = session()->get('booking_date');

                auth()->user()->has_paid = 1;
                auth()->user()->save();

                Submission::where('id' , $submission_id)->update([
                    'is_confirmed'  => 1,
                    'booking_date'  => $booking_date
                ]);

                flash('Payment processed successfully');

                return redirect()->route('group');

            }else {
                flash()->error("Issue with payment");
            }
        } catch (ApiErrorException $e) {}

        return redirect()->back();
    }

    public function refundPayment()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $group = auth()->user()->group();

            $event = $group->event ?? null;

            $can_refund = 1;

            if($event){
                $windowTime = Carbon::parse($event->time)->subMinutes(4320);

                $currentTime = Carbon::now();

                $can_refund = $currentTime->gt($windowTime) ? 0 : 1; // user can only refund if current time is less than 72 hrs before the event time
            }

            if($can_refund){
                // Retrieve the last charge to get the charge ID
                $last_charge  = PaymentCharge::where('user_id' , auth()->user()->id)->orderby('id' , 'desc')->first();

                if(isset($last_charge)){
                    if($last_charge['is_refunded']){
                        flash()->error('Refund has already been issued');

                        return back();
                    }else {

                        $paymentIntent = \Stripe\PaymentIntent::retrieve($last_charge['charge_id']);

                        $chargeId = $paymentIntent->latest_charge; // The first charge ID

                        $refund = \Stripe\Refund::create([
                            'charge' => $chargeId,
                        ]);

                        if($refund['status'] == "succeeded"){
                            $last_charge->is_refunded = 1;
                            $last_charge->save();

                            auth()->user()->submission->is_confirmed = 0;
                            auth()->user()->submission->save();

                            return back();

                        }else {

                            flash()->error('This ticket is non-refundable ');

                            return back();
                        }
                    }

                }else {
                    return back();

                }
            }else {
                dd("This ticket is non-refundable");
                flash()->error('This ticket is non-refundable ');

                return back();
            }



        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    public function cancel()
    {
        $user = auth()->user();

        $currentSubscription = $user->subscription('default');

        if(isset($currentSubscription)){
            $currentSubscription->cancel();

//            if(!$currentSubscription->onGracePeriod()){
//                $currentSubscription->cancelNow();
//            }
        }

        return redirect()->back();
    }

    public function resume()
    {
        $user                = auth()->user();
        $currentSubscription = $user->subscription('default');

        if($currentSubscription){
            if ($currentSubscription->canceled()) {

                $currentSubscription->resume();
            }
        }

        return redirect()->back();
    }

    public function stripe_hook(Request $request)
    {
        $data               = $request->all();

        if(isset($data['data'])){
            $object             = $data['data']['object'];
            $sub_id             = $object['id']; // new sub id
            $customer_id        = isset($object['customer']) ? $object['customer'] : ''; // the customer id
            $submission_id      = $object['metadata']['submission_id'] ?? '';
            $booking_date       = $object['metadata']['booking_date'] ?? '';

            // handle subscription event
            if($object['object'] == 'subscription') {
                $status             = isset($object['status']) ? $object['status'] : '';
                $currency           = isset($object['currency']) ? $object['currency'] : 'eur';
                $provider_payment_id = isset($object['payment_intent']) ? $object['payment_intent'] : '';
                $user                = User::where('stripe_id', $customer_id)->first();
                $currentSubscription = $user->subscription('default');

                if ($status == "canceled") {
                    // Mark the subscription as canceled without deleting it
                    $subscription = \Laravel\Cashier\Subscription::where('user_id', $user->id)->where('stripe_id', $sub_id)->first();
                    if ($subscription) {
                        $subscription->delete();
                    }

                    $user->has_paid = 0;
                    $user->save();
                }

                if (in_array($status, ["created", "active", "trialing"])) {

                    $discount           = $object['discount'];
                    $trial_end          = $object['trial_end'];
                    $paymentMethod      = $object['default_payment_method'];
                    $items              = $object['items']['data'];
                    $price_id           = $object['items']['data'][0]['plan']['id']; // the plan id / the product id
                    $quantity           = $object['quantity'];
                    $period_start       = isset($object['current_period_start']) ? $object['current_period_start'] : null;
                    $period_end         = isset($object['current_period_end']) ? $object['current_period_end'] : null;
                    $trial_ends_at      = isset($object['trial_ends_at']) ? $object['trial_ends_at'] : null;
                    $cancel_at          = isset($object['cancel_at']) ? $object['cancel_at'] : null;
                    $billing_period     = 1;
                    $next_billing_cycle = $period_end;
                    $subtotal           = 0;

                    if ($trial_ends_at) {
                        $trial_ends_at = Carbon::createFromTimestamp($trial_ends_at)->toDateTime();
                    }

                    if ($period_start) {
                        $period_start = Carbon::createFromTimestamp($period_start)->toDateTime();
                    }

                    if ($period_end) {
                        $period_end = Carbon::createFromTimestamp($period_end)->toDateTime();
                    }

                    if ($next_billing_cycle) {
                        $next_billing_cycle = Carbon::createFromTimestamp($next_billing_cycle)->toDateTime();
                    }

                    // Todo test with actual discount plan
                    if ($discount) {
                        $discount = $discount['coupon']['percent_off'];
                    } else {
                        $discount = 0;
                    }

                    if($paymentMethod) {
                        // set the default payment method
                        $user->updateDefaultPaymentMethod($paymentMethod);
                    }


                    if (isset($currentSubscription) && $currentSubscription->stripe_id != $sub_id) {
                        // Check if the current subscription is a new subscription, if so, cancel the previous one
                        $currentSubscription->cancelNow();
                    }

                    // create cashier subscription
                    \Laravel\Cashier\Subscription::updateOrCreate(
                        [
                            'stripe_id' => $sub_id,
                        ],
                        [
                            'name'                  => "default",
                            'user_id'               => $user->id,
                            'stripe_status'         => $status,
                            'stripe_price'          => $price_id,
                            'trial_ends_at'         => $trial_end,
                            'ends_at'               => $cancel_at,
                            'quantity'              => 0,
                        ]
                    );
                }
            }

            // handle checkout session
            if($object['object'] == 'checkout.session'){
                $user_id      = $object['metadata']['user_id'] ?? '';

                $payment_status = $object['payment_status'] ?? '';
                $mode           = $object['mode'] ?? '';
                $amount         = $object['amount_total'] ?? 0;

                if(isset($submission_id) && $payment_status == "paid"){

                    $user = User::find($user_id);

                    if(isset($user)){
                        $user->has_paid = 1;
                        $user->save();

                        Submission::where('id' , $submission_id)->update([
                            'is_confirmed'=> 1,
                            'booking_date'=> $booking_date
                        ]);

                        // save charge only for one time payment
                        if($mode == "payment"){
                            $charge_id      = $object['payment_intent'] ?? '';

                            PaymentCharge::updateOrCreate([
                                'charge_id'=> $charge_id,
                                'user_id'=> $user->id
                            ], [
                                'type'=> $mode,
                                'amount'=> $amount / 100
                            ]);
                        }
                    }
                }
            }
        }

        return 'OK';
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
