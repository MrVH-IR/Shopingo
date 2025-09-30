<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TicketController extends Controller
{
    public function newTickets()
    {
        $tickets = Ticket::where('seen', 0)->simplePaginate(15);
//        foreach($tickets as $newTicket){
//            $newTicket->seen = 1;
//            $newTicket->save();
//        }
        return view('admin.ticket.index', compact('tickets'));
    }

    public function openTickets()
    {
        $tickets = Ticket::where('status', 0)->simplePaginate(15);
        return view('admin.ticket.index', compact('tickets'));
    }

    public function closeTickets()
    {
        $tickets = Ticket::where('status', 1)->simplePaginate(15);
        return view('admin.ticket.index', compact('tickets'));
    }

    public function index()
    {
        $tickets = Ticket::simplePaginate(15);
        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('admin.ticket.show' , compact('ticket'));
    }

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 1 ? 0 : 1;
        $ticket->save();
        return redirect()->back()
            ->with('swal-success' , 'وضعیت تیکت با موفیت تغییر یافت');
    }

    public function answer(Request $request , Ticket $ticket)
    {
        $request->validate([
            "answer" => "required|string|min:3|max:1500|regex:/^[\pL\s\-]+$/u"
        ],[
            "answer.required" => "وارد کردن پاسخ الزامی است.",
            "answer.min"      => "پاسخ باید حداقل ۳ کاراکتر باشد.",
            "answer.max"      => "پاسخ نمی‌تواند بیشتر از ۱۵۰۰ کاراکتر باشد.",
            "answer.regex"    => "از به کار بردن کاراکتر های نامربوط خودداری کنید"
        ]);

        $validated['subject'] = $ticket->subject;
        $validated['seen'] = 1;
        $validated['status'] = 0;
        $validated['reference_id'] = $ticket->reference_id;
        $validated['category_id'] = $ticket->category_id;
        $validated['priority_id'] = $ticket->priority_id;
        $validated['description'] = $request->answer;
        $validated['user_id'] = 159;
        $validated['ticket_id'] = $ticket->id;

        $result = Ticket::create($validated);
        return redirect()->back()->with('swal-success' , 'جواب تیکت با موفقیت ارسال شد');
    }
}
