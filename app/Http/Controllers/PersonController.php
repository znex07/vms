<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\DB;
use PDF;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //this is where this function is tied to AUTH, means need to log in to access these functions.
        $this->middleware('auth');
    }

    public function index()
    {
        //this is the view page. Data tables
        $username = Auth::user()->name;
        $persons = Person::where('auth',$username)->latest()->paginate(10);
        //this returns the data inside the data tables in boostrap
        return view('persons.index',compact('persons'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //this will return validation.
        $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'floor_no' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'contact_no' => 'required',
            'city' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:person'],
            'rf_id' => ['required', 'string', 'max:255', 'unique:person'],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->store('public/image/pic');
        // this is variable assigning through create
        $username = Auth::user()->name;
        $person = new Person;
        $person->uniq_id = uniqid('sd_');
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
        $person->rf_id = $request->rf_id;
        $person->auth = $username;
        $person->level = $request->level;
        $person->profile_pic = $name;
        $person->path = $path;

        $uniqueid=$person->uniq_id;

        $person->save();
        return redirect()->route('persons.create')
                        ->with('success','Entry created successfully.');
        // return redirect()->route('image.upload',compact('uniqueid'))
        //                 ->with('success','Entry created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
        return view('persons.show',compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //redirect to edit page.
        return view('persons.edit',compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    //Update Record
    public function update(Request $request, Person $person)
    {
        // this one is of the security validation. It will return an error if the validation is error
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'house_no' => 'required',
        ]);

        $person->update($request->all());
        return redirect()->route('persons.index')
                        ->with('success','Entry updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */

    //Delete Record
    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('persons.index')
                        ->with('success','Entry deleted successfully');
    }

    //when the search button was pressed this will enter.
    public function trace(Request $request)
    {
        //the get() funtion is for taking all database within the condition stated; the first() function only returns ONE recent value
        $res = Person::where('uniq_id', $request['code'])->orwhere('rf_id', $request['code'])->get();
        $ress = Person::where('uniq_id', $request['code'])->orwhere('rf_id', $request['code'])->first();
        //if the search found nothing, return this
        if(empty($ress)){
            return redirect()->action([PersonController::class, 'search'])->with('error','Your Data cannot be found. Notify your administrator.');
        }
        else{
            //narrowing the value to the newest data entry of the traced card.
            $stats = Log::orderBy('date','desc')->orderBy('time','desc')->where('uniq_id', $ress->rf_id)->first();
            $statss="";

            //conditional empty statement for the 'STATUS' in logs.
            if(empty($stats)){
                $statss = "";
            }
            //this is the else statement.
            else{
                $statss = $stats->status;
            }
            //conditional statement for the 'STATUS' in logs.
            switch ($statss) {
                case "":
                    $statss = "IN";
                    break;
                case "IN":
                    $statss = "OUT";
                    break;
                case "OUT":
                    $statss = "IN";
                    break;
                default:
                    $statss = "IN";
            }
            //to create new entry in logs
            Log::create([
                'uniq_id' => $ress->rf_id,
                'time' => Carbon::now()->toTimeString(),
                'date' => Carbon::now()->toDateString(),
                'status' => $statss,
                'auth' => Auth::user()->name
            ]);

            //return the recent entered logs to the trace page
            $list = DB::table('person')->where('rf_id', $request['code'])->orwhere('person.uniq_id', $request['code'])->orderBy('date','desc')->orderBy('time','desc')
                    ->leftjoin('logs','person.rf_id','=','logs.uniq_id')->first();
            return view('tracing.scan', compact('list',$list));
        }
    }
    //this is tracing page
    public function search(Request $request){
        //for the page not bothering about the variables missing.
        $list = DB::table('person')->where('rf_id', $request['code'])->orwhere('person.uniq_id', $request['code'])->orderBy('date','desc')->orderBy('time','desc')
                    ->leftjoin('logs','person.rf_id','=','logs.uniq_id')->first();
        return view('tracing.scan', compact('list',$list));
    }
    public function searchby(Request $request){
        // dd($request->name_person);
        //for the page not bothering about the variables missing.
        $list = DB::table('person')->where('rf_id', $request['code'])->orwhere('person.uniq_id', $request['code'])->orderBy('date','desc')->orderBy('time','desc')
                    ->leftjoin('logs','person.rf_id','=','logs.uniq_id')->first();
        return view('pdf.search', compact('list',$list));
    }
    //PDF viewer and printing.

    public function pdflogs(Request $request){
        $name = Auth::user()->name;
        $name_search = $request->name_person;
        $from = $request->date_search1;
        $to = $request->date_search2;
        // dd($to);
        //here is to keep the User logs private to the User only
        $list = DB::table('logs')->where('person.last_name',$name_search)->orWhere('person.first_name',$name_search)->whereBetween('logs.date', [$from, $to])->orderBy('logs.created_at', 'desc')
                ->leftjoin('person','logs.uniq_id','=','person.rf_id')->get();
            //    dd(sizeof($list));
            if (sizeof($list) >= 1) {
            view()->share('lists',$list);
            //sending variables to the pdf
            $pdf = PDF::loadview('pdf.logs',$list)->setPaper('Legal', 'landscape');
            return $pdf->stream('logs.pdf');
        } else {
            return back()->withErrors(['No Record Found']);
        }



    }

    //these uploading image functions.
    //tinker this if you need to add upload image
    public function imageUpload(Request $request)
    {
        $uniqueid = Session::get('uniqueid');
        dd($uniqueid);
        return view('imageUpload');
    }

    public function imageUploadPost(Request $request)

    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // $imageName = time().'.'.$request->image->extension();
        $imageName = session()->get('uniqueid').'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        /* Store $imageName name in DATABASE from HERE */
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }

}
