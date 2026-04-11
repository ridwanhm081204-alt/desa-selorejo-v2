<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetAparat extends Model
{
    protected $table = 'widget_aparat';
    protected $fillable = [
        'foto_kades',
        'nama_kades',
        'sambutan',
    ];
}
