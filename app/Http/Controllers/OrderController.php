<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Order;
use Exception;

class OrderController extends Controller
{
    public function show($id)
    {
        # code...
    }

    public function store(Request $request)
    {
        try {
            Order::create($request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
