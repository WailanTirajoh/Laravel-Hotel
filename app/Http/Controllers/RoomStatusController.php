<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomStatusRequest;
use App\Models\RoomStatus;
use Illuminate\Http\Request;

class RoomStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roomstatuses = RoomStatus::orderBy('id');

        if (!empty($request->search)) {
            $roomstatuses = $roomstatuses->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $roomstatuses = $roomstatuses->paginate(5);
        $roomstatuses->appends($request->all());
        return view('roomstatus.index', compact('roomstatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roomstatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomStatusRequest $request)
    {
        $roomstatus = RoomStatus::create($request->all());
        return redirect()->route('roomstatus.index')->with('success', 'Room ' . $roomstatus->name . ' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function show(RoomStatus $roomStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomStatus $roomstatus)
    {
        return view('roomstatus.edit', compact('roomstatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoomStatusRequest $request, RoomStatus $roomstatus)
    {
        $roomstatus->update($request->all());
        return redirect()->route('roomstatus.index')->with('success', 'Room ' . $roomstatus->name . ' udpated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomStatus $roomstatus)
    {
        try {
            $roomstatus->delete();
            return redirect()->route('roomstatus.index')->with('success', 'Room ' . $roomstatus->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect()->route('roomstatus.index')->with('failed', 'Room ' . $roomstatus->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
