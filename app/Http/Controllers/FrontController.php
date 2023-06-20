<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autoservice;
use App\Models\Mechanic;
use App\Models\Service;
use Carbon\Carbon;
use App\Services\CartService;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
//вставка по рейтингу:
use App\Http\Controllers\Controller;
//конец вставки

class FrontController extends Controller
{
    public function home(Request $request, Mechanic $mechanic) //вставка для рейтинга (добавляем request)
    
    {
        $mechanics = Mechanic::paginate(9);
        
        //МОИ НОВЫЕ ПОТУГИ (откомментировать потом):
        foreach ($mechanics as $mechanic) {
            $v = (array)json_decode($mechanic->rating, 1);
            $count = count($v);
            if ($count) {
                // $mechanic->result = round(array_sum($v)/$count) . ' / 5';
                $mechanic->result = round(array_sum($v)/$count);
            } else {
                $mechanic->result = 'no rating';
            }
            // return $mechanics;
        }
        //КОНЕЦ

        $user = Auth::user();
        //конец вставки

        //НОВАЯ ВСТАВКА ПРО ЗВЕЗДОЧКИ РЕЙТИНГА НИЖЕ:

        // foreach ($mechanics as $mechanic) {
        //     $v = (array)json_decode($mechanic->rating, 1);
        //     $count = count($v);

        //     if ($count) {
        //         $mechanic->result = round(array_sum($v)/$count);
        //     } else {
        //         $mechanic->rating = 'no rating';
        //     }
        //     // return $mechanics;
        // }

        // function displayRatingStars($kart) {
        //     $stars = str_repeat("&#9733;", $kart); // HTML код желтой звездочки - &#9733;
        //     return $stars;
        // }

        // $mechanic->stars = displayRatingStars($mechanic->result);

        // function displayRatingStars($kart) {
        //     $stars = str_repeat("&#9733;", $kart); // HTML код желтой звездочки - &#9733;
        //     return $stars;
        // }

        // // $mechanic->$stars = displayRatingStars($mechanic->result);
        // $mechanic->stars = displayRatingStars(4);

        


        //КОНЕЦ ВСТАВКИ

        $services = Service::all()->sortBy('title');

        return view('front.home', [
            'mechanics' => $mechanics,
            'services' => $services,
            //вставка по рейтингу ниже:
            'user' => $user,
            //конец вставки

        ]);
    }

    public function showCatMechanics(Autoservice $autoservice)
    {
        $mechanics = Mechanic::where('autoservice_id', $autoservice->id)->paginate(9);

        return view('front.home', [
            'mechanics' => $mechanics
        ]); 
    }

    public function choose(Mechanic $mechanic, Service $services, Autoservice $autoservice)
    {
        $services = Service::all()->sortBy('title');

        // $services = Service::where($service->serviceAutoservice->title == $mechanic->mechanicAutoservice->title);

        return view('front.choose', [
            'mechanic' => $mechanic,

            // 'mechanic' => $this->mechanic,

            // 'service' => $service,

            //начало вставки:
            'services' => $services
            // конец вставки

        ]);
    }

    public function addToCart(Request $request, CartService $cart)
    {
        $services = Service::all()->sortBy('title');

        $id = (int) $request->product;
        $count = (int) 1;
        // $mech = (int)$request->mech;
        // $cart->add($id, $count, $mech);

        //НОВАЯ ВСТАВКА 1 НИЖЕ:
        // $start_date = Carbon::parse($request->start);
        // $start_time = Carbon::parse($request->time);

        // $cart->add($id, $count, $start_date, $start_time);

        //КОНЕЦ ВСТАВКИ

        $cart->add($id, $count); //ЭТО ВЕРНУТЬ ПРИ СТИРАНИИ ВЕРХНЕЙ ВСТАВКИ
        return redirect()->back();

        // $cart->add($id, $count, $mech);

        // return redirect()->back();
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list
        ]);
    }

    public function updateCart(Request $request, CartService $cart)
    {
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
            $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
            $cart->update($updatedCart);
        }
        return redirect()->back();
    }

    //новая вставка ниже:
    public function makeOrder(CartService $cart)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->order_json = json_encode($cart->order());
        $order->save();
        $cart->empty();

        return redirect()->route('start')->with('ok', 'Order succesfully has been sent');
    }

}