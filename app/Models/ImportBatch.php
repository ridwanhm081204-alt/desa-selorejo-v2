<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportBatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'import_batches';

    protected $fillable = [
        'filename',
        'file_path',
        'total_rows',
        'success_rows',
        'failed_rows',
        'failed_details',
        'uploaded_by',
    ];

    protected $casts = [
        'failed_details' => 'array',
        'total_rows' => 'integer',
        'success_rows' => 'integer',
        'failed_rows' => 'integer',
    ];

    public function dataPenduduk()
    {
        return $table = $this->hasMany(DataPenduduk::class, 'sumber_import_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
