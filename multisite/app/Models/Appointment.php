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
        'device_id',
        'device_code',
        'device_name',
        'device_model',
        'device_imei',
        'appointment_date', //2025-09-04T20:49
        'reminder_cycle',
        'note',
        'status',
        'created_at',
        'updated_at'
    ];
    // Tạo sql cấu trúc bảng này
    // $sql = "CREATE TABLE appointments (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     code VARCHAR(20) UNIQUE,
    //     user_id INT,
    //     customer_id INT,
    //     customer_code VARCHAR(20),
    //     customer_name VARCHAR(100),
    //     customer_phone VARCHAR(15),
    //     customer_address VARCHAR(255),
    //     customer_region VARCHAR(50),
    //     device_id INT,
    //     device_code VARCHAR(20),
    //     device_name VARCHAR(100),
    //     device_model VARCHAR(50),
    //     device_imei VARCHAR(50),
    //     appointment_date DATETIME,
    //     reminder_cycle INT,
    //     note TEXT,
    //     status VARCHAR(20) DEFAULT 'pending',
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    // )";
    // // và bảng để lưu các lịch đã nhắc nhỏ
    // $sql_reminders = "CREATE TABLE reminders (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     appointment_id INT,
    //     reminder_date DATETIME,
    //     sent BOOLEAN DEFAULT FALSE,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    //     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //     FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE
    // )";

}
