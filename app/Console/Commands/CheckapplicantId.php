<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckapplicantId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:checkapplicant-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all members with a non-null email
        $members = DB::table('members')->whereNotNull('email')->get();

        foreach ($members as $member) {
            // Check if email exists in applicants table
            $applicant = DB::table('applicants')->where('email', $member->email)->first();

            if ($applicant) {
            // Check if applicant_id in members table is null
            if (is_null($member->applicant_id)) {
                // Update applicant_id in members table with application_id from applicants table
                DB::table('members')
                ->where('id', $member->id)
                ->update(['applicant_id' => $applicant->application_id]);
                $this->info("Updated member ID {$member->id} with applicant_id {$applicant->application_id}");
            }
            }
        }

        $this->info('done updating');
    }
}
