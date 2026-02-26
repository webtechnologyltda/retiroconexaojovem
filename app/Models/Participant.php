<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'full_name',
        'birth_date',
        'sex',
        'cpf',
        'community',
        'shirt_size_id',
        'custom_shirt_size',
        'referral_source_id',
        'photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function shirtSize()
    {
        return $this->belongsTo(ShirtSize::class);
    }

    public function referralSource()
    {
        return $this->belongsTo(ReferralSource::class);
    }


    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function guardians()
    {
        return $this->hasMany(Guardian::class);
    }

    public function healthProfile()
    {
        return $this->hasOne(ParticipantHealthProfile::class);
    }

    public function consent()
    {
        return $this->hasOne(Consent::class);
    }
}
