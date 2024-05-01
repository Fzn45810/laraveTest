<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'meeting_subject',
        'meeting_date',
        'meeting_time',
        'attendee_one',
        'attendee_two',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
