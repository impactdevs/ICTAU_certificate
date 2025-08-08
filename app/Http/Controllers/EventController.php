<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $events = Event::where('topic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $events = Event::latest()->paginate($perPage);
        }
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $event = new Event();

        $event->topic = $request->topic;
        $event->event_date = $request->event_date;
        $event->venue = $request->venue;
        $event->venue_name = $request->venue_name;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;

        if (request()->hasFile('certificate_template')) {
            $file = request()->file('certificate_template');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $save = $file->move('uploads/templates', $filename);

            //if file was saved successfully
            if ($save) {
                $event->certificate_template_path = 'uploads/templates/' . $filename;
            } else {
                return redirect()->back()->with('error', 'Error uploading file');
            }
        }

        $event->save();

        return redirect('admin/events')->with('flash_message', 'Event added!');
    }



    public function show($event_id)
    {
        $event = Event::with('attendances')->findOrFail($event_id);
        return view('admin.events.show', compact('event'));
    }

    public function edit($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event = Event::where('event_id', $event->event_id)->first();

        //check if the request contains any of the files
        if ($request->hasFile('certificate_template')) {
            //delete the old passport photo
            //deleting the old passport photo
            unlink($event->certificate_template_path);
            $file = request()->file('certificate_template');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/templates', $filename);

            $event->certificate_template_path = 'uploads/templates/' . $filename;
        }

        //update the event using update method
        $event->update($request->all());

        return redirect('admin/events')->with('flash_message', 'Event updated!');
    }


    public function showAttendance(Event $event)
    {
        $attendances = DB::table('attendances')
            ->where('event_id', $event->event_id)  // Use $event->id instead of $event->event_id
            ->paginate(10);

        return view('admin.events.attendance', compact('event', 'attendances'));
    }

    public function destroy($event_id)
    {

        $event = Event::findOrFail($event_id);
        $attendances = DB::table('attendances')
            ->where('event_id', $event->event_id)->count();
        if ($attendances > 0) {
            return redirect()->back()->with('error', 'Cannot delete event with existing attendances.');
        }
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
