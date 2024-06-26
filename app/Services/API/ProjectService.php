<?php

namespace App\Services\API;

use App\Services\Service;
use App\Traits\ResponseTrait;
use App\Traits\RulesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Project;

class ProjectService extends Service
{

    use ResponseTrait;
    use RulesTrait;

    private $response;
    private $request;
    private $changeErrorName, $dataId;

    public function __construct($request, $dataId = null)
    {
        $this->dataId = $dataId;
        $this->request = $request;
    }

    public function index(): mixed
    {

        $count = $this->request->input('count', 10);
        $page = $this->request->input('page', 1);

        if (empty($this->response)) {
            $projects = Project::with('user')->paginate($count, ['*'], 'page', $page);
            $this->setOk($projects);
        }

        return $this;
    }
}
