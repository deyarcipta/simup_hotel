<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogbookDetail extends Model
{
    protected $table = 'logbook_details';

    protected $fillable = [
        'logbook_id',
        'shift_id',
        'user_id',
        'jumlah_kiloan',
        'harga_kiloan',
        'jumlah_satuan',
        'harga_satuan',
        'jumlah_dry_cleaning',
        'harga_dry_cleaning',
        'total_uang',
        'pendapatan_lain',
    ];

    public function logbook()
    {
        return $this->belongsTo(Logbook::class, 'logbook_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
