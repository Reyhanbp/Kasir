<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $pagination = 5;

        $datas = Item::where(function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%');
        })->orderBy('id', 'asc')->paginate($pagination);
        return view('transaction.index', compact('datas'));
    }

    public function Tambah($id)
    {
        $item = Item::findorfail($id);
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
            $cart[$id]['subtotal'] = $item->price * $cart[$id]['qty'];
        } else {
            $cart[$id] = [
                "id" => $item->id,
                "name" => $item->name,
                "qty" => 1,
                "subtotal" => $item->price,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('transaction')->with('message', 'Berhasil Menambahkan Data');
    }

    public function Update(Request $request)
    {
        $item = Item::findorfail($request->id);
        $cart = session('cart');

        $cart[$request->id]['qty'] = $request->qty;
        $cart[$request->id]['subtotal'] = $item->price *= $request->qty;
        session()->put('cart', $cart);
        return redirect()->route('transaction')->with('message', 'Berhasil Mengupdate Data');

    }
    public function Delete($id)
    {

        $cart = session('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('transaction')->with('message', 'Berhasil Menghapus Data');
    }
    public function Send(Request $request)
    {
        Transaction::create([
            'user_id' => Auth::id(),
            'date' => Carbon::now(),
            'total' => $request->total,
            'pay_total' => $request->pay_total,
        ]);


        $cart = session('cart');

        foreach($cart as $item){
            TransactionDetail::create([
                'transaction_id' => Transaction::latest()->first()->id,
                'item_id' => $item['id'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('transaction')->with('message', 'Berhasil Menambahkan Data');

    }
    public function store(Request $request)
    {
        Transaction::create([
            'user_id' => Auth::id(),
            'date' => Carbon::now(),
            'total' => $request->total,
            'pay_total' => $request->pay_total,
        ]);

        $items = session('cart');

        foreach ($items as $item) {
            TransactionDetail::create([
                'transaction_id' => Transaction::latest()->first()->id,
                'item_id' => $item['id'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal']
            ]);
        }

        session()->forget('cart');
        return redirect()->route('transaction.show', ['id' => Transaction::latest()->first()->id])->with('message', 'Berhasil Melakukan Transaksi');
    }

    public function show($id)
    {
        $user = auth()->user();
        $invoice = Transaction::find($id);
        return view('transaction.invoice', compact('invoice', 'user'));
    }
}
