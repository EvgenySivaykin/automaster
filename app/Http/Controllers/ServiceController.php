<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Autoservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autoservices = Autoservice::all()->sortBy('title');
        $services = Service::all()->sortBy('title');
        
        return view('back.operations.index', [
            'services' => $services,
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
        $autoservices = Autoservice::all()->sortBy('title');

        return view('back.operations.create', [
            'autoservices' => $autoservices
        ]);
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
                'service_title' => 'required|min:3|max:100',
                'service_duration' => 'required|decimal:0,2|min:1|max:999',
                'service_price' => 'required|decimal:0,2|min:1|max:9999',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $service = new Service;
        $service->title = $request->service_title;
        $service->duration = $request->service_duration;
        $service->price = $request->service_price;
        $service->autoservice_id = $request->autoservice_id;

        $service->save();
        return redirect()->route('operations-index')->with('ok', 'New service was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $autoservices = Autoservice::all()->sortBy('title');
        
        return view('back.operations.edit', [
            'autoservices' => $autoservices,
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'service_title' => 'required|min:3|max:100',
                'service_duration' => 'required|decimal:0,2|min:1|max:999',
                'service_price' => 'required|decimal:0,2|min:1|max:9999',
                'autoservice_id' => 'required|numeric|min:1',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $service->title = $request->service_title;
        $service->duration = $request->service_duration;
        $service->price = $request->service_price;
        $service->autoservice_id = $request->autoservice_id;


        $service->save();
        return redirect()->route('operations-index')->with('ok', 'Service was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('operations-index')->with('ok', 'Service was deleted');
    }
}