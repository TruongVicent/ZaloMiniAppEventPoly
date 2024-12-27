<?php

namespace App\Http\Controllers;

use App\Models\Event;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả các Event
        $Events = Event::all();
        // Trả về danh sách Event
        return response()->json([$Events], Response::HTTP_OK);
    }

    public function getCsrfToken()
    {
        return response()->json(['csrf_token' => csrf_token()], Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $Event = new Event();
        $Event->name = $request->name;
        $imagePath = $request->file('image')->store('events', 'public');
        $Event->image = $imagePath;
        $Event->event_type_id = $request->event_type_id;
        $Event->content = $request->content;
        $Event->start_time = $request->start_time;
        $Event->taget_audience = $request->taget_audience;
        $Event->status = $request->status;
        $Event->address = $request->address;



        $Event->save();



       return response()->json($Event);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
