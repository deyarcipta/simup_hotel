<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi', 
        'tanggal', 
        'nama_pembeli', 
        'jenis_pelanggan', 
        'nomor_kamar', 
        'nomor_wa', 
        'status_laundry', 
        'status_pembayaran', 
        'tanggal_selesai', 
        'total', 
        'user_id'
    ];
    protected $casts = [
        'tanggal' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function details() {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getWaUrl()
    {
        if (empty($this->nomor_wa)) {
            return null;
        }

        $phone = $this->nomor_wa;
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $detailText = "";
        foreach ($this->details as $d) {
            $detailText .= "- " . $d->produkJasa->nama . " (" . (float)$d->jumlah . " x Rp " . number_format($d->harga, 0, ',', '.') . ") = Rp " . number_format($d->subtotal, 0, ',', '.') . "\n";
        }

        $estimasi = "-";
        if ($this->tanggal_selesai) {
            $diff = $this->created_at->diffInDays($this->tanggal_selesai);
            $estimasi = $diff . ' Hari (' . \Carbon\Carbon::parse($this->tanggal_selesai)->format('d M Y') . ')';
        }

        $statusBayar = $this->status_pembayaran === 'lunas' ? 'Lunas' : 'Belum Lunas';
        $namaAplikasi = \App\Models\Pengaturan::first()->nama_aplikasi ?? config('app.name');

        $message = "Kepada Yth. " . $this->nama_pembeli . ",\n\n"
                 . "Berikut kami sampaikan transaksi Anda pada " . $namaAplikasi . " dengan rincian sebagai berikut:\n\n"
                 . "No. Trans: " . $this->kode_transaksi . "\n"
                 . "Tanggal: " . $this->created_at->format('d-m-Y H:i:s') . "\n"
                 . "Nama: " . $this->nama_pembeli . "\n"
                 . "No. Hp: " . $this->nomor_wa . "\n"
                 . "Estimasi: " . $estimasi . "\n"
                 . "Status Bayar: " . $statusBayar . "\n\n"
                 . "Detail:\n" . $detailText . "\n"
                 . "Total Bayar: Rp " . number_format($this->total, 0, ',', '.') . "\n\n"
                 . "Kasir: " . ($this->user->name ?? 'Operator') . "\n\n"
                 . "Pesan ini adalah bukti transaksi Anda.\n\n"
                 . "powered by " . $namaAplikasi;

        return "https://api.whatsapp.com/send?phone=" . $phone . "&text=" . rawurlencode($message);
    }

    public function getWaSelesaiUrl()
    {
        if (empty($this->nomor_wa)) {
            return null;
        }

        $phone = $this->nomor_wa;
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $namaAplikasi = \App\Models\Pengaturan::first()->nama_aplikasi ?? config('app.name');
        
        $message = "Kepada Yth. " . $this->nama_pembeli . ",\n\n"
                 . "Laundry Anda telah selesai dan sudah bisa diambil.\n"
                 . "Terima Kasih. 🙏\n\n"
                 . "Mohon segera lakukan pembayaran via Tf /Qris ( apabila sudah lunas mohon abaikan )\n\n"
                 . "No. Transaksi: " . $this->kode_transaksi . "\n"
                 . "Total Tagihan: Rp " . number_format($this->total, 0, ',', '.') . "\n"
                 . "Status Pembayaran: " . ($this->status_pembayaran === 'lunas' ? 'Lunas' : 'Belum Lunas') . "\n\n"
                 . "powered by " . $namaAplikasi;

        return "https://api.whatsapp.com/send?phone=" . $phone . "&text=" . rawurlencode($message);
    }
}