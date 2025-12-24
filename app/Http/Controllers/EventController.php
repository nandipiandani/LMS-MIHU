<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\SchoolSessionInterface;

class EventController extends Controller
{
    use SchoolSession;
    protected $schoolSessionRepository;

    public function __construct(SchoolSessionInterface $schoolSessionRepository) {
        $this->schoolSessionRepository = $schoolSessionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $current_school_session_id = $this->getSchoolCurrentSession();

            $data = Event::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->where('session_id', $current_school_session_id)
                    ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('events.index');
    }

    public function calendarEvents(Request $request)
{
    $current_school_session_id = $this->getSchoolCurrentSession();

    switch ($request->type) {

        case 'create':
            $event = Event::create([
                'title' => $request->title,
                'start' => $request->start,
                'end'   => $request->end ?? $request->start,
                'session_id' => $current_school_session_id
            ]);
            return response()->json($event);

        case 'edit':
            Event::where('id', $request->id)->update([
                'title' => $request->title,
                'start' => $request->start,
                'end'   => $request->end ?? $request->start,
            ]);
            return response()->json(['status' => 'updated']);

        case 'delete':
            Event::where('id', $request->id)->delete();
            return response()->json(['status' => 'deleted']);
    }

    return response()->json(['error' => 'Invalid request'], 400);
}

}

