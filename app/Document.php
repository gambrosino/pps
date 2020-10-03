<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function revision()
    {
        return $this->belongsTo(Revision::class);
    }

    public function customUpdate($status)
    {
        $this->update($status);

        $this->revision->update([ 'status' => $status['status'] ]);

        $this->revision->professionalPractice->checkTotalHours();
    }
}
