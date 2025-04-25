<?php

namespace App\Interface;

interface EventInterface{

    public function getAllEvents();
    public function createEvent($request);
    public function getEvent($id);
    public function updateEvent($request, $id);
    public function deleteEvent($id);
    public function searchEvent($event_name);
    public function filterEvents($key, $value);
    public function getEventTypes();
    public function searchByType($type);
    public function searchByDate($start_date, $end_date);
}
