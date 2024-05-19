<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class wallex extends \ccxt\Exchange {
    public function public_get_v1_markets($params = array()) {
        return $this->request('v1/markets', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_v1_currencies_stats($params = array()) {
        return $this->request('v1/currencies/stats', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_v1_depth($params = array()) {
        return $this->request('v1/depth', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_v1_udf_history($params = array()) {
        return $this->request('v1/udf/history', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetV1Markets($params = array()) {
        return $this->request('v1/markets', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetV1CurrenciesStats($params = array()) {
        return $this->request('v1/currencies/stats', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetV1Depth($params = array()) {
        return $this->request('v1/depth', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetV1UdfHistory($params = array()) {
        return $this->request('v1/udf/history', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
}
