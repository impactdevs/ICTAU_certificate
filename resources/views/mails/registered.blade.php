<div>
    @if ($application_type == 'student' || $application_type == 'professional')
        {{-- reason for rejection --}}
        <p>Dear {{ $first_name }}</p>

        <p>thank you for expressing interest as a <strong>{{ $application_type }}</strong> to join ICTAU.</p>

        {{-- update the bio-data info from this link --}}
        <p>Kindly update your bio-data information from the link below and submit your application.</p>
        <a href="{{ $update_link }}">Update Bio-data</a>
        {{-- update the bio-data info from this link --}}
        <pre>
        Nkurunungi Gideon

        Chief Executive Officer
        ICT Association of Uganda
    <pre>
@elseif ($application_type == 'company')
{{-- reason for rejection --}}
                {{-- reason for rejection --}}
                <p>Dear {{ $first_name }}</p>

                <p>thank you for expressing interest as a <strong>{{ $application_type }}</strong> to join ICTAU.</p>

                {{-- update the bio-data info from this link --}}
                <p>Kindly update your bio-data information from the link below and submit your application.</p>
                <a href="{{ $update_link }}">Update Bio-data</a>
                {{-- update the bio-data info from this link --}}
                <pre>
                Nkurunungi Gideon

                Chief Executive Officer
                ICT Association of Uganda
            <pre>
@endif

</div>
