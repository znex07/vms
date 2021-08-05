<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use DB;
class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = DB::table('person')->get();
        return view('visitor', compact('persons'));
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
        // dd($request->all());
        $request->validate([
            // 'uniq_id' => 'required',
            'person_to_visit' => 'required',
            'purpose' => 'required',
            'destination' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'floor_no' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'contact_no' => 'required',
            'city' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:person'],
        ]);
        $uniq_id = uniqid('vs_');
        // this is variable assigning through create
        $username = Auth::user()->name;
        $person = new Visitor;
        $person->uniq_id = $uniq_id;
        $person->person_to_visit = $request->person_to_visit;
        $person->purpose = $request->purpose;
        $person->destination = $request->destination;
        $person->last_name = $request->last_name;
        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->floor_no = $request->floor_no;
        $person->house_no = $request->house_no;
        $person->street = $request->street;
        $person->barangay = $request->barangay;
        $person->city = $request->city;
        $person->contact_no = $request->contact_no;
        $person->email = $request->email;
        $person->level = 'visitor';


        $person->save();
        return back()->with('success','Entry created successfully.')->with('uniq_id', $uniq_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
        return view('persons.show',compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
        return view('visitor.edit',compact('visitor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'house_no' => 'required',
        ]);
        $visitor->update($request->all());
        return redirect()->route('persons.index')
                        ->with('success','Entry updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {

    }
}
