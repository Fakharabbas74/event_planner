<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Services\EventService;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    protected $eventService;

    function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }

    public function getAllEvents(){
        return $this->eventService->getAllEvents();
    }
    public function createEvent(Request $request){
        return $this->eventService->createEvent($request);
    }
    public function updateEvent(Request $request, $id){
        return $this->eventService->updateEvent($request, $id);
    }
    public function deleteEvent($id){
        return $this->eventService->deleteEvent($id);
    }
    public function searchEvents(Request $request){
        return $this->eventService->searchEvents($request);
    }
    public function filterEvents(Request $request){
        return $this->eventService->filterEvents($request);
    }
    public function getEventCategory(){
        return $this->eventService->getEventCategory();
    }
    public function searchByCategory(Request $request){
        return $this->eventService->searchByCategory($request);
    }
    public function searchByDate(Request $request){
        return $this->eventService->searchByDate($request);
    }

}
