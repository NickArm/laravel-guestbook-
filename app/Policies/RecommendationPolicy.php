<?php

namespace App\Policies;

use App\Models\Recommendation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecommendationPolicy
{
    use HandlesAuthorization;

    /**
     * Μπορεί ο χρήστης να δει τη συγκεκριμένη recommendation;
     */
    public function view(User $user, Recommendation $recommendation): bool
    {
        return $recommendation->user_id === $user->id;
    }

    /**
     * Μπορεί ο χρήστης να κάνει edit;
     */
    public function update(User $user, Recommendation $recommendation): bool
    {
        return $recommendation->user_id === $user->id;
    }

    /**
     * Μπορεί ο χρήστης να διαγράψει;
     */
    public function delete(User $user, Recommendation $recommendation): bool
    {
        return $recommendation->user_id === $user->id;
    }
}
