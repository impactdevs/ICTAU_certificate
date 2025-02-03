<x-forms.input name="topic" label="Event Topic" type="text" id="topic" placeholder="Event Topic" value="{{ $event->topic ?? '' }}" />

    <x-forms.input name="event_date" label="Event Date" type="date" id="event_date" value="{{ $event->event_date ?? '' }}" />


<!-- Error Message for Event Date -->
@if ($errors->has('event_date'))
    <span class="text-danger">{{ $errors->first('event_date') }}</span>
@endif

    {{-- Online or physical checkboxes --}}
    <div class="form-group">
        <label for="venue" class="control-label">{{ 'Venue' }}</label>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="venue" id="online" value="online"
                {{ (isset($event->venue) && $event->venue == 'online') ? 'checked' : (!isset($event->venue) ? 'checked' : '') }}>
            <label class="form-check-label" for="online">
                Online
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="venue" id="physical" value="physical"
                {{ (isset($event->venue) && $event->venue == 'physical') ? 'checked' : '' }}>
            <label class="form-check-label" for="physical">
                Physical
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="venue" id="hybrid" value="hybrid"
                {{ (isset($event->venue) && $event->venue == 'hybrid') ? 'checked' : '' }}>
            <label class="form-check-label" for="hybrid">
                Hybrid
            </label>
        </div>
    </div>

    <div id="venue-details" class="form-group" style="display: none;">
        <x-forms.input name="venue_name" label="Venue" type="text" id="venue_name"
            placeholder="Enter Venue Details" value="{{ $event->venue_name ?? '' }}" />
    </div>

    <div class="col-12 w-25 h-25">
        <x-forms.upload name="certificate_template" label="Certificate Template" id="certificate_template"
            value="{{ $event->certificate_template_path ?? '' }}" />
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const physicalRadio = document.getElementById('physical');
            const venueDetails = document.getElementById('venue-details');

            function toggleVenueDetails() {
                if (physicalRadio.checked) {
                    venueDetails.style.display = 'block';
                } else {
                    venueDetails.style.display = 'none';
                }
            }

            const radioButtons = document.querySelectorAll('input[name="venue"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', toggleVenueDetails);
            });

            // Initial check
            toggleVenueDetails();
        });
    </script>
