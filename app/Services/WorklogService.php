<?php

namespace App\Services;

use App\Constants\Messages;
use App\Exceptions\Worklogs\WorklogNotCreatedException;
use App\Exceptions\Worklogs\WorklogNotFoundException;
use App\Models\Worklog;
use Illuminate\Pagination\LengthAwarePaginator;

class WorklogService
{
    public function __construct(
        private Worklog $worklog
    ){}

    public function getLoggedInUserWorklogs(): LengthAwarePaginator
    {
        $worklogs = auth()->user()->worklogs()->paginate(5);
        throw_if(!$worklogs,
            WorklogNotFoundException::class,
            Messages::ERROR_FETCH_WORKLOG
        );
        return $worklogs;
    }

    public function create(array $validatedWorklogData)
    {
        $worklog = $this->worklog->create($validatedWorklogData);
        throw_if(!$worklog,
            WorklogNotCreatedException::class,
            Messages::ERROR_CREATE_WORKLOG
        );
        return $worklog;
    }
}