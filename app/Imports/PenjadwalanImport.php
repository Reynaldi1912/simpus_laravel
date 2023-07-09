<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use PhpOffice\PhpSpreadsheet\Shared;
use App\Models\Desa;
use App\Models\Jadwal;

class PenjadwalanImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        $desa = Desa::where('nama_desa', $row['desa'])->first();
        $id_desa = null;

        if ($desa) {
            $id_desa = $desa->id;
        }

        return new Jadwal([
            "upaya_kesehatan" => $row['upaya_kesehatan'],
            "kegiatan" => $row['kegiatan'],
            "tanggal_mulai" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_mulai'])->format('y-m-d'),
            "rincian_pelaksanaan" => $row['rincian_pelaksanaan'],
            "id_desa" => $id_desa, 
            "nama_pelaksana1" => $row['nama_pelaksana1'],
            "nama_pelaksana2" => $row['nama_pelaksana2'],
            "status" => 0
        ]);
    }

    public function rules(): array
    {
        return [
            'upaya_kesehatan' => [
                'required',
                'string',
            ],
            'tanggal_mulai' => [
                'required',
            ],
        ];
    }
}
