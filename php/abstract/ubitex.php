<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class ubitex extends \ccxt\Exchange {
    public function public_get_api_dashboard_pairlist($params = array()) {
        return $this->request('api/dashboard/PairList', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_api_chart_history($params = array()) {
        return $this->request('api/chart/history', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_api_dashboard($params = array()) {
        return $this->request('api/dashboard', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetApiDashboardPairList($params = array()) {
        return $this->request('api/dashboard/PairList', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetApiChartHistory($params = array()) {
        return $this->request('api/chart/history', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetApiDashboard($params = array()) {
        return $this->request('api/dashboard', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
}
