<?php

namespace App\Repository;

use App\Interface\EventInterface;
use App\Models\Event;
use App\Models\User;

class EventRepository implements EventInterface{

    protected $event;

    function __construct(Event $event){
        $this->event = $event;
    }

    public function getAllEvents(){
        return $this->event::all();
    }

    public function createEvent($request){
        return $this->event::create($request->only(['name', 'description', 'type','start_date', 'end_date']));
    }

    public function getEvent($id){
        return $this->event::where('id',$id)->first();
    }

    public function updateEvent($request, $id){
        return $this->event::where('id',$id)->update($request->only(['name', 'description', 'type','start_date', 'end_date']));
    }

    public function deleteEvent($id){
        return $this->event::where('id',$id)->first();
    }

    public function searchEvent($name){
        return $this->event::where('name','like','%'.$name.'%')->get();
    }

    public function filterEvents($key, $value){
        return $this->event::where($key, 'like', '%' . $value . '%')->get();
    }

    public function getEventTypes(){
        return $this->event::select('type')->distinct()->pluck('type');
    }

    public function searchByType($type){
        return $this->event::where('type', $type)->get();
    }

    public function searchByDate($start_date, $end_date){
        return $this->event::whereDate('start_date', '>=', $start_date)
        ->whereDate('end_date', '<=', $end_date)
        ->get();
    }

}
