<?php
// app/controllers/ReviewController.php
class ReviewController extends Controller
{
    public function create()
    {
        $this->view('reviews/create');
    }

    public function store()
    {
        $review = (new Review())->createReview($_POST);
        redirect('/reviews');
    }

    public function edit($id)
    {
        $review = Review::find($id);
        $this->view('reviews/edit', compact('review'));
    }

    public function update($id)
    {
        $review = (new Review())->updateReview($id, $_POST);
        redirect('/reviews');
    }

    public function destroy($id)
    {
        (new Review())->deleteReview($id);
        redirect('/reviews');
    }

    public function index()
    {
        $reviews = (new Review())->getAllReviews();
        $this->view('reviews/index', compact('reviews'));
    }

    public function userReviews($username)
    {
        $reviews = (new Review())->getReviewsByUsername($username);
        $this->view('reviews/user', compact('reviews', 'username'));
    }
}