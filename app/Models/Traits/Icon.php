<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;

trait Icon
{

    public function setIconAttribute($value)
    {
        if (isset($this->icon) && Storage::exists($this->icon)) {
            Storage::delete($this->icon);
        }
        if (is_null($value)) {
            $this->attributes['icon'] = null;
            return;
        }
        $this->attributes['icon'] = $value->store('icon');
    }
}
