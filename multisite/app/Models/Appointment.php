<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'customer_id',
        'customer_code',
        'customer_name',
        'customer_phone',
        'customer_address',
        'customer_region',
        'appointment_date',
        'reminder_cycle',
        'note',
        'status',
        'created_at',
        'updated_at'
    ];

    // tạo liên kết với bảng appointment_device để quản lý nhiều thiết bị cho một cuộc hẹn
    public function devices()
    {
        return $this->hasMany(AppointmentDevice::class);
    }
}
