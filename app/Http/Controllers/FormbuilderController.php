<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\formBuilder;
use App\Models\formField;
use App\Models\FormResponse;
use Illuminate\Support\Facades\Validator;

class FormbuilderController extends Controller
{
    //
    public function index ()
    {
        $forms = formBuilder::all();
        
        return view('admin.formBuilder.index', compact('forms'));
    }

    //create a form 
    public function create()
    {
        return view ('admin.formBuilder.create');
    }

    //save the form 
    public function store(Request $request, FormBuilder $form)
    {
        //created form fields 
        $formFields = $form->formFields;
        $fieldTypes = FormBuilder::$fieldTypes;

        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
    
        if ($validated && !empty($validated)) {
    
            FormBuilder::create($validated);
    
            // return back()->with('success', 'Form created successfully.');
            return view('admin.formBuilder.show', compact('form', 'formFields','fieldTypes'));
        } else {
    
            return back()->with('error', 'Failed to create the form.');
        }
    }
    
    public function show(Request $request, $id)
    {

        $form = FormBuilder::find($id);
        $formFields = $form->formFields;
        $fieldTypes = FormBuilder::$fieldTypes;
        
    
        if (!$form && $fieldTypes ) {
            return redirect()->route('admin.formBuilder.index')->with('error', 'Form not found.');
        }

        return view('admin.formBuilder.show', compact('form', 'fieldTypes', 'formFields'));
    }

    public function edit( $id)
    {

        $form = FormBuilder::find($id);

        return view('admin.formBuilder.edit', compact ('form'));
    }

    public function update(Request $request, $id)
    {

        $form = FormBuilder::find($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
    
        if ($validated && !empty($validated)) {
    
            $form->name = $validated['name'];
            $form->save();
    
             return back()->with('success', 'Form updated successfully.');
            //return view('admin.formBuilder.show', compact('form', 'formFields','fieldTypes'));
        } else {
    
            return back()->with('error', 'Failed to update the form.');
        }

    }

    public function destroy($id)
    {
        $form = FormBuilder::find($id);

        if (!$form) {
            return redirect()->route('admin.formBuilder.index')->with('error', 'Form not found.');
        }

        try {
            $form->delete();
            return redirect()->back()->with('success', 'Form deleted successfully.');
            
        } catch (\Exception $e) {
            return redirect()-> back()->with('error', 'Failed to delete form.');
           
        }
    }
    public function addFormField(Request $request, $id): RedirectResponse
    {
     
        $usr = auth()->user();
        
        DB::beginTransaction();
    
        try {
            // Find the form builder by ID
            $formbuilder = FormBuilder::find($id);

            // Check if the form builder was found
            if (!$formbuilder) {
                return redirect()->route('admin.formBuilder.index')->with('error', 'Form not found.');
            }

            // Get the names and types from the request
            $names = $request->input('question');
            $types = $request->input('fieldTypes');

            // Validate that names and types are arrays and have the same length
            if (!is_array($names) || !is_array($types) || count($names) !== count($types)) {
                return redirect()->back()->with('error', 'Invalid field data.');
            }

            // Iterate over the names and types and create form fields
            foreach ($names as $index => $name) {
                $type = $types[$index];

                // Create a new form field
                $formField = new FormField();
                $formField->form_id = $formbuilder->id;
                $formField->question = $name;
                $formField->type = $type;
                $formField->save();
            }
            
            DB::commit();

            session()->flash('success', 'Fields added successfully.');
            return redirect()->route('admin.formBuilder.show', $id);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to add fields.');
            return redirect()->back();
        }
    }
    public function viewForm($id)
    {
        // Find the form builder by ID
        $form = FormBuilder::find($id);

        // Check if the form exists
        if ($form) {
            // Check if the form is active
           // if ($form->is_active == 1) {
                // Retrieve the related form fields using the relationship
                $formFields = $form->formFields;

                // Pass the form and its fields to the view
                return view('admin.formBuilder.show_form', compact('formFields', 'id', 'form'));
            // } else {
            //     // If the form is not active, still pass the form to the view
            //     return view('admin.formBuilder.show_form', compact('id', 'form'));
            // }
        } else {
            // Redirect to login with an error if the form is not found
            return redirect()->route('login')->with('error', __('Form not found. Please contact the admin.'));
        }
    }

    public function editFormField($id)
    {
        $form = FormBuilder::find($id);

        return view('admin.formBuilder.edit', compact ('form'));
    }

    public function updateFormField()
    {
        $usr = auth()->user();
        
        DB::beginTransaction();
    
        try {
            // Find the form builder by ID
            $formbuilder = FormBuilder::find($id);

            // Check if the form builder was found
            if (!$formbuilder) {
                return redirect()->route('admin.formBuilder.index')->with('error', 'Form not found.');
            }

            // Get the names and types from the request
            $names = $request->input('question');
            $types = $request->input('fieldTypes');

            // Validate that names and types are arrays and have the same length
            if (!is_array($names) || !is_array($types) || count($names) !== count($types)) {
                return redirect()->back()->with('error', 'Invalid field data.');
            }

            // Iterate over the names and types and create form fields
            foreach ($names as $index => $name) {
                $type = $types[$index];

                // Create a new form field
                $formField = new FormField();
                $formField->form_id = $formbuilder->id;
                $formField->question = $name;
                $formField->type = $type;
                $formField->save();
            }
            
            DB::commit();

            session()->flash('success', 'Fields added successfully.');
            return redirect()->route('admin.formBuilder.show', $id);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to add fields.');
            return redirect()->back();
        }
    }

    public function storeResponse (Request $request, $id): RedirectResponse
    {
        $form = FormBuilder::where('id', 'LIKE', $request->id)->first();

        if(!empty($form))
        {
            $arrFieldResp = [];
            if(!is_null($request->field) && (is_array($request->field) || is_object($request->field))){
                foreach($request->field as $key => $value)
                {
                    $arrFieldResp[FormField::find($key)->name] = (!empty($value)) ? $value : '-';
                }
            } else {
                return redirect()->back()->with('error', __('Request is missing a required field and you can not be forwarded to next page.'));
            }

            // store response
            FormResponse::create(
                [
                    'form_id' => $form->id,
                    'response' => json_encode($arrFieldResp),
                ]
            );

           

            return redirect()->back()->with('success', __('Data submit successfully.'));
        }
        else
        {
            return redirect()->route('login')->with('error', __('Something went wrong.'));
        }
    }

    public function destroyResponse(formBuilder $form)
    {

        $form_id = $form->form->id;

        if (!$form_id) {
            return redirect()->route('admin.formBuilder.index')->with('error', 'Form not found.');
        }

        try {
            $form_id->delete();
            return redirect()->back()->with('success', 'Form created successfully.');
            
        } catch (\Exception $e) {
            return redirect()-> back()->with('error', 'Failed to create the form.');
           
        }

    }


}
