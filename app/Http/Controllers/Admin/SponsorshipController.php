<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use DateInterval;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Braintree\Gateway;
use Braintree\Transaction;
use App\Flat;
use App\Sponsorship;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class SponsorshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('protectPaymentRoute', ['only' => 'create']);
    }

    /* UTILITIES fro Braintree*/
    private static function isTransactionSuccessful($status)
    {
        return in_array($status, [
            Transaction::AUTHORIZED,
            Transaction::AUTHORIZING,
            Transaction::SETTLED,
            Transaction::SETTLING,
            Transaction::SETTLEMENT_CONFIRMED,
            Transaction::SETTLEMENT_PENDING,
            Transaction::SUBMITTED_FOR_SETTLEMENT
        ]);
    }

    private function newBrainreeGateway()
    {
        return new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsorships = DB::table('flat_sponsorship')
            ->join('flats', 'flat_sponsorship.flat_id', '=', 'flats.id')
            ->join('sponsorships', 'flat_sponsorship.sponsorship_id', '=', 'sponsorships.id')
            ->where('flats.user_id', Auth::id())
            ->orderBy('flat_sponsorship.start', 'desc')
            ->get();
        return view('admin.sponsorships.index', compact('sponsorships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dump($request->session()->get('_previous')['url']);
        $flat = Flat::findOrFail($request->flat_id);
        if ($flat->hasActiveSponsorship()) {
            return redirect()->route('admin.sponsorships.index')->withErrors('Appartamento già sponsorizzato');
        }

        $sponsorships = Sponsorship::all()->sortByDesc('price');
        $gateway = $this->newBrainreeGateway();
        $token = $gateway->ClientToken()->generate();
        return view('admin.sponsorships.create', compact('flat', 'sponsorships', 'token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method_nonce' => 'required',
            'sponsorship_id' => 'required|exists:sponsorships,id'
        ]);
        if ($validator->fails()) {
            return abort(403);
        }
        preg_match('/flat_id=(\d\d*)/', $request->session()->get('_previous')['url'], $matches);
        try {
            $flat_id = $matches[1];
        } catch (Exception $e) {
            return abort(403);
        }

        $sponsorship = Sponsorship::find($request->sponsorship_id);
        $gateway = $this->newBrainreeGateway();
        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'customer' => [
                'firstName' => Auth::user()->surname,
                'lastName' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'customFields' => [
                'user_id' => Auth::id(),
                'flat_id' => $flat_id
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success && SponsorshipController::isTransactionSuccessful($result->transaction->status)) {
            $start = new DateTime();
            $end = clone $start;
            $end->add(new DateInterval('PT' . $sponsorship->getHoursDurationAsStr() . 'H'));
            Flat::find($flat_id)->sponsorships()->attach($sponsorship->id, [
                'start' => $start,
                'end' => $end,
                'braintree_code' => $result->transaction->id
            ]);
            return redirect()
                ->route('admin.sponsorships.index')
                ->with('transactionId', $result->transaction->id);
        }
        return back()->withErrors('Transaction failed');
    }
}
