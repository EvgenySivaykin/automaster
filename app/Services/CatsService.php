<?php

namespace App\Services;

use App\Models\Autoservice;
// use App\Models\Service;

class CatsService
{
    public function test()
    {
        return 'Hello! This is Cats Service!';
    }

    public function get()
    {

        //вставка ниже:
        // $services = Service::all()->sortBy('title');

        //конец вставки


        return Autoservice::all()->sortBy('title');

    }


}