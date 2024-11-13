<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Filament\Notifications\Notification;

class TickitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả các ticket
        $tickets = Ticket::all();

        // Trả về danh sách ticket
        return response()->json($tickets, Response::HTTP_OK);
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

        $tictek = new Ticket();
        $tictek->name_student = $request->name_student;
        $tictek->code_student = $request->code_student;
        $tictek->email = $request->email;
        $tictek->content_support = $request->content_support;

        $admin = User::find(1); // Hoặc bạn có thể tìm theo điều kiện khác
        // Gửi thông báo đến quản trị viên

        Notification::make()
            ->title('Yêu cầu hỗ trợ của sinh viên')
            ->body('Mã số sinh viên: ' . $tictek->code_student)
            ->sendToDatabase($admin, isEventDispatched: true);

        $tictek->save();



       return response()->json($tictek);
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
