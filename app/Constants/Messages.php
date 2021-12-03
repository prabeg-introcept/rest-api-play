<?php


namespace App\Constants;


class Messages
{
    const ERROR_FETCH_WORKLOG = 'Error while fetching worklog';
    const ERROR_CREATE_WORKLOG = 'Error while creating worklog';
    const ERROR_UPDATE_WORKLOG = 'Error while update worklog';
    const ERROR_UPDATE_WORKLOG_ON_DIFFERENT_DATE = 'Worklog can only be updated on the date they are created';
    const ERROR_DELETE_WORKLOG = 'Error while deleting worklog';
    const ERROR_UNAUTHORIZED_ACTION_WORKLOG = 'Only the owner of the worklog or admin is authorized to perform the action';
    const ERROR_UPLOAD_USER_IMAGE = 'Failed to upload user image';
    const ERROR_FETCH_FEEDBACK = 'Error while fetching feedback(s)';
    const ERROR_CREATE_FEEDBACK = 'Error while creating feedback';
    const ERROR_UPDATE_FEEDBACK = 'Error while updating feedback';
    const ERROR_DELETE_FEEDBACK = 'Error while deleting feedback';
}
