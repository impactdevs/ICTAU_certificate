<div>
    @if ($application_type == 'student' || $application_type == 'professional')
        {{-- reason for rejection --}}
        <p>Dear {{ $first_name }}</p>

        <p>Your application has been reviewed and the submitted bio-data information rejected to join the ICTAU
            community as
            a {{ $application_type }}.</p>

        {{-- reason for rejection --}}
        <p>Reason for rejection:</p>

        <p>{!! $reason !!}</p>
        {{-- reason for rejection --}}

        {{-- update the bio-data info from this link --}}
        <p>Kindly update your bio-data information from the link below and resubmit your application.</p>
        <a href="{{ $update_link }}">Update Bio-data</a>
        {{-- update the bio-data info from this link --}}
        <pre>
        Nkurunungi Gideon

        Chief Executive Officer
        ICT Association of Uganda
    <pre>

</div>
