<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'destination_id',
        'tour_package_id',
        'travel_date',
        'num_travelers',
        'budget',
        'message',
        'assigned_admin_id',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'budget' => 'decimal:2',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }

    public function assignedAdmin()
    {
        return $this->belongsTo(Admin::class, 'assigned_admin_id');
    }

    public function notes()
    {
        return $this->hasMany(EnquiryNote::class)->orderBy('created_at', 'desc');
    }
}
