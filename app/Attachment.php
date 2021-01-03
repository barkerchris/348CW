<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attachmentable_type', 'attachmentable_id'
    ];
    
    public function attachmentable()
    {
        return $this->morphTo();
    }

    
}
