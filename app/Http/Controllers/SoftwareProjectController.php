<?php

namespace App\Http\Controllers;

use App\Models\SoftwareProject;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Filament\Notifications\Notification;

class SoftwareProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả các SoftwareProject
        $SoftwareProjects = SoftwareProject::all();

        // Trả về danh sách SoftwareProject
        return response()->json($SoftwareProjects, Response::HTTP_OK);
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

        $softwareProject = new SoftwareProject();
        $softwareProject->name = $request->name;
        $softwareProject->members = $request->members;
        $softwareProject->level = $request->level;
        $softwareProject->progress = $request->progress;
        $softwareProject->star_date = $request->star_date;
        $softwareProject->end_date = $request->end_date;
        $softwareProject->content = $request->content;




        $softwareProject->save();



       return response()->json($softwareProject);
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
