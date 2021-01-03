<?php
use App\Models;
use App\Models\SerialNumber;
// use Auth;

    function getSerialNo($type, $prefix)
    {
        $serial_no = SerialNumber::where('type', $type)->first();
        if(!empty($serial_no)) {
            $serial_no->update(['value'=> $serial_no->value + 1]);
        }
        else{
            $serial_no = SerialNumber::create(['type'=> $type, 'prefix'=> $prefix, 'value'=> 101]);
        }
        return $serial_no;
    } 

?>