<?php

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
?>