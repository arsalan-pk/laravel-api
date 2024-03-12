<?php

namespace App\Models;

// use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'feedbacks';
    protected $fillable = [
        'title','description','category','user_id','product_id'
    ];

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhereHas('user', function (Builder $query) use ($search) {
                          $query->where('name', 'like', '%' . $search . '%');
                      });
            });
        }
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
