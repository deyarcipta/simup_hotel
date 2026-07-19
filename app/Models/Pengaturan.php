<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_aplikasi',
        'nama_sekolah',
        'alamat',
        'telepon',
        'email',
        'logo',
        'shu_pembagian',
        'jumlah_shift',
    ];

    protected $casts = [
        'shu_pembagian' => 'array',
    ];

    public function getShuPembagianOrDefault()
    {
        return $this->shu_pembagian ?? [
            ['penerima' => 'Jurusan Perhotelan', 'persentase' => 40],
            ['penerima' => 'Unit Produksi',      'persentase' => 30],
            ['penerima' => 'Sekolah',            'persentase' => 20],
            ['penerima' => 'Tabungan Cadangan',  'persentase' => 10],
        ];
    }

    public function getShiftSchedules()
    {
        $jumlahShift = $this->jumlah_shift ?? 2;
        
        if ($jumlahShift == 1) {
            return [
                1 => [
                    'nama' => 'Shift 1 Pagi',
                    'mulai' => '07:00',
                    'selesai' => '15:00',
                    'deskripsi' => 'Sedang Berjalan - Jam Tutup UP: 15.00'
                ]
            ];
        } elseif ($jumlahShift == 2) {
            return [
                1 => [
                    'nama' => 'Shift 1 Pagi',
                    'mulai' => '07:00',
                    'selesai' => '11:00',
                    'deskripsi' => 'Sedang Berjalan - Batas Akhir Jam 11.00'
                ],
                2 => [
                    'nama' => 'Shift 2 Siang',
                    'mulai' => '11:00',
                    'selesai' => '15:00',
                    'deskripsi' => 'Sedang Berjalan - Jam Tutup UP: 15.00'
                ]
            ];
        } else { // 3 shifts
            return [
                1 => [
                    'nama' => 'Shift 1 Pagi',
                    'mulai' => '07:00',
                    'selesai' => '09:30',
                    'deskripsi' => 'Sedang Berjalan - Batas Akhir Jam 09.30'
                ],
                2 => [
                    'nama' => 'Shift 2 Siang',
                    'mulai' => '09:30',
                    'selesai' => '12:00',
                    'deskripsi' => 'Sedang Berjalan - Batas Akhir Jam 12.00'
                ],
                3 => [
                    'nama' => 'Shift 3 Malam',
                    'mulai' => '12:00',
                    'selesai' => '15:00',
                    'deskripsi' => 'Sedang Berjalan - Jam Tutup UP: 15.00'
                ]
            ];
        }
    }
}
