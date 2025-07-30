<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TicketController extends Controller
{
    public function newTickets() : View
    {
        return view('admin.ticket.index');
    }
    public function openTickets() : View
    {
        return view('admin.ticket.index');
    }
    public function closeTickets()
    {
        return view('admin.ticket.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show() : View
    {
        return view('admin.ticket.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : Void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : Void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Void
    {
        //
    }
}
