<?php
namespace App\Console\Commands;

use App\Models\Member;
use App\Models\Applicant;
use Illuminate\Console\Command;

class UpdateMemberApplicantId extends Command
{
    protected $signature = 'update:member-applicant-id';
    protected $description = 'Update applicant_id in members based on matching email';

    public function handle()
    {
        // Get all members
        $members = Member::all();

        // Loop through members and update applicant_id based on matching email
        foreach ($members as $member) {
            $applicant = Applicant::where('email', $member->email)->first();

            if ($applicant) {
                // If a matching applicant is found, update the member's applicant_id
                $member->applicant_id = $applicant->application_id;
                $member->save();
            }
        }

        $this->info('Successfully updated applicant_id in members.');
    }
}
