<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return Ticket::all();
    }

    public function store(Request $request)
    {
        try {
            $ticket = new Ticket();
            $ticket->title = $request->title;
            $ticket->body = $request->body;
            $ticket->description = '';
            $ticket->body = $request->body;
            $ticket->category_id = $request->category_id;
            if($ticket->category_id == '1'){
                $ticket->category_name= 'Form Builder';
            }
            else if($ticket->category_id == '2'){
                $ticket->category_name= 'App Builder';
            }
            else if($ticket->category_id == '3'){
                $ticket->category_name= 'Mobil App';
            }
            else if($ticket->category_id == '4'){
                $ticket->category_name= 'Tables';
            }

            $ticket->uid = uniqid();
            $ticket->status = 'problem waiting to be solved';

            

            if ($ticket->save()) {
                return response()->json(['status' => 'success', 'message' => 'Ticket created successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->description = $request->description;
            $ticket->status = 'Problem has been solved';

            if ($ticket->save()) {
                return response()->json(['status' => 'success', 'message' => 'Ticket updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);

            if ($ticket->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Ticket deleted successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}