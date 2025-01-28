<?php
class BookingController extends Controller
{
    public function create()
    {
        $this->view('bookings/create');
    }

    public function store()
    {
        $booking = (new Booking())->create($_POST);
        redirect('/bookings');
    }

    public function edit($id)
    {
        $booking = Booking::find($id);
        $this->view('bookings/edit', compact('booking'));
    }

    public function update($id)
    {
        $booking = (new Booking())->update($id, $_POST);
        redirect('/bookings');
    }

    public function destroy($id)
    {
        (new Booking())->delete($id);
        redirect('/bookings');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $bookings = (new Booking())->getAllByUserId($userId);
        $this->view('bookings/index', compact('bookings'));
    }
}