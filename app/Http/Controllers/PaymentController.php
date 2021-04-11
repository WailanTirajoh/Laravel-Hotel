<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::paginate(5);
        return view('payment.index', [
            'payments' => $payments
        ]);
    }

    public function add()
    {
        return view('payment.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'number' => 'required|unique:payments,number',
            'capacity' => 'required|numeric',
            'price' => 'required|numeric',
            'view' => 'required|max:255'
        ]);

        $payment = Payment::create([
            'type_id' => $request->type_id,
            'number' => $request->number,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'view' => $request->view
        ]);

        return redirect('payment')->with('success', 'payment ' . $payment->number . ' created');
    }

    public function edit(payment $payment)
    {
        return view('payment.edit', [
            'payment' => $payment
        ]);
    }

    public function update(payment $payment, Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'number' => 'required|unique:payments,number,'.$payment->id,
            'capacity' => 'required|numeric',
            'price' => 'required|numeric',
            'view' => 'required|max:255'
        ]);

        $payment->update($request->all());
        return redirect('payment')->with('success', 'payment ' . $payment->name . ' udpated!');
    }

    public function destroy(payment $payment)
    {
        $payment->delete();
        return redirect('payment')->with('success', 'payment ' . $payment->name . ' deleted!');
    }
}
