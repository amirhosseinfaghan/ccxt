<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitir extends \ccxt\async\Exchange {
    public function public_get_v1_market($params = array()) {
        return $this->request('v1/market', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_v2_udf_real_history($params = array()) {
        return $this->request('v2/udf/real/history', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_v1_market_id_order($params = array()) {
        return $this->request('v1/market/{id}/order', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetV1Market($params = array()) {
        return $this->request('v1/market', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetV2UdfRealHistory($params = array()) {
        return $this->request('v2/udf/real/history', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetV1MarketIdOrder($params = array()) {
        return $this->request('v1/market/{id}/order', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
}
