<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\signIn;
use App\Http\Requests\signUp;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Interface\EventInterface;
use App\Models\Event;

class EventService{

    protected $eventInterface;

    function __construct(EventInterface $eventInterface){
        $this->eventInterface = $eventInterface;
    }

    public function getAllEvents(){
        try {
            $events = $this->eventInterface->getAllEvents();
            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Events fetched successfully',
                'data' => $events
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'response_code' => 400,
                'message' => $e->getMessage(),
                'line_number' => $e->getLine()
            ], 400);
        }
    }

    public function createEvent(Request $request){
        try {
            $request->validate([
                'name' => 'required',
                'detail' => 'required',
                'category' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            $event = $this->eventInterface->createEvent($request);

            return response()->json([
                'status' => true,
                'response_code' => 200,
                'message' => 'Event created successfully',
                'data' => $event
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'response_code' => 400,
                'message' => $e->getMessage(),
                'line_number' => $e->getLine()
            ], 400);
        }
    }

    public function updateEvent(Request $request, $id){
        try {
            $request->validate([
                'name' => 'nullable',
                'detail' => 'nullable',
                'category' => 'nullable',
                'start_date' => 'nullable',
                'end_date' => 'nullable',
            ]);

            $event = $this->eventInterface->getEvent($id);
            if($event){
                $event = $this->eventInterface->updateEvent($request, $id);
                return response()->json([
                    'status' => true,
                    'response_code' => 200,
                    'message' => 'Event updated successfully',
                    'data' => $event
                ], 200);
            }else{
                return response()->json([
                    'status' => true,
                    'response_code' => 200,
                    'message' => 'Event not found',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'response_code' => 400,
                'message' => $e->getMessage(),
                'line_number' => $e->getLine()
            ], 400);
        }
    }

    public function deleteEvent($id){
        try {
            $event = $this->eventInterface->getEvent($id);
            if($event){
                $event = $this->eventInterface->deleteEvent($id);
                return response()->json([
                    'status' => true,
                    'response_code' => 200,
                    'message' => 'Event deleted successfully'
                ], 200);
            }else{
                return response()->json([
                    'status' => true,
                    'response_code' => 200,
                    'message' => 'Event not found'
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'response_code' => 400,
                'message' => $e->getMessage(),
                'line_number' => $e->getLine()
            ], 400);
        }
    }

    public function searchEvents(Request $request){
        try {
            $events = $this->eventInterface->searchEvent($request->name);

            if($events){
                return response()->json([
                    'status' => true,
                    'response_code' => 200,
                    'message' => 'Event searched successfully',
                    'events' => $events
                ], 200);
            }else{
                return response()->json([
                    'status' => true,
                    'response_code' => 200,
                    'message' => 'No event not found'
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'response_code' => 400,
                'message' => $e->getMessage(),
                'line_number' => $e->getLine()
            ], 400);
        }
    }

    public function filterEvents(Request $request){
        try {
            $request->validate([
                'key' => 'required|in:category,start_date,end_date',
                'value' => 'required'
            ]);
            $key = $request->key;
            $value = $request->value;
            $events = $this->eventInterface->filterEvents($key, $value);

            return response()->json([
                'status' => true,
                'events' => $events,
                'message' => 'Filtered successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ], 400);
        }
    }

    public function getEventCategory(){
        try {

            $categories = $this->eventInterface->getEventCategories();

            return response()->json([
                'status' => true,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching event categories: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function searchByCategory(Request $request){
        $request->validate([
            'category' => 'required|string'
        ]);

        $events = $this->eventInterface->searchByCategory($request->category);

        return response()->json([
            'status' => true,
            'events' => $events
        ]);
    }

    public function searchByDate(Request $request){
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $events = $this->eventInterface->searchByDate($request->start_date, $request->end_date);

        return response()->json([
            'status' => true,
            'events' => $events
        ]);
    }
}
