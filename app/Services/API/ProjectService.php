<?php

namespace App\Services\API;

use App\Services\Service;
use App\Traits\ResponseTrait;
use App\Traits\RulesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Project;
use App\Models\UserAuthToken;

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
        $token = $this->request->input('token', '');
        $category_id = $this->request->input('category_id', '');

        $projects = Project::where('status', 1)->with('user')->orderByDesc('created_at');

        if (empty($this->response)) {
            if(!empty($token)){
                $userAuthToken = UserAuthToken::where('token', $token)->first();
                $projects = $projects->where('user_id', $userAuthToken->user_id);
            }
            if (!empty($category_id)) {
                $projects = $projects->where('category_id', $category_id);
            } 

            $projects = $projects->paginate($count, ['*'], 'page', $page);

            $this->setOk($projects);
        }

        return $this;
    }
}
