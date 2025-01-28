<?php 

// app/models/Review.php
class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'review',
        'username'
    ];

    public function createReview($data)
    {
        $review = new Review($data);
        $review->save();
        return $review;
    }

    public function updateReview($id, $data)
    {
        $review = Review::find($id);
        $review->update($data);
        return $review;
    }

    public function deleteReview($id)
    {
        $review = Review::find($id);
        $review->delete();
    }

    public function getAllReviews()
    {
        return Review::all();
    }

    public function getReviewsByUsername($username)
    {
        return Review::where('username', $username)->get();
    }
}