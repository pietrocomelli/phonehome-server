<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;

    protected $table = 'hardware_types_nethsecurity';

    protected $fillable = [
        'product_name',
        'manufacturer',
        'processor',
        'vga_controller',
        'usb_controller',
        'pci_bridge',
        'stata_controller',
        'communication_controller',
        'scsi_controller',
        'ethernet',
    ];
}