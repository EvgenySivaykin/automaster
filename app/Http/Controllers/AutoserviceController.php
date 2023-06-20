<?php

namespace App\Http\Controllers;

use App\Models\Autoservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AutoserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autoservices = Autoservice::all()->sortBy('title');
        return view('back.autoservices.index', [
            'autoservices' => $autoservices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.autoservices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'autoservice_title' => 'required|alpha|min:3|max:100',
                'autoservice_address' => 'required|min:3|max:100',
                'autoservice_phone' => 'required|min:3|max:100',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $autoservice = new Autoservice;
        $autoservice->title = $request->autoservice_title;
        $autoservice->address = $request->autoservice_address;
        $autoservice->phone = $request->autoservice_phone;
        $autoservice->save();

        return redirect()->route('autoservices-index')->with('ok', 'New autoservice was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autoservice  $autoservice
     * @return \Illuminate\Http\Response
     */
    public function show(Autoservice $autoservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autoservice  $autoservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Autoservice $autoservice)
    {
        return view('back.autoservices.edit', [
            'autoservice' => $autoservice
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Autoservice  $autoservice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autoservice $autoservice)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'autoservice_title' => 'required|alpha|min:3|max:100',
                'autoservice_address' => 'required|min:3|max:100',
                'autoservice_phone' => 'required|min:3|max:100',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
        $autoservice->title = $request->autoservice_title;
        $autoservice->address = $request->autoservice_address;
        $autoservice->phone = $request->autoservice_phone;
        $autoservice->save();

        return redirect()->route('autoservices-index')->with('ok', 'Autoservice was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autoservice  $autoservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autoservice $autoservice)
    {
        // $autoservice->delete();
        // return redirect()->route('autoservices-index')->with('ok', 'Autoservice was deleted');

        if (!$autoservice->autoserviceMechanics()->count() && !$autoservice->autoserviceServices()->count()) {
            $autoservice->delete();
            return redirect()->route('autoservices-index')->with('ok', 'Autoservice was deleted');
        } else {
            return redirect()->back()->with('not', 'Autoservice has mechanis or services!');
        }
    }
}