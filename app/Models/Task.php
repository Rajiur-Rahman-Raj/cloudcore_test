<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'details',
        'due_date',
        'status',
    ];

    public function getStatusBadgeAttribute()
    {
        $statusBadges = [
            0 => '<span class="badge rounded-pill bg-warning text-white">' . __('Pending') . '</span>',
            1 => '<span class="badge rounded-pill bg-primary text-white">' . __('In Progress') . '</span>',
            2 => '<span class="badge rounded-pill bg-success text-white">' . __('Completed') . '</span>',
        ];

        return $statusBadges[$this->status] ?? '<span class="badge rounded-pill bg-secondary text-white">' . __('Unknown') . '</span>';
    }
}
