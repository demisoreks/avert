<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AvtActivity extends Model
{
    use HasHashSlug;

    protected $table = "avt_activities";

    protected $guarded = [];

    public function employee() {
        return $this->belongsTo('App\AccEmployee');
    }
}
