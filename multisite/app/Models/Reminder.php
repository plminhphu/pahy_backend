<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
  use HasFactory;

  protected $fillable = [
    'appointment_id',
    'reminder_date',
    'sent',
    'created_at',
    'updated_at'
  ];
}