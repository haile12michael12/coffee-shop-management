
<?php

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
        return $this->belongsTo('App\User');
    }

    public function create($data)
    {
        return Booking::create($data);
    }

    public function update($id, $data)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($data);
        return $booking;
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
    }

    public function getAllByUserId($userId)
    {
        return Booking::where('user_id', $userId)->get();
    }
}

