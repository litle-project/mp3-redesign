<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Models\LiburNasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalenderController extends Controller
{
    public function index(){
        $data['page_title'] = 'Calender';
        $events = CalendarEvent::orderby('id', 'asc')->get();
        
        $data['arrayEvent'] = [];
        foreach ($events as $key => $val) {
            if ($val->jam_event == null) {
                $object = (object) ['title' => $val->judul_event,
                'start' => $val->tanggal_event,
                'color' => $val->color_event,
                'allDay' => true];
            }else{
                $object = (object) ['title' => $val->judul_event,
                'start' => date($val->tanggal_event.' '.$val->jam_event.':00'),
                'color' => $val->color_event,
                'allDay' => false];

            }

            $data['arrayEvent'][] = $object;
        }
        return view('calender.index', $data);
    }

    public function addEvent(Request $request, $id){

        try {
            // Store Event
            $event = new CalendarEvent();
            $event->judul_event = $request->judul_event;
            $event->tanggal_event = $request->tanggal_event;
            $event->jam_event = $request->jam_event ?? null;
            $event->color_event = $request->color_event ?? '#3788d8';
            $event->user_id = $id;
            
            $event->save();
          
            return redirect()->route('calender.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('calender.index')->with(['failed' => 'Data gagal dibuat !']);
        }
    }
}
