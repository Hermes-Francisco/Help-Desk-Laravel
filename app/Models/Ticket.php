<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'user_id',
        'created_at'
    ];

    protected $with = ['responsible', 'actions'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responsible()
    {
        return $this->belongsTo(User::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['status'] ?? false, fn($query, $status) =>
            $query->where(fn($query)=>
                $query->where('status', $status)
            )
        );

        $query->when($filters['responsible'] ?? false, fn($query, $responsible) =>
            $query->where(function() use($query, $responsible) {
                if($responsible == 'none')$responsible = null;
                $query->where('responsible_id', $responsible);
            })
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->where(function() use($query, $author) {
               // if($author == 'none')$author = null;
                $query->where('user_id', $author);
            })
        );
    }

}
