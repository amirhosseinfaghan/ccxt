<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class abantether extends \ccxt\Exchange {
    public function public_get_management_all_coins($params = array()) {
        return $this->request('management/all-coins/', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetManagementAllCoins($params = array()) {
        return $this->request('management/all-coins/', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
}
