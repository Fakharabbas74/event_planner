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

    public function getEvents(){
        Log::info('------------------------getEvents - Start------------------------');
        return $this->eventService->getEvents();
    }
    public function createEvent(Request $request){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->createEvent($request);
    }
    public function updateEvent(Request $request, $id){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->updateEvent($request, $id);
    }
    public function deleteEvent($id){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->deleteEvent($id);
    }
    public function searchEvents(Request $request){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->searchEvents($request);
    }
    public function filterEvents(Request $request){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->filterEvents($request);
    }
    public function getEventTypes(){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->getEventTypes();
    }
    public function searchByType(Request $request){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->searchByType($request);
    }
    public function searchByDate(Request $request){
        Log::info('------------------------getAllUsers - Start------------------------');
        return $this->eventService->searchByDate($request);
    }

}
