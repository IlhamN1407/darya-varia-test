<?php
function agama_helper($code)
{

    if ($code == 001) {
        $result = "Islam";
    } else if ($code == 002) {
        $result = "kristen";
    }
    return $result;
}

function jabatan_helper($code)
{
    if ($code == 1) {
        $result = "HRIS SPV";
    } else if ($code == 2) {
        $result = "TR STAFF";
    }
    return $result;
}
