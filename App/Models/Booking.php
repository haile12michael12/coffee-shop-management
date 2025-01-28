<?php
namespace App\Models;

use System\Model;
// app/models/Booking.php
class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'first_name',
        'last_name',
        'date',
        'time',
        'phone',
        'message',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function create($data)
    {
        $booking = new Booking($data);
        $booking->save();
        return $booking;
    }

    public function update($id, $data)
    {
        $booking = Booking::find($id);
        $booking->update($data);
        return $booking;
    }

    public function delete($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
    }

    public function getAllByUserId($userId)
    {
        return Booking::where('user_id', $userId)->get();
    }
}