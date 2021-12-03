<?php

namespace App\Services;

use App\Constants\Messages;
use App\Exceptions\Worklogs\UnauthorizedActionException;
use App\Exceptions\Worklogs\WorklogNotCreatedException;
use App\Exceptions\Worklogs\WorklogNotDeletedException;
use App\Exceptions\Worklogs\WorklogNotFoundException;
use App\Exceptions\Worklogs\WorklogNotUpdatedException;
use App\Models\Worklog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

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

    public function get(int $worklogId): Worklog
    {
        $worklog = $this->worklog->findOrFail($worklogId);
        throw_if(auth()->user()->cannot('view', $worklog),
            UnauthorizedActionException::class,
            Messages::ERROR_UNAUTHORIZED_ACTION_WORKLOG
        );
        return $worklog;
    }

    public function all():Collection
    {
        $worklogs = $this->worklog->with('user.department')->get();
        throw_if(!$worklogs,
            WorklogNotFoundException::class,
            Messages::ERROR_FETCH_WORKLOG
        );
        return $worklogs;
    }

    public function update(array $validatedWorklogData, int $worklogId): Worklog
    {
        $worklog = $this->get($worklogId);
        if(!auth()->user()->is_admin){
            throw_if(auth()->user()->cannot('update', $worklog),
                UnauthorizedActionException::class,
                Messages::ERROR_UNAUTHORIZED_ACTION_WORKLOG
            );
            throw_if(!$worklog->created_at->isToday(),
                WorklogNotUpdatedException::class,
                Messages::ERROR_UPDATE_WORKLOG_ON_DIFFERENT_DATE
            );
        }
        throw_if(!$worklog->update($validatedWorklogData),
            WorklogNotUpdatedException::class,
            Messages::ERROR_UPDATE_WORKLOG
        );
        return $worklog;
    }

    public function delete(int $worklogId)
    {
        $worklog = $this->get($worklogId);
        throw_if(!$worklog->delete(),
            WorklogNotDeletedException::class,
            Messages::ERROR_UPDATE_WORKLOG
        );
    }
}
