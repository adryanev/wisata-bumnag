<?php

namespace App\Http\Controllers;

use App\Models\OrderStatusHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderStatusHistoryRequest;
use App\Http\Requests\UpdateOrderStatusHistoryRequest;

class OrderStatusHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOrderStatusHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderStatusHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderStatusHistory  $orderStatusHistory
     * @return \Illuminate\Http\Response
     */
    public function show(OrderStatusHistory $orderStatusHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderStatusHistory  $orderStatusHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderStatusHistory $orderStatusHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderStatusHistoryRequest  $request
     * @param  \App\Models\OrderStatusHistory  $orderStatusHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderStatusHistoryRequest $request, OrderStatusHistory $orderStatusHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderStatusHistory  $orderStatusHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderStatusHistory $orderStatusHistory)
    {
        //
    }
}
