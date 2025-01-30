<?php

use App\Models\Layanan;
use App\Models\Pasien;
use App\Models\Pekerjaan;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

    if (!function_exists('getNamaDepan')) {
        function getNamaDepan()
        {
            $fullname = Auth::user()->nama;

            $first_name = explode(" ", $fullname);

            return $first_name[0];
        }
    }

    if(!function_exists('getFirstUrl')) {
        function getFirstUrl()
        {
            $current = url()->current();
            $domain = request()->root();

            $url_no_domain = explode($domain, $current);

            $url = explode("/", $url_no_domain[1]);

            if(count($url) == 1) {
                $hasil = $url[0];
            } else {
                $hasil = $url[1];
            }
            return $hasil;
        }
    }

    if (!function_exists('generateNoRM')) {
        function generateNoRM()
        {
            $tahun = date('Y');
            $last_data = Pasien::whereYear('created_at', $tahun)->latest('no_rm')->first();

            if ($last_data) {
                $last_number = (int)substr($last_data->no_rm, -4);
                $new_number = $last_number + 1;
            } else {
                $new_number = 1;
            }

            return 'RM' . $tahun . str_pad($new_number, 4, '0', STR_PAD_LEFT);
        }
    }

    if (!function_exists('generateNoPendaftaran')) {
        function generateNoPendaftaran()
        {
            $date = Carbon::now()->format('dmY');
            $prefix = 'D' . $date;

            $lastRecord = Pendaftaran::where('no_pendaftaran', 'like', $prefix . '%')
                ->orderBy('no_pendaftaran', 'desc')
                ->first();

            if ($lastRecord) {
                $lastCode = $lastRecord->no_pendaftaran;
                $lastNumber = (int)substr($lastCode, strlen($prefix));
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '001';
            }

            return $prefix . $newNumber;
        }
    }

    if (!function_exists('generateKodePekerjaan')) {
        function generateKodePekerjaan()
        {
            $last_data = Pekerjaan::all()->last();

            $prefix = "PKR";

            if($last_data) {
                $kode_last = $last_data->kode_pekerjaan;
    
                $number = (int)str_replace($prefix, "",$kode_last);
    
                $newNumber = str_pad($number + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = "001";
            }
    
            return $prefix . $newNumber;
        }
    }

    if (!function_exists('generateNoAntrian')) {
        function generateNoAntrian($layanan_id, $waktu_kunjungan)
        {
            $tanggal_kunjungan = Carbon::createFromFormat('!d/m/Y', explode(" ", $waktu_kunjungan)[0])->format('Y-m-d');
    
            $layanan = Layanan::find($layanan_id);
    
            if (!$layanan) {
                return null;
            }
    
            $inisial_layanan = strtoupper($layanan->inisial_layanan);
    
            $last_pendaftaran = Pendaftaran::where('layanan_id', $layanan_id)
                ->whereDate('waktu_kunjungan', $tanggal_kunjungan)
                ->orderBy('antrian', 'desc')
                ->first();
    
            if (!$last_pendaftaran) {
                $antrian =  $inisial_layanan . "001";
            } else {
                $last_no_antrian = (int)substr($last_pendaftaran->antrian, strlen($inisial_layanan));
                
                $new_no_antrian = str_pad($last_no_antrian + 1, 3, '0', STR_PAD_LEFT);
    
                $antrian = $inisial_layanan . $new_no_antrian;
            }

            return $antrian;
        }
    }
?>