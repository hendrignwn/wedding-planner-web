<?php

namespace App;

class Concept extends BaseModel
{
    const ACARA_LAMARAN = 1;
    const ACARA_PENGAJIAN = 2;
    const ACARA_SIRAMAN = 3;
    const PRE_WEDDING = 4;
    const ACARA_AKAD_NIKAH = 5;
    const ACARA_RESEPSI = 6;
    const BULAN_MADU = 7;
    
    const GROUPING_PENGURUS_PERNIKAHAN = 1;
    const GROUPING_DEKORASI = 2;
    const GROUPING_LOKASI_ACARA = 3;
    const GROUPING_FOTO = 4;
    const GROUPING_VIDEO = 5;
    const GROUPING_BUSANA = 6;
    const GROUPING_AKSESORIS = 7;
    const GROUPING_PENGRIAS_WAJAH = 8;
    const GROUPING_KATERING = 9;
    const GROUPING_UNDANGAN = 10;
    const GROUPING_CINDERA_MATA = 11;
    const GROUPING_SESERAHAN = 12;
    const GROUPING_BULAN_MADU = 13;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'concept';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'order',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    
    protected $with = [
    ];
    
    public function contents()
    {
        return $this->hasMany('\App\Content', 'content_id', 'id');
    }
    
    public static function defaultContentData()
    {
        return [
            // Acara Lamaran
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_PENGURUS_PERNIKAHAN,
                    'name' => 'Pengurus Pernikahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Vendor', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_DEKORASI,
                    'name' => 'Dekorasi',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Dekorator', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Nuansa Warna Bunga', 'status' => self::STATUS_ACTIVE, 'order' => 6],
                    ['name' => 'Nuansa Warna Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 7],
                    ['name' => 'Kain Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 8],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 9, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_LOKASI_ACARA,
                    'name' => 'Lokasi Acara',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Lokasi Acara', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_FOTO,
                    'name' => 'Foto',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_VIDEO,
                    'name' => 'Video',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Video Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_video' => 1],
                    ['name' => 'Tema Video', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_BUSANA,
                    'name' => 'Busana pengantin & keluarga/panitia',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Tema Busana', 'status' => self::STATUS_ACTIVE, 'order' => 4],
                    ['name' => 'Nuansa Warna', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_AKSESORIS,
                    'name' => 'Aksesoris',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Aksesoris', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_PENGRIAS_WAJAH,
                    'name' => 'Pengrias Wajah',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Pengrias Wajah', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_KATERING,
                    'name' => 'Katering',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_UNDANGAN,
                    'name' => 'Undangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Isi Undangan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_SESERAHAN,
                    'name' => 'Seserahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Lokasi', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Tanggal', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_LAMARAN,
                    'grouping' => self::GROUPING_CINDERA_MATA,
                    'name' => 'Kenang-kenangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            
            // acara pengajian
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_PENGURUS_PERNIKAHAN,
                    'name' => 'Pengurus Pernikahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Vendor', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_DEKORASI,
                    'name' => 'Dekorasi',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Dekorator', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Nuansa Warna Bunga', 'status' => self::STATUS_ACTIVE, 'order' => 6],
                    ['name' => 'Nuansa Warna Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 7],
                    ['name' => 'Kain Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 8],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 9, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_LOKASI_ACARA,
                    'name' => 'Lokasi Acara',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Lokasi Acara', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_FOTO,
                    'name' => 'Foto',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_VIDEO,
                    'name' => 'Video',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Video Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_video' => 1],
                    ['name' => 'Tema Video', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_BUSANA,
                    'name' => 'Busana pengantin & keluarga/panitia',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Tema Busana', 'status' => self::STATUS_ACTIVE, 'order' => 4],
                    ['name' => 'Nuansa Warna', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_AKSESORIS,
                    'name' => 'Aksesoris',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Aksesoris', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_PENGRIAS_WAJAH,
                    'name' => 'Pengrias Wajah',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Pengrias Wajah', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_KATERING,
                    'name' => 'Katering',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_UNDANGAN,
                    'name' => 'Undangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Isi Undangan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_PENGAJIAN,
                    'grouping' => self::GROUPING_CINDERA_MATA,
                    'name' => 'Kenang-kenangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            
            //Acara Siraman/Pra Nikah
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_PENGURUS_PERNIKAHAN,
                    'name' => 'Pengurus Pernikahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Vendor', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_DEKORASI,
                    'name' => 'Dekorasi',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Dekorator', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Nuansa Warna Bunga', 'status' => self::STATUS_ACTIVE, 'order' => 6],
                    ['name' => 'Nuansa Warna Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 7],
                    ['name' => 'Kain Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 8],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 9, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_LOKASI_ACARA,
                    'name' => 'Lokasi Acara',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Lokasi Acara', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_FOTO,
                    'name' => 'Foto',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_VIDEO,
                    'name' => 'Video',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Video Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_video' => 1],
                    ['name' => 'Tema Video', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_BUSANA,
                    'name' => 'Busana pengantin & keluarga/panitia',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Tema Busana', 'status' => self::STATUS_ACTIVE, 'order' => 4],
                    ['name' => 'Nuansa Warna', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_AKSESORIS,
                    'name' => 'Aksesoris',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Aksesoris', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_PENGRIAS_WAJAH,
                    'name' => 'Pengrias Wajah',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Pengrias Wajah', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_KATERING,
                    'name' => 'Katering',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_UNDANGAN,
                    'name' => 'Undangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Isi Undangan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_SIRAMAN,
                    'grouping' => self::GROUPING_CINDERA_MATA,
                    'name' => 'Kenang-kenangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            
            //Pre Wedding
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_PENGURUS_PERNIKAHAN,
                    'name' => 'Pengurus Pernikahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Vendor', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_DEKORASI,
                    'name' => 'Dekorasi',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Dekorator', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Nuansa Warna Bunga', 'status' => self::STATUS_ACTIVE, 'order' => 6],
                    ['name' => 'Nuansa Warna Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 7],
                    ['name' => 'Kain Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 8],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 9, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_LOKASI_ACARA,
                    'name' => 'Lokasi Acara',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Lokasi Acara', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_FOTO,
                    'name' => 'Foto',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_VIDEO,
                    'name' => 'Video',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Video Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_video' => 1],
                    ['name' => 'Tema Video', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_BUSANA,
                    'name' => 'Busana pengantin & keluarga/panitia',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Tema Busana', 'status' => self::STATUS_ACTIVE, 'order' => 4],
                    ['name' => 'Nuansa Warna', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_AKSESORIS,
                    'name' => 'Aksesoris',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Aksesoris', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_PENGRIAS_WAJAH,
                    'name' => 'Pengrias Wajah',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Pengrias Wajah', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::PRE_WEDDING,
                    'grouping' => self::GROUPING_KATERING,
                    'name' => 'Makanan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Nama Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            
            //Acara Akad Nikah
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_PENGURUS_PERNIKAHAN,
                    'name' => 'Pengurus Pernikahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Vendor', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_DEKORASI,
                    'name' => 'Dekorasi',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Dekorator', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Nuansa Warna Bunga', 'status' => self::STATUS_ACTIVE, 'order' => 6],
                    ['name' => 'Nuansa Warna Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 7],
                    ['name' => 'Kain Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 8],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 9, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_LOKASI_ACARA,
                    'name' => 'Lokasi Acara',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Lokasi Acara', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_FOTO,
                    'name' => 'Foto',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_VIDEO,
                    'name' => 'Video',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Video Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_video' => 1],
                    ['name' => 'Tema Video', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_BUSANA,
                    'name' => 'Busana pengantin & keluarga/panitia',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Tema Busana', 'status' => self::STATUS_ACTIVE, 'order' => 4],
                    ['name' => 'Nuansa Warna', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_AKSESORIS,
                    'name' => 'Aksesoris',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Aksesoris', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_PENGRIAS_WAJAH,
                    'name' => 'Pengrias Wajah',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Pengrias Wajah', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_KATERING,
                    'name' => 'Makanan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Nama Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_UNDANGAN,
                    'name' => 'Undangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Isi Undangan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_AKAD_NIKAH,
                    'grouping' => self::GROUPING_CINDERA_MATA,
                    'name' => 'Kenang-kenangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            
            //Acara Resepsi
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_PENGURUS_PERNIKAHAN,
                    'name' => 'Pengurus Pernikahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Vendor', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_DEKORASI,
                    'name' => 'Dekorasi',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama Dekorator', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Nuansa Warna Bunga', 'status' => self::STATUS_ACTIVE, 'order' => 6],
                    ['name' => 'Nuansa Warna Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 7],
                    ['name' => 'Kain Dekorasi', 'status' => self::STATUS_ACTIVE, 'order' => 8],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 9, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_LOKASI_ACARA,
                    'name' => 'Lokasi Acara',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Lokasi Acara', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_FOTO,
                    'name' => 'Foto',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_VIDEO,
                    'name' => 'Video',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Video Acuan Pernikahan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_video' => 1],
                    ['name' => 'Tema Video', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_BUSANA,
                    'name' => 'Busana pengantin & keluarga/panitia',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Tema Busana', 'status' => self::STATUS_ACTIVE, 'order' => 4],
                    ['name' => 'Nuansa Warna', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_AKSESORIS,
                    'name' => 'Aksesoris',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Aksesoris', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_PENGRIAS_WAJAH,
                    'name' => 'Pengrias Wajah',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Pengrias Wajah', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Tema', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_KATERING,
                    'name' => 'Makanan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Nama Makanan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_UNDANGAN,
                    'name' => 'Undangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Contoh', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Isi Undangan', 'status' => self::STATUS_ACTIVE, 'order' => 5],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 6, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_SESERAHAN,
                    'name' => 'Seserahan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Lokasi', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Tanggal', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::ACARA_RESEPSI,
                    'grouping' => self::GROUPING_CINDERA_MATA,
                    'name' => 'Kenang-kenangan',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Nama', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Kontak', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Alamat', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
            [
                'content' => [
                    'concept_id' => self::BULAN_MADU,
                    'grouping' => self::GROUPING_BULAN_MADU,
                    'name' => 'Bulan Madu',
                    'description' => null,
                    'status' => self::STATUS_ACTIVE,
                    'order' => 0,
                ],
                'content_details' => [
                    ['name' => 'Lokasi', 'status' => self::STATUS_ACTIVE, 'order' => 0],
                    ['name' => 'Tanggal', 'status' => self::STATUS_ACTIVE, 'order' => 1],
                    ['name' => 'Hotel', 'status' => self::STATUS_ACTIVE, 'order' => 2],
                    ['name' => 'Biaya', 'status' => self::STATUS_ACTIVE, 'order' => 3, 'is_cost' => 1],
                    ['name' => 'Foto Lokasi', 'status' => self::STATUS_ACTIVE, 'order' => 4, 'is_link' => 1, 'is_photo' => 1],
                    ['name' => 'Catatan', 'status' => self::STATUS_ACTIVE, 'order' => 5, 'is_link' => 1, 'is_noted' => 1],
                ]
            ],
        ];
    }
}
