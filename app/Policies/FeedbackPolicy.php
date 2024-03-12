<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FeedbackPolicy
{

    public function update(User $user, Feedback $feedback): bool
    {
        //
        return $user->id === $feedback->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Feedback $feedback): bool
    {
        return $user->id === $feedback->user_id;
    }


}
