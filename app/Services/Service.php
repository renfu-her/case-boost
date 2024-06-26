<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Service
{
    // use Date,CallFirmApi;
    private $headers = array(
        "Cache-Control" => 'no-cache, no-store, must-revalidate',
        'X-Content-Type-Options' => 'nosniff',
        'X-XSS-Protection' => '1',
        'Content-Type' => 'application/json; charset=utf-8',

    );
    private $user_id;

    public function __construct()
    {
    }

    public function dateFormat($date)
    {
        $date = explode(' ', str_replace('-', '/', $date));
        if (count($date) == 1) {
            array_push($date, '');
        }
        return $date;
    }

    public function response($code, $message = "", $data = [])
    {
        $res = [
            "code" => $code,
            "msg" => $message,
            "data" => $data
        ];
        return response()->json($res, 200, $this->headers, JSON_UNESCAPED_UNICODE);
    }

    public function response_paginate($code, $message = "", $data = [], $page = [])
    {
        $res = [
            "code" => $code,
            "msg" => $message,
            "page" => $page,
            "data" => $data
        ];
        return response()->json($res, 200, $this->headers, JSON_UNESCAPED_UNICODE);
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function array_replace_key($array, $old_key, $new_key)
    {
        $keys = array_keys($array);
        $index = array_search($old_key, $keys);
        $keys[$index] = $new_key;
        return array_combine($keys, array_values($array));
    }


    /** dateROCToAD()
     *  民國轉西元年
     *  @param string $str 民國 yyymmdd 或 yyy/mm/dd 或yyy-mm-dd
     *  @param string $replace
     *  @return string yyyy-mm-dd
     */
    public function dateROCToAD($str, $replace)
    {
        // 移除不必要的字符
        $str = str_replace(["/", "-"], "", $str);

        // 確保輸入的字串長度符合要求
        if (strlen($str) != 7) {
            throw new \InvalidArgumentException("Invalid date format. Expected format: 'YYYMMDD'.");
        }

        // 分割字串，並將前 3 個字元轉換為整數，加上 1911 得到西元年
        $roc = intval(substr($str, 0, 3));
        $ad = $roc + 1911;

        // 分割剩餘的部分為月份和日期
        $mm = substr($str, 3, 2);
        $dd = substr($str, 5, 2);

        // 組合為新的日期格式
        $date = implode($replace, [$ad, $mm, $dd]);

        return $date;
    }


    /** dateADToRoc()
     *  民國轉西元年
     *  @param string $str 西元 yyyymmdd 或 yyyy/mm/dd 或 yyyy-mm-dd
     *  @param string $replace
     *  @return string yyyy-mm-dd
     */
    public function dateADToROC($str, $replace)
    {
        // 移除不必要的字符
        $str = str_replace(["/", "-"], "", $str);

        // 確保輸入的字串長度符合要求
        if (strlen($str) != 8) {
            throw new \InvalidArgumentException("Invalid date format. Expected format: 'YYYYMMDD'.");
        }

        // 提取年份、月份和日期
        $ad = intval(substr($str, 0, 4));
        $mm = substr($str, 4, 2);
        $dd = substr($str, 6, 2);

        // 將西元年轉換為民國年
        $roc = $ad - 1911;

        // 組合為新的日期格式
        $date = implode($replace, [$roc, $mm, $dd]);

        return $date;
    }


    /** getUserId()
     *  取得使用者
     *  @return int
     */
    public function getUserId()
    {
        $this->user_id  = Auth::user()->id;
        return $this->user_id;
    }

    public function validatorAndResponse($data, $relus, $message = [], $customAttributes = [])
    {
        $vali = Validator::make($data, $relus, $message, $customAttributes);
        $errors = $this->checkValiDate($vali);
        if ($errors) {
            return $errors;
        }
    }

    public function checkValiDate($validate)
    {
        if ($validate->fails()) {
            list($code, $message) = explode(" ", $validate->errors()->first());
            return $this->response($code, $message);
        }
    }
}
