<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AvtPanicRequest extends Model
{
    use HasHashSlug;

    protected $table = "avt_panic_requests";

    protected $guarded = [];
}
