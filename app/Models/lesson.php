<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\VarDumper\Dumper;

class lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id'
      ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'lessontags');
    }
}
