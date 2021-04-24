<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'author_id'
    ];

    /**
     * The attributes that should be cast to datetime.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'creation_date',
    ];

    public function getCreationDateAttribute()
    {
        return $this->created_at;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'author_id');
    }
}
