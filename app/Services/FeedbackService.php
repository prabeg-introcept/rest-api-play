<?php


namespace App\Services;


use App\Constants\Messages;
use App\Exceptions\Feedbacks\FeedbackNotDeletedException;
use App\Exceptions\Feedbacks\FeedbackNotFoundException;
use App\Exceptions\Feedbacks\FeedbackNotUpdatedException;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Collection;

class FeedbackService
{
    public function __construct(
        private Feedback $feedback
    )
    {
    }

    public function allFor(int $worklogId): Collection
    {
        $feedbacks = $this->feedback->with('worklog')->where('worklog_id', $worklogId)->get();
        throw_if(!$feedbacks,
            FeedbackNotFoundException::class,
            Messages::ERROR_FETCH_FEEDBACK
        );
        return $feedbacks;
    }

    public function create(array $validatedFeedbackData): Feedback
    {
        $feedback = $this->feedback->create($validatedFeedbackData);
        throw_if(!$feedback,
            FeedbackNotCreatedException::class,
            Messages::ERROR_CREATE_FEEDBACK
        );
        return $feedback;
    }

    public function get(int $feedbackId): Feedback
    {
        $feedback = $this->feedback->with(['worklog'])->findOrFail($feedbackId);
        throw_if(!$feedback,
            FeedbackNotFoundException::class,
            Messages::ERROR_FETCH_FEEDBACK
        );
        return $feedback;
    }

    public function update(array $validatedFeedbackData, int $feedbackId): Feedback
    {
        $feedback = $this->get($feedbackId);
        throw_if(!$feedback->update($validatedFeedbackData),
            FeedbackNotUpdatedException::class,
            Messages::ERROR_UPDATE_FEEDBACK
        );
        return $feedback;
    }

    public function delete(int $feedbackId)
    {
        $feedback = $this->get($feedbackId);
        throw_if(!$feedback->delete(),
            FeedbackNotDeletedException::class,
            Messages::ERROR_DELETE_FEEDBACK
        );
    }
}
