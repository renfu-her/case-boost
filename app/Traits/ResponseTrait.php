<?php

namespace App\Traits;

use App\Services\Service;
use Exception;
use Nette\Schema\Expect;

trait ResponseTrait
{
    private $response;
    private $param_array;
    public function getResponse(): mixed
    {
        return $this->response;
    }

    public function setResponse(mixed $response): self
    {
        $this->response = $response;
        return $this;
    }
    
    public function setOk($data = null, $page_info = null): void
    {
        ($data == null) && $this->setResponse((new Service)->response(200, 'OK'));
        ((!empty($data)) && $page_info == null) && $this->setResponse((new Service)->response(200, 'ok', $data));
        (!empty($page_info)) && $this->setResponse((new Service)->response_paginate(200, 'ok', $data, $page_info));
    }
    /**setErr($code, $message,$data=[])
     * 設定回傳錯誤訊息
     */
    public function setErr($code, $message, $data = []): void
    {
        $this->setResponse((new Service)->response(400, $message, $data));
    }

    public function paramQueryToArray($param)
    {
        $this->param_array = json_decode($param['data'], true);
        ($this->param_array === null) && $this->setErr(400, 'data', 'json 無法解析。');
        return $this;
    }

    private function getPageInfo($data)
    {
        //總頁數
        $total = $data->lastPage();
        //總筆數    
        $countTotal = $data->total();
        //當前頁次          
        $page = $data->currentPage();
        return [
            "total" => $total,              // 總頁數
            "countTotal" => $countTotal,    // 總筆數
            "page" => $page,                // 頁次
        ];
    }
}
