<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
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
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        Notification::destroy($notification->id);
        return back();
    }

    public function viewed()
    {
        Notification::where('id', request()->id)->update(['viewed' => true]);
        return redirect("/transaction/borrows");
    }

    public function viewedAll()
    {
        Notification::where('member_id', request()->member_id)->whereNull('viewed')->update(['viewed' => true]);
        return back();
    }
    public function viewedAllStaff()
    {
        Notification::whereNull('member_id')->whereNull('viewed')->update(['viewed' => true]);
        return back();
    }

    public function deleteAll(Request $request){
        Notification::where('member_id', $request->id)->delete();
        return back();
    }

    public function deleteAllStaff(Request $request){
        Notification::whereNull('member_id')->delete();
        return back();
    }
}