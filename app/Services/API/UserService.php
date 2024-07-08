<?php

namespace App\Services\API;

use App\Services\Service;
use App\Traits\ResponseTrait;
use App\Traits\RulesTrait;

use App\Models\User;

class UserService extends Service
{
    use ResponseTrait;
    use RulesTrait;

    private $response;
    private $request;
    private $changeErrorName, $dataId;

    private $rules = [
        'user' => [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]
    ];

    public function __construct($request, $dataId = null)
    {
        $this->dataId = $dataId;
        $this->request = $request;
    }

    public function register()
    {
        if (empty($this->response)) {
            $data = $this->request->all();
            $user = User::create($data);
            $this->setOk($user);
        }

        return $this;
    }
}
