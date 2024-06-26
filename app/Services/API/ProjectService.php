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

        if (empty($this->response)) {
            $projects = Project::all();
            $this->setOk($projects);
        }

        return $this;
    }
}
