<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $trainings = Training::where('topic', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $trainings = Training::latest()->paginate($perPage);
        }

        return view('admin.events.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate event_date to ensure it's not a past date
    $request->validate([
        'event_date' => 'required|date|after_or_equal:today',
    ], [
        'event_date.after_or_equal' => 'The event date cannot be in the past.',
    ]);

        $training = new Training();

        $training->topic = $request->topic;
        $training->event_date = $request->event_date;
        $training->venue = $request->venue;
        $training->venue_name = $request->venue_name;

        if (request()->hasFile('certificate_template')) {
            $file = request()->file('certificate_template');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $save = $file->move('uploads/templates', $filename);

            //if file was saved successfully
            if ($save) {
                $training->certificate_template_path = 'uploads/templates/' . $filename;
            } else {
                return redirect()->back()->with('error', 'Error uploading file');
            }

        }

        $training->save();

        return redirect('admin/events')->with('flash_message', 'Training added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $event)
    {

        // Validate event_date to ensure it's not a past date
    $request->validate([
        'event_date' => 'required|date|after_or_equal:today',
    ], [
        'event_date.after_or_equal' => 'The event date cannot be in the past.',
    ]);
        $training = Training::where('id', $event->id)->first();

        //check if the request contains any of the files
        if ($request->hasFile('certificate_template')) {
            //delete the old passport photo
            //deleting the old passport photo
            unlink($training->certificate_template_path);
            $file = request()->file('certificate_template');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/templates', $filename);

            $training->certificate_template_path = 'uploads/templates/' . $filename;
        }

        //update the training using update method
        $training->update($request->all());

        return redirect('admin/events')->with('flash_message', 'Training updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        $training->delete();

        return redirect('admin/events')->with('flash_message', 'Training deleted!');
    }
}
