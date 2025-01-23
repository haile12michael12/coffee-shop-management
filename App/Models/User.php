<?php

// app/models/User.php
class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    public function bookings()
    {
        return $this->hasMany('Booking');
    }

    public function carts()
    {
        return $this->hasMany('Cart');
    }

    public function orders()
    {
        return $this->hasMany('Order');
    }

    public function register($data)
    {
        $user = new User($data);
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->save();
        return $user;
    }

    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function update($id, $data)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}