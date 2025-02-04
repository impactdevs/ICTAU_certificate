{{-- <x-forms.input name="first_name" label="First Name" type="text" id="first_name" placeholder="First Name" value="{{ $attendance->first_name ?? '' }}" />

    <x-forms.input name="last_name" label="Last Name" type="text" id="last_name" placeholder="Last Name" value="{{ $attendance->last_name ?? '' }}" />
    
    <x-forms.input name="email" label="Email" type="email" id="email" placeholder="Email" value="{{ $attendance->email ?? '' }}" />
    
    @if ($errors->has('first_name'))
        <span class="text-danger">{{ $errors->first('first_name') }}</span>
    @endif
    
    @if ($errors->has('last_name'))
        <span class="text-danger">{{ $errors->first('last_name') }}</span>
    @endif
    
    @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
    
    
    
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update Attendance' : 'Create ' }}">
    </div>
     --}}

     <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
    
        <x-forms.input name="first_name" label="First Name" type="text" id="first_name" placeholder="First Name" value="{{ old('first_name', $attendance->first_name ?? '') }}" />
    
        <x-forms.input name="last_name" label="Last Name" type="text" id="last_name" placeholder="Last Name" value="{{ old('last_name', $attendance->last_name ?? '') }}" />
    
        <x-forms.input name="email" label="Email" type="email" id="email" placeholder="Email" value="{{ old('email', $attendance->email ?? '') }}" />
    
        <!-- Error Messages -->
        @if ($errors->has('first_name'))
            <span class="text-danger">{{ $errors->first('first_name') }}</span>
        @endif
    
        @if ($errors->has('last_name'))
            <span class="text-danger">{{ $errors->first('last_name') }}</span>
        @endif
    
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    
        <!-- Submit button -->
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update Attendance' : 'Create' }}">
        </div>
    </form>
    