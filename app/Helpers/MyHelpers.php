<?php

use App\Models\Pasien;
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
?>