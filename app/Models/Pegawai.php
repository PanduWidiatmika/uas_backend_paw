<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'nip', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'jabatan', 'tanggal_masuk', 'gaji'
    ];

    public function getCreatedAtAttribute()
    {
        if (!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttrbute()
    {
        if (!is_null($this->attributes['updated_at'])) {
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
