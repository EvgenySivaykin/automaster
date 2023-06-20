<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Autoservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Imagemanager;
//вставка для рейтинга ниже:
use Illuminate\Support\Facades\Auth;
//конец вставки

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autoservices = Autoservice::all()->sortBy('title');
        // $mechanics = Mechanic::all();
        $mechanics = Mechanic::all()->sortBy('last_name');

        return view('back.mechanics.index', [
            'mechanics' => $mechanics,
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
        
        return view('back.mechanics.create', [
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
                'mechanic_first_name' => 'required|alpha|min:3|max:100',
                'mechanic_last_name' => 'required|alpha|min:3|max:100',
                'autoservice_id' => 'required|numeric|min:1',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
        $mechanic = new Mechanic;


        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 600);

            $image->save(public_path().'/mechanics/'.$file);
            
            $mechanic->photo = '/mechanics/' . $file;
        }

        $mechanic->first_name = $request->mechanic_first_name;
        $mechanic->last_name = $request->mechanic_last_name;
        $mechanic->autoservice_id = $request->autoservice_id;
        
        $mechanic->save();
        return redirect()->route('mechanics-index')->with('ok', 'New mechanic was created');
    }

    //вставка касательно функции рейтингования:
    public function update_rating(Request $request, Mechanic $mechanic)
    {
        $rating = json_decode($mechanic->rating, 1);
        $rating[Auth::user()->id]= (int)$request->rating;
        $mechanic->update(['rating' => json_encode($rating)]);

        return redirect()->back()->with('ok', 'Mechanic was successfully rated');
    }
    //конец вставки




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(Mechanic $mechanic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function edit(Mechanic $mechanic)
    {
        $autoservices = Autoservice::all()->sortBy('title');

        return view('back.mechanics.edit', [
            'autoservices' => $autoservices,
            'mechanic' => $mechanic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        if ($request->delete_photo) {
            $mechanic->deletePhoto();
            return redirect()->back()->with('ok', 'Photo was deleted');
        }
        
        $validator = Validator::make(
            $request->all(),
            [
                'mechanic_first_name' => 'required|alpha|min:3|max:100',
                'mechanic_last_name' => 'required|alpha|min:3|max:100',
                'autoservice_id' => 'required|numeric|min:1',
            ]);

            if($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        
        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 600);

            if ($mechanic->photo) {
                $mechanic->deletePhoto();
            }

            $image->save(public_path().'/mechanics/'.$file);
            
            $mechanic->photo = '/mechanics/' . $file;
        }


        $mechanic->first_name = $request->mechanic_first_name;
        $mechanic->last_name = $request->mechanic_last_name;
        $mechanic->autoservice_id = $request->autoservice_id;
        
        $mechanic->save();
        return redirect()->route('mechanics-index')->with('ok', 'Mechanic was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mechanic $mechanic)
    {
        $drink->delete();
        return redirect()->route('mechanics-index')->with('ok', 'Mechanic was deleted');
    }
}