<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'application',
        'date_of_birth',
        'institution',
        'course',
        'application_type',
        'niche',
        'company_name',
        'company_website',

    ];

    //redifine the primary key to be application_id and string
    protected $primaryKey = 'application_id';

    //string
    protected $keyType = 'string';

    //an applicant has one passport photo
    public function passportPhoto()
    {
        return $this->hasOne(PassportPhoto::class, 'application_id');
    }

    //an applicant has one payment proof
    public function paymentProof()
    {
        return $this->hasOne(PaymentProof::class, 'application_id');
    }

    //an applicant has one student id
    public function studentId()
    {
        return $this->hasOne(StudentId::class, 'application_id');
    }

    //curriculum vitae
    public function curriculumVitae()
    {
        return $this->hasOne(CurriculumVitae::class, 'application_id');
    }

    //applicant can have one or more contact persons
    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class, 'application_id');
    }

    //each company has a logo
    public function companyLogo()
    {
        return $this->hasOne(CompanyLogo::class, 'application_id');
    }
}
