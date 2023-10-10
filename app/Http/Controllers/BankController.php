<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = auth()->user()->transactions;

        return view('dashboard',['transactions' => $transactions]);
    }

    public function deposit()
    {
        return view('deposit');
    }
    public function viewWithdraw()
    {
        return view('withdraw');
    }
    public function viewTransfer()
    {
        return view('transfer');
    }
    public function transfer(Request $request)
    {
        $data = $request->validate([
            'receiver_email' => 'required|email|exists:users,email',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $sender = auth()->user();
        $receiver = User::where('email', $data['receiver_email'])->first();

        if ($sender->id == $receiver->id) {
            return back()->withErrors(['receiver_email' => 'You cannot transfer to yourself']);
        }

        if ($sender->balance < $data['amount']) {
            return back()->withErrors(['amount' => 'Insufficient funds']);
        }

        $sender->balance -= $data['amount'];
        $receiver->balance += $data['amount'];

        $sender->save();
        $receiver->save();

        Transaction::create([
            'user_id' => $sender->id,
            'type' => 'transfer_out',
            'amount' => $data['amount'],
            'related_user_id' => $receiver->id,
        ]);

        Transaction::create([
            'user_id' => $receiver->id,
            'type' => 'transfer_in',
            'amount' => $data['amount'],
            'related_user_id' => $sender->id,
        ]);

        return redirect('dashboard');
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
        $amount = $request->validate(['amount' => 'required|numeric|min:0.01']);

        $user = auth()->user();
        $user->balance += $amount['amount'];
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => $amount['amount'],
        ]);

        return redirect('dashboard');
    }

    public function withdraw(Request $request)
    {
        $amount = $request->validate(['amount' => 'required|numeric|min:0.01']);

        $user = auth()->user();

        if ($user->balance < $amount['amount']) {
            return back()->withErrors(['amount' => 'Insufficient funds']);
        }

        $user->balance -= $amount['amount'];
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'amount' => $amount['amount'],
        ]);

        return redirect('dashboard');
    }
    public function statement()
    {
        $transactions = auth()->user()->transactions;
        return view('statement', ['transactions' => $transactions]);
    }
}
