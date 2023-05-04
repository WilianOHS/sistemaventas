<?php

namespace App\Http\Controllers;

use App\Client;
use App\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:clients.create')->only(['create','store']);
        $this->middleware('can:clients.index')->only(['index']);
        $this->middleware('can:clients.edit')->only(['edit','update']);
        $this->middleware('can:clients.show')->only(['show']);
        $this->middleware('can:clients.destroy')->only(['destroy']);
    }
    public function index()
    {
        $clients = Client::get();
        return view('admin.client.index',compact('clients'));
    }
    public function create()
    {
        return view('admin.client.create');
    }
    public function store(StoreRequest $request)
    {
        Client::create($request->all());
        return redirect()->route('clients.index');
    }
    public function show(Client $client)
    {
        // $sales = Sale::get();
        // return view('admin.client.show',compact('client','sales'));
        $sales = Sale::where('client_id', $client->id)->get();
        return view('admin.client.show', compact('client', 'sales'));
    }
    public function edit(Client $client)
    {
        return view('admin.client.edit',compact('client'));
    }
    public function update(UpdateRequest $request, Client $client)
    {
        $client->update($request->all());
        return redirect()->route('clients.index');
    }
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
}
