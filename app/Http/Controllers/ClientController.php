<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ClientsRequest;
use Service\ClientService;

class ClientController extends Controller
{
    private $clientService;
    public function __construct()
    {
        $this->middleware('permission:Index-client|Edit-client|Delete-client', ['only' => ['index']]);
        $this->middleware('permission:Edit-client', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete-client', ['only' => ['destroy']]);
        $this->clientService = new ClientService();

    }
    public function index()
    {
        $clients =$this->clientService->all();
        return view('clients.index', compact('clients'));
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
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientsRequest $request, Client $client)
    {
        $this->clientService->update($client,$request->validated());
        session()->flash('success', 'Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->clientService->delete($client);
    }
}
