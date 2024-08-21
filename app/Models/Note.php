<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'title',
            'description',
            'created_at',
            'updated_at',
        ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'note_tags');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
