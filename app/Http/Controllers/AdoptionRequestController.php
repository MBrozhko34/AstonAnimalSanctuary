<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

class AdoptionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $adoption_requests = AdoptionRequest::all()->toArray();
      return view('adoption_requests.index', compact('adoption_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
      // $animal = Animal::find($id);
      // $adopRequest = new AdoptionRequest;
      // $adopRequest->userid = auth()->user();
      // $adopRequest->name = $animal->name;
      // $adopRequest->species = $animal->species;
      // $adopRequest->state = "Pending";
      // $adopRequest->created_at = now();
      // $adopRequest->save();
    }

    public function addAdoptionRequest(Request $request, $id)
    {
      $animal_id = $request->id;
      $user_id = Auth::id();

      $request = new AdoptionRequest();
      $animal = Animal::find($animal_id);
      $user = Auth::user()->name;

      $request->user_id = $user_id;
      $request->owner_name = $user;
      $request->animal_id = $animal_id;
      $request->animal_name = $animal->name;
      $request->save();

      return redirect('/home')->with('success', 'Animal has been adopted');
    }

    public function declineAdoptionRequest($id)
    {
      $req = AdoptionRequest::find($id);

      $animal_id = $req->animal_id;

      $animal = Animal::find($animal_id);

      $animal->userid=null;
      $animal->available="available";
      $animal->save();

      $req->state = "Declined";
      $req->save();

      return redirect('/adoption_requests');
    }

    public function confirmAdoptionRequest($id)
    {
      $req = AdoptionRequest::find($id);

      $owner_id = $req->user_id;
      $animal_id = $req->animal_id;

      $animal = Animal::find($animal_id);

      $animal->userid=$owner_id;
      $animal->available="adopted";
      $animal->save();

      $req->state = "Accepted";
      $req->save();

      return redirect('/adoption_requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
