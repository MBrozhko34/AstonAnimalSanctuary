<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;


class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
      $animals = Animal::sortable()->paginate(5);
      return view('animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       return view('animals.create');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // form validation
      $animal = $this->validate(request(), [
        'name' => 'required',
        'species' => 'required',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
      ]);

      //Handles the uploading of the image
      if ($request->hasFile('image')){
        //Gets the filename with the extension
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        //just gets the filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //Just gets the extension
        $extension = $request->file('image')->getClientOriginalExtension();
        //Gets the filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Uploads the image
        $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
      }
      else {
        $fileNameToStore = 'noimage.jpg';
      }
      // create a animal object and set its values from the input
      $animal = new Animal;
      $animal->name = $request->input('name');
      $animal->description = $request->input('description');
      $animal->species = $request->input('species');
      $animal->DOB = $request->input('DOB');
      $animal->available = $request->input('available');
      $animal->created_at = now();
      $animal->image = $fileNameToStore;
      // save the animal object
      $animal->save();
      // generate a redirect HTTP response with a success message
      return back()->with('success', 'Animal has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $animal = Animal::find($id);
      return view('animals.show',compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $animal = Animal::find($id);
      return view('animals.edit',compact('animal'));
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
      $animal = Animal::find($id);
      $this->validate(request(), [
        'name' => 'required',
        'species' => 'required'
      ]);
      $animal->name = $request->input('name');
      $animal->description = $request->input('description');
      $animal->species = $request->input('species');
      $animal->DOB = $request->input('DOB');
      $animal->available = $request->input('available');
      $animal->created_at = now();

      //Handles the uploading of the image
      if ($request->hasFile('image')){
      //Gets the filename with the extension
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      //just gets the filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //Just gets the extension
      $extension = $request->file('image')->getClientOriginalExtension();
      //Gets the filename to store
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      //Uploads the image
      $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
      } else {
      $fileNameToStore = 'noimage.jpg';
      }
      $animal->image = $fileNameToStore;
      $animal->save();
      return redirect('animals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $animal = Animal::find($id);
      $animal->delete();
      return redirect('animals');
    }
}
