<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'description', 'reason', 'user_id', 'leave_type_id', 'leave_date'
    ];

    protected $casts = [
        'leave_date' => 'datetime'
    ];

    public function getLeaveDateWithFormatAttribute()
    {
        if ($this->leave_date) {
            return $this->leave_date->format('Y-m-d');
        }
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }
}
