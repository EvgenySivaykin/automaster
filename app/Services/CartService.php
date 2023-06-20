<?php

namespace App\Services;

use App\Models\Autoservice;
use App\Models\Mechanic;
use App\Models\Service;

class CartService
{
    // public function test()
    // {
    //     return 'Hello! This is Cart Service!';
    // }

    private $cart, $cartList, $total=0;

    public function __construct()
    {

        $this->cart = session()->get('cart', []);

        $ids = array_keys($this->cart);


        $this->cartList = Service::whereIn('id', $ids)
        ->get()
        ->map(function($service) {
            $service->sum = $service->price;
            // $service->workers_name = $mechanic->first_name;
            // $service->workers_last_name = $mechanic->last_name;
            $this->operation_title = $service->title;
            // начало вставки:
            // $this->date = $request->start_date;
            // $this->time = $request->start_time;

            // $this->date = $service->start_date;
            // $this->time = $service->start_time;
            // конец вставки
            $this->total += $service->sum;

            return $service;
        });
    }

    public function __get($props)
    {
        return match($props) {
            'total' => $this->total,
            'list' => $this->cartList,
            // начало вставки:
            // 'date' => $this->date,
            // 'time' => $this->time,
            //конец вставки

            //начало вставки:
            'cart' => $this->cart,
            //конец вставки
            default => null,
        };
    }


    //новая вставка ниже:

    public function order()
    {
        $order = (object)[];
        $order->total = $this->total;
        $order->services = [];

        foreach($this->cartList as $service) {
            $order->services[] = (object) [
                'title' => $service->title,
                'count' => $service->count,
                'price' => $service->price,
                'id' => $service->id,
            ];
        }
        return $order;
    }

    public function empty()
    {
        session()->put('cart', []);
        $this->total = 0;
        $this->count = 0;
        $this->cartList=collect();
        $this->cart = [];
    }

    //конец вставки

    public function add(int $id, $count)
    {
        // dump($this->cart);
        // dump($this->$id);
        // die;
        // if (isset($this->cart[$id])) {
        //     $this->cart[$id] += $count;
        // } else {
        //     $this->cart[$id] = $count;
        // }
        $this->cart[$id] = $count;
        

        session()->put('cart', $this->cart);
    }

    public function delete(int $id)
    {
        unset($this->cart[$id]);
        session()->put('cart', $this->cart);
    }

}