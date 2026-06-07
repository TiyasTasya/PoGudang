<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_pr',
        'tanggal_pr',
        'user_id',
        'project_id',
        'barang_id',
        'qty_pesan',
        'pajak_persen',
        'total_harga',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pr' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
