<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductReview;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductReviewPolicy
{
    use HandlesAuthorization;

    public function update(User $user, ProductReview $productReview)
    {
        return $user->id == $productReview->user_id;
    }
}
