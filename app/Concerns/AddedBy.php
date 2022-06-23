<?php


namespace App\Concerns;
use App\Models\User;


trait AddedBy
{
    public function addedByUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function getCreatedByAttribute()
    {
        $userName = $this->addedByUser ? $this->addedByUser->full_name : '';
        // "%d-%h-%y %H:%M %p" date-Jan-yyyy 00:00 AM
        $createdAt = $this->created_at->timestamp > 0 ?
            strftime("%d-%h-%y", $this->created_at->timestamp) :
            "0000-00-00 00:00";
        return (object)['name' => $userName, 'date' => $createdAt];
    }
}
