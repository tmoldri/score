<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List cards
     *
     * @return Response
     */
    public function index()
    {
    	//get list of all cards
    	$cards = Card::with(['current_user'])->orderBy('title','asc')->get();

        return view('cards', compact('cards','totals'));
    }

    /**
     * Show specific card
     *
     * @param integer $id
     * @return Response
     */
    public function show($id)
    {
        $card = Card::findOrFail($id);
        $elements = $card->elements()->with(['users' => function ($query) {
            $query->where('user_id',Auth::id());
        }])->get();

        return view('show', compact('card','elements','user_points'));
    }

    /**
     * Create new card
     *
     * @return Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store card
     *
     * @param object $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $card = new Card;
        $card->title = $request->title;
        $card->save();

        //Send success email
        Mail::raw('Card created!', function ($message){
            $message->to(Auth::user()->email);
        });

        return redirect()->route('card.create.element',$card->id);
    }

    /**
     * Create card element
     *
     * @param integer $id
     * @return Response
     */
    public function createElement($id)
    {
        $card = Card::findOrFail($id);
        return view('create_element',compact('card'));
    }

    /**
     * Store card element
     *
     * @param object $request
     * @param integer $id
     * @return Response
     */
    public function storeElement(Request $request,$id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'points' => 'required|numeric|max:100000|min:1',
        ]);

        $card = Card::findOrFail($id);
        $card->elements()->create($request->all());
        $card->increment('total_points',$request->points);
        $card->save();

        return redirect()->route('card.create.element',$card->id);
    }

    /**
     * Update user score
     *
     * @param object $request
     * @param integer $id
     * @return Response
     */
    public function score(Request $request, $id)
    {
    	$card = Card::findOrFail($id);

    	if ($request->has('elements')) {

    		//get checked element collection from database
    		$checked_elements = $card->elements()->whereIn('id',$request->elements)->get();

    		//detach all card elements from user
    		Auth::user()->elements()->detach($card->elements);

    		//attach all checked elements
    		Auth::user()->elements()->attach($checked_elements);

    		//update user total points for current card
	    	$card->current_user()->sync([
	    		Auth::id() => [
	    			'total_points' => $checked_elements->sum('points')
	    		]
	    	]);
    	}
    	else {
    		//if no element is selected, detach all elements and total points from user for this card
    		Auth::user()->elements()->detach($card->elements);
    		Auth::user()->cards()->detach($card->id);
    	}

        return redirect()->back();
    }
}
