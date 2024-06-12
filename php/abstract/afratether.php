<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class afratether extends \ccxt\Exchange {
    public function public_get_api_v1_0_price($params = array()) {
        return $this->request('api/v1.0/price', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_token($params = array()) {
        return $this->request('token', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetApiV10Price($params = array()) {
        return $this->request('api/v1.0/price', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetToken($params = array()) {
        return $this->request('token', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
}
