<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\GuestOrder;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->limit(5)->get();
        $guestOrders = GuestOrder::latest()->limit(5)->get();

        $newOrders = Order::where('status','=','Pending')->count();
        $newGuestOrders = GuestOrder::where('status','=','Pending')->count();
        $deliveredOrders = Order::where('status','=','Delivered')->count();
        $deliveredGuestOrders = GuestOrder::where('status','=','Delivered')->count();
        $onProcessOrders = Order::where('status','=','On Process')->count();
        $onProcessGuestOrders = GuestOrder::where('status','=','On Process')->count();

        $admins = User::where('is_admin','=','1')->count();
        $customers = User::where('is_admin','=','0')->count();
        
        return view('product.dashboard',compact('orders','guestOrders', 'newOrders', 'newGuestOrders', 'deliveredOrders', 'deliveredGuestOrders', 'onProcessOrders', 'onProcessGuestOrders','admins', 'customers'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
