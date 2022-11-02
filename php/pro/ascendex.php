<?php

namespace ccxt\pro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\AuthenticationError;
use React\Async;

class ascendex extends \ccxt\async\ascendex {

    use ClientTrait;

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'has' => array(
                'ws' => true,
                'watchBalance' => true,
                'watchOHLCV' => true,
                'watchOrderBook' => true,
                'watchOrders' => true,
                'watchTicker' => false,
                'watchTrades' => true,
            ),
            'urls' => array(
                'api' => array(
                    'ws' => array(
                        'public' => 'wss://ascendex.com:443/api/pro/v2/stream',
                        'private' => 'wss://ascendex.com:443/{accountGroup}/api/pro/v2/stream',
                    ),
                ),
                'test' => array(
                    'ws' => array(
                        'public' => 'wss://api-test.ascendex-sandbox.com:443/api/pro/v2/stream',
                        'private' => 'wss://api-test.ascendex-sandbox.com:443/{accountGroup}/api/pro/v2/stream',
                    ),
                ),
            ),
            'options' => array(
                'tradesLimit' => 1000,
                'ordersLimit' => 1000,
                'OHLCVLimit' => 1000,
                'categoriesAccount' => array(
                    'cash' => 'spot',
                    'futures' => 'swap',
                    'margin' => 'margin',
                ),
            ),
        ));
    }

    public function watch_public($messageHash, $params = array ()) {
        return Async\async(function () use ($messageHash, $params) {
            $url = $this->urls['api']['ws']['public'];
            $id = $this->nonce();
            $request = array(
                'id' => (string) $id,
                'op' => 'sub',
            );
            $message = array_merge($request, $params);
            return Async\await($this->watch($url, $messageHash, $message, $messageHash));
        }) ();
    }

    public function watch_private($channel, $messageHash, $params = array ()) {
        return Async\async(function () use ($channel, $messageHash, $params) {
            Async\await($this->load_accounts());
            $accountGroup = $this->safe_string($this->options, 'account-group');
            $url = $this->urls['api']['ws']['private'];
            $url = $this->implode_params($url, array( 'accountGroup' => $accountGroup ));
            $id = $this->nonce();
            $request = array(
                'id' => (string) $id,
                'op' => 'sub',
                'ch' => $channel,
            );
            $message = array_merge($request, $params);
            Async\await($this->authenticate($url, $params));
            return Async\await($this->watch($url, $messageHash, $message, $channel));
        }) ();
    }

    public function watch_ohlcv($symbol, $timeframe = '1m', $since = null, $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $timeframe, $since, $limit, $params) {
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            if (($limit === null) || ($limit > 1440)) {
                $limit = 100;
            }
            $interval = $this->timeframes[$timeframe];
            $channel = 'bar' . ':' . $interval . ':' . $market['id'];
            $params = array(
                'ch' => $channel,
            );
            $ohlcv = Async\await($this->watch_public($channel, $params));
            if ($this->newUpdates) {
                $limit = $ohlcv->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($ohlcv, $since, $limit, 0, true);
        }) ();
    }

    public function handle_ohlcv($client, $message) {
        //
        // {
        //     "m" => "bar",
        //     "s" => "ASD/USDT",
        //     "data" => {
        //         "i" =>  "1",
        //         "ts" => 1575398940000,
        //         "o" =>  "0.04993",
        //         "c" =>  "0.04970",
        //         "h" =>  "0.04993",
        //         "l" =>  "0.04970",
        //         "v" =>  "8052"
        //     }
        // }
        //
        $marketId = $this->safe_string($message, 's');
        $symbol = $this->safe_symbol($marketId);
        $channel = $this->safe_string($message, 'm');
        $data = $this->safe_value($message, 'data', array());
        $interval = $this->safe_string($data, 'i');
        $messageHash = $channel . ':' . $interval . ':' . $marketId;
        $timeframe = $this->find_timeframe($interval);
        $market = $this->market($symbol);
        $parsed = $this->parse_ohlcv($message, $market);
        $this->ohlcvs[$symbol] = $this->safe_value($this->ohlcvs, $symbol, array());
        $stored = $this->safe_value($this->ohlcvs[$symbol], $timeframe);
        if ($stored === null) {
            $limit = $this->safe_integer($this->options, 'OHLCVLimit', 1000);
            $stored = new ArrayCacheByTimestamp ($limit);
            $this->ohlcvs[$symbol][$timeframe] = $stored;
        }
        $stored->append ($parsed);
        $client->resolve ($stored, $messageHash);
        return $message;
    }

    public function watch_trades($symbol, $since = null, $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * get the list of most recent $trades for a particular $symbol
             * @param {string} $symbol unified $symbol of the $market to fetch $trades for
             * @param {int|null} $since timestamp in ms of the earliest trade to fetch
             * @param {int|null} $limit the maximum amount of $trades to fetch
             * @param {array} $params extra parameters specific to the ascendex api endpoint
             * @return {[array]} a list of ~@link https://docs.ccxt.com/en/latest/manual.html?#public-$trades trade structures~
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $channel = 'trades' . ':' . $market['id'];
            $params = array_merge($params, array(
                'ch' => $channel,
            ));
            $trades = Async\await($this->watch_public($channel, $params));
            if ($this->newUpdates) {
                $limit = $trades->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($trades, $since, $limit, 'timestamp', true);
        }) ();
    }

    public function handle_trades($client, $message) {
        //
        // {
        //     m => 'trades',
        //     $symbol => 'BTC/USDT',
        //     data => array(
        //       {
        //         p => '40744.28',
        //         q => '0.00150',
        //         ts => 1647514330758,
        //         bm => true,
        //         seqnum => 72057633465800320
        //       }
        //     )
        // }
        //
        $marketId = $this->safe_string($message, 'symbol');
        $symbol = $this->safe_symbol($marketId);
        $channel = $this->safe_string($message, 'm');
        $messageHash = $channel . ':' . $marketId;
        $market = $this->market($symbol);
        $rawData = $this->safe_value($message, 'data');
        if ($rawData === null) {
            $rawData = array();
        }
        $trades = $this->parse_trades($rawData, $market);
        $tradesArray = $this->safe_value($this->trades, $symbol);
        if ($tradesArray === null) {
            $limit = $this->safe_integer($this->options, 'tradesLimit', 1000);
            $tradesArray = new ArrayCache ($limit);
        }
        for ($i = 0; $i < count($trades); $i++) {
            $tradesArray->append ($trades[$i]);
        }
        $this->trades[$symbol] = $tradesArray;
        $client->resolve ($tradesArray, $messageHash);
    }

    public function watch_order_book($symbol, $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $limit, $params) {
            /**
             * watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
             * @param {string} $symbol unified $symbol of the $market to fetch the order book for
             * @param {int|null} $limit the maximum amount of order book entries to return
             * @param {array} $params extra parameters specific to the ascendex api endpoint
             * @return {array} A dictionary of {@link https://docs.ccxt.com/en/latest/manual.html#order-book-structure order book structures} indexed by $market symbols
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $channel = 'depth-realtime' . ':' . $market['id'];
            $params = array_merge($params, array(
                'ch' => $channel,
            ));
            $orderbook = Async\await($this->watch_public($channel, $params));
            return $orderbook->limit ();
        }) ();
    }

    public function watch_order_book_snapshot($symbol, $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $limit, $params) {
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $action = 'depth-snapshot-realtime';
            $channel = $action . ':' . $market['id'];
            $params = array_merge($params, array(
                'action' => $action,
                'args' => array(
                    'symbol' => $market['id'],
                ),
                'op' => 'req',
            ));
            $orderbook = Async\await($this->watch_public($channel, $params));
            return $orderbook->limit ();
        }) ();
    }

    public function handle_order_book_snapshot($client, $message) {
        //
        // {
        //     m => 'depth',
        //     $symbol => 'BTC/USDT',
        //     $data => {
        //       ts => 1647520500149,
        //       seqnum => 28590487626,
        //       asks => [
        //         [Array], [Array], [Array],
        //         [Array], [Array], [Array],
        //       ],
        //       bids => [
        //         [Array], [Array], [Array],
        //         [Array], [Array], [Array],
        //       ]
        //     }
        //   }
        //
        $marketId = $this->safe_string($message, 'symbol');
        $symbol = $this->safe_symbol($marketId);
        $channel = $this->safe_string($message, 'm');
        $messageHash = $channel . ':' . $symbol;
        $orderbook = $this->orderbooks[$symbol];
        $data = $this->safe_value($message, 'data');
        $snapshot = $this->parse_order_book($data, $symbol);
        $snapshot['nonce'] = $this->safe_integer($data, 'seqnum');
        $orderbook->reset ($snapshot);
        // unroll the accumulated deltas
        $messages = $orderbook->cache;
        for ($i = 0; $i < count($messages); $i++) {
            $message = $messages[$i];
            $this->handle_order_book_message($client, $message, $orderbook);
        }
        $this->orderbooks[$symbol] = $orderbook;
        $client->resolve ($orderbook, $messageHash);
    }

    public function handle_order_book($client, $message) {
        //
        //   {
        //       m => 'depth',
        //       $symbol => 'BTC/USDT',
        //       data => {
        //         ts => 1647515136144,
        //         seqnum => 28590470736,
        //         asks => [ [Array], [Array] ],
        //         bids => [ [Array], [Array], [Array], [Array], [Array], [Array] ]
        //       }
        //   }
        //
        $channel = $this->safe_string($message, 'm');
        $marketId = $this->safe_string($message, 'symbol');
        $symbol = $this->safe_symbol($marketId);
        $messageHash = $channel . ':' . $marketId;
        $orderbook = $this->safe_value($this->orderbooks, $symbol);
        if ($orderbook === null) {
            $orderbook = $this->order_book(array());
        }
        if ($orderbook['nonce'] === null) {
            $orderbook->cache[] = $message;
        } else {
            $this->handle_order_book_message($client, $message, $orderbook);
            $client->resolve ($orderbook, $messageHash);
        }
    }

    public function handle_delta($bookside, $delta) {
        //
        // ["40990.47","0.01619"],
        //
        $price = $this->safe_float($delta, 0);
        $amount = $this->safe_float($delta, 1);
        $bookside->store ($price, $amount);
    }

    public function handle_deltas($bookside, $deltas) {
        for ($i = 0; $i < count($deltas); $i++) {
            $this->handle_delta($bookside, $deltas[$i]);
        }
    }

    public function handle_order_book_message($client, $message, $orderbook) {
        //
        // {
        //     "m":"depth",
        //     "symbol":"BTC/USDT",
        //     "data":{
        //        "ts":1647527417715,
        //        "seqnum":28590257013,
        //        "asks":[
        //           ["40990.47","0.01619"],
        //           ["41021.21","0"],
        //           ["41031.59","0.06096"]
        //        ],
        //        "bids":[
        //           ["40990.46","0.76114"],
        //           ["40985.18","0"]
        //        ]
        //     }
        //  }
        //
        $data = $this->safe_value($message, 'data', array());
        $seqNum = $this->safe_integer($data, 'seqnum');
        if ($seqNum > $orderbook['nonce']) {
            $asks = $this->safe_value($data, 'asks', array());
            $bids = $this->safe_value($data, 'bids', array());
            $this->handle_deltas($orderbook['asks'], $asks);
            $this->handle_deltas($orderbook['bids'], $bids);
            $orderbook['nonce'] = $seqNum;
            $timestamp = $this->safe_integer($data, 'ts');
            $orderbook['timestamp'] = $timestamp;
            $orderbook['datetime'] = $this->iso8601($timestamp);
        }
        return $orderbook;
    }

    public function watch_balance($params = array ()) {
        return Async\async(function () use ($params) {
            /**
             * $query for balance and get the amount of funds available for trading or funds locked in orders
             * @param {array} $params extra parameters specific to the ascendex api endpoint
             * @return {array} a ~@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure balance structure~
             */
            Async\await($this->load_markets());
            list($type, $query) = $this->handle_market_type_and_params('watchBalance', null, $params);
            $channel = null;
            $messageHash = null;
            if (($type === 'spot') || ($type === 'margin')) {
                $accountCategories = $this->safe_value($this->options, 'accountCategories', array());
                $accountCategory = $this->safe_string($accountCategories, $type, 'cash'); // cash, margin,
                $accountCategory = strtoupper($accountCategory);
                $channel = 'order:' . $accountCategory; // order and balance share the same $channel
                $messageHash = 'balance:' . $type;
            } else {
                $channel = 'futures-account-update';
                $messageHash = 'balance:swap';
            }
            return Async\await($this->watch_private($channel, $messageHash, $query));
        }) ();
    }

    public function handle_balance($client, $message) {
        //
        // cash $account
        //
        // {
        //     "m" => "balance",
        //     "accountId" => "cshQtyfq8XLAA9kcf19h8bXHbAwwoqDo",
        //     "ac" => "CASH",
        //     "data" => {
        //         "a" : "USDT",
        //         "sn" => 8159798,
        //         "tb" => "600",
        //         "ab" => "600"
        //     }
        // }
        //
        // margin $account
        //
        // {
        //     "m" => "balance",
        //     "accountId" => "marOxpKJV83dxTRx0Eyxpa0gxc4Txt0P",
        //     "ac" => "MARGIN",
        //     "data" => {
        //         "a"  : "USDT",
        //         "sn" : 8159802,
        //         "tb" : "400", // total Balance
        //         "ab" : "400", // available $balance
        //         "brw" => "0", // borrowws
        //         "int" => "0" // interest
        //     }
        // }
        //
        // futures
        // {
        //     "m"     : "futures-$account-update",            // $message
        //     "e"     : "ExecutionReport",                   // event $type
        //     "t"     : 1612508562129,                       // time
        //     "acc"   : "futures-$account-id",         // $account ID
        //     "at"    : "FUTURES",                           // $account $type
        //     "sn"    : 23128,                               // sequence number,
        //     "id"    : "r177710001cbU3813942147C5kbFGOan",
        //     "col" => array(
        //       {
        //         "a" => "USDT",               // asset $code
        //         "b" => "1000000",            // $balance
        //         "f" => "1"                   // discount factor
        //       }
        //     ),
        //     (...)
        //
        $channel = $this->safe_string($message, 'm');
        $result = null;
        $type = null;
        if (($channel === 'order') || ($channel === 'futures-order')) {
            $data = $this->safe_value($message, 'data');
            $marketId = $this->safe_string($data, 's');
            $market = $this->safe_market($marketId);
            $baseAccount = $this->account();
            $baseAccount['free'] = $this->safe_string($data, 'bab');
            $baseAccount['total'] = $this->safe_string($data, 'btb');
            $quoteAccount = $this->account();
            $quoteAccount['free'] = $this->safe_string($data, 'qab');
            $quoteAccount['total'] = $this->safe_string($data, 'qtb');
            if ($market['contract']) {
                $type = 'swap';
                $result = $this->safe_value($this->balance, $type, array());
            } else {
                $type = $market['type'];
                $result = $this->safe_value($this->balance, $type, array());
            }
            $result[$market['base']] = $baseAccount;
            $result[$market['quote']] = $quoteAccount;
        } else {
            $accountType = $this->safe_string_lower_2($message, 'ac', 'at');
            $categoriesAccounts = $this->safe_value($this->options, 'categoriesAccount');
            $type = $this->safe_string($categoriesAccounts, $accountType, 'spot');
            $result = $this->safe_value($this->balance, $type, array());
            $data = $this->safe_value($message, 'data');
            $balances = null;
            if ($data === null) {
                $balances = $this->safe_value($message, 'col');
            } else {
                $balances = array( $data );
            }
            for ($i = 0; $i < count($balances); $i++) {
                $balance = $balances[$i];
                $code = $this->safe_currency_code($this->safe_string($balance, 'a'));
                $account = $this->account();
                $account['free'] = $this->safe_string($balance, 'ab');
                $account['total'] = $this->safe_string_2($balance, 'tb', 'b');
                $result[$code] = $account;
            }
        }
        $messageHash = 'balance' . ':' . $type;
        $client->resolve ($this->safe_balance($result), $messageHash);
    }

    public function watch_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * watches information on multiple $orders made by the user
             * @param {string|null} $symbol unified $market $symbol of the $market $orders were made in
             * @param {int|null} $since the earliest time in ms to fetch $orders for
             * @param {int|null} $limit the maximum number of  orde structures to retrieve
             * @param {array} $params extra parameters specific to the ascendex api endpoint
             * @return {[array]} a list of {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structures}
             */
            Async\await($this->load_markets());
            $market = null;
            if ($symbol !== null) {
                $market = $this->market($symbol);
                $symbol = $market['symbol'];
            }
            list($type, $query) = $this->handle_market_type_and_params('watchOrders', $market, $params);
            $messageHash = null;
            $channel = null;
            if ($type !== 'spot') {
                $channel = 'futures-order';
                $messageHash = 'order:FUTURES';
            } else {
                $accountCategories = $this->safe_value($this->options, 'accountCategories', array());
                $accountCategory = $this->safe_string($accountCategories, $type, 'cash'); // cash, margin
                $accountCategory = strtoupper($accountCategory);
                $messageHash = 'order' . ':' . $accountCategory;
                $channel = $messageHash;
            }
            if ($symbol !== null) {
                $messageHash = $messageHash . ':' . $symbol;
            }
            $orders = Async\await($this->watch_private($channel, $messageHash, $query));
            if ($this->newUpdates) {
                $limit = $orders->getLimit ($symbol, $limit);
            }
            return $this->filter_by_symbol_since_limit($orders, $symbol, $since, $limit, true);
        }) ();
    }

    public function handle_order($client, $message) {
        //
        // spot $order
        // {
        //   m => 'order',
        //   accountId => 'cshF5SlR9ukAXoDOuXbND4dVpBMw9gzH',
        //   ac => 'CASH',
        //   $data => {
        //     sn => 19399016185,
        //     orderId => 'r17f9d7983faU7223046196CMlrj3bfC',
        //     s => 'LTC/USDT',
        //     ot => 'Limit',
        //     t => 1647614461160,
        //     p => '50',
        //     q => '0.1',
        //     sd => 'Buy',
        //     st => 'New',
        //     ap => '0',
        //     cfq => '0',
        //     sp => '',
        //     err => '',
        //     btb => '0',
        //     bab => '0',
        //     qtb => '8',
        //     qab => '2.995',
        //     cf => '0',
        //     fa => 'USDT',
        //     ei => 'NULL_VAL'
        //   }
        // }
        //
        //  futures $order
        // {
        //     m => 'futures-order',
        //     sn => 19399927636,
        //     e => 'ExecutionReport',
        //     a => 'futF5SlR9ukAXoDOuXbND4dVpBMw9gzH', // account id
        //     ac => 'FUTURES',
        //     t => 1647622515434, // last execution time
        //      (...)
        // }
        //
        $accountType = $this->safe_string($message, 'ac');
        $messageHash = 'order:' . $accountType;
        $data = $this->safe_value($message, 'data', $message);
        $order = $this->parse_ws_order($data);
        if ($this->orders === null) {
            $limit = $this->safe_integer($this->options, 'ordersLimit', 1000);
            $this->orders = new ArrayCacheBySymbolById ($limit);
        }
        $orders = $this->orders;
        $orders->append ($order);
        $symbolMessageHash = $messageHash . ':' . $order['symbol'];
        $client->resolve ($orders, $symbolMessageHash);
        $client->resolve ($orders, $messageHash);
    }

    public function parse_ws_order($order, $market = null) {
        //
        // spot $order
        //    {
        //          sn => 19399016185, //sequence number
        //          orderId => 'r17f9d7983faU7223046196CMlrj3bfC',
        //          s => 'LTC/USDT',
        //          ot => 'Limit', // $order $type
        //          t => 1647614461160, // last execution $timestamp
        //          p => '50', // $price
        //          q => '0.1', // quantity
        //          sd => 'Buy', // $side
        //          st => 'New', // $status
        //          ap => '0', // $average fill $price
        //          cfq => '0', // cumulated fill quantity
        //          sp => '', // stop $price
        //          err => '',
        //          btb => '0', // base asset total balance
        //          bab => '0', // base asset available balance
        //          qtb => '8', // quote asset total balance
        //          qab => '2.995', // quote asset available balance
        //          cf => '0', // cumulated commission
        //          fa => 'USDT', // $fee asset
        //          ei => 'NULL_VAL'
        //        }
        //
        //  futures $order
        // {
        //     m => 'futures-order',
        //     sn => 19399927636,
        //     e => 'ExecutionReport',
        //     a => 'futF5SlR9ukAXoDOuXbND4dVpBMw9gzH', // account $id
        //     ac => 'FUTURES',
        //     t => 1647622515434, // last execution time
        //     ct => 1647622515413, // $order creation time
        //     orderId => 'r17f9df469b1U7223046196Okf5Kbmd',
        //     sd => 'Buy', // $side
        //     ot => 'Limit', // $order $type
        //     ei => 'NULL_VAL',
        //     q => '1', // quantity
        //     p => '50', //price
        //     sp => '0', // $stopPrice
        //     spb => '',  // stopTrigger
        //     s => 'LTC-PERP', // $symbol
        //     st => 'New', // state
        //     err => '',
        //     lp => '0', // last $filled $price
        //     lq => '0', // last $filled quantity (base asset)
        //     ap => '0',  // $average $filled $price
        //     cfq => '0', // cummulative $filled quantity (base asset)
        //     f => '0', // commission $fee of the current execution
        //     cf => '0', // cumulative commission $fee
        //     fa => 'USDT', // $fee asset
        //     psl => '0',
        //     pslt => 'market',
        //     ptp => '0',
        //     ptpt => 'market'
        //   }
        //
        $status = $this->parse_order_status($this->safe_string($order, 'st'));
        $marketId = $this->safe_string($order, 's');
        $timestamp = $this->safe_integer($order, 't');
        $symbol = $this->safe_symbol($marketId, $market, '/');
        $lastTradeTimestamp = $this->safe_integer($order, 't');
        $price = $this->safe_string($order, 'p');
        $amount = $this->safe_string($order, 'q');
        $average = $this->safe_string($order, 'ap');
        $filled = $this->safe_string($order, 'cfq');
        $id = $this->safe_string($order, 'orderId');
        $type = $this->safe_string_lower($order, 'ot');
        $side = $this->safe_string_lower($order, 'sd');
        $feeCost = $this->safe_number($order, 'cf');
        $fee = null;
        if ($feeCost !== null) {
            $feeCurrencyId = $this->safe_string($order, 'fa');
            $feeCurrencyCode = $this->safe_currency_code($feeCurrencyId);
            $fee = array(
                'cost' => $feeCost,
                'currency' => $feeCurrencyCode,
            );
        }
        $stopPrice = $this->parse_number($this->omit_zero($this->safe_string($order, 'sp')));
        return $this->safe_order(array(
            'info' => $order,
            'id' => $id,
            'clientOrderId' => null,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'lastTradeTimestamp' => $lastTradeTimestamp,
            'symbol' => $symbol,
            'type' => $type,
            'timeInForce' => null,
            'postOnly' => null,
            'side' => $side,
            'price' => $price,
            'stopPrice' => $stopPrice,
            'amount' => $amount,
            'cost' => null,
            'average' => $average,
            'filled' => $filled,
            'remaining' => null,
            'status' => $status,
            'fee' => $fee,
            'trades' => null,
        ), $market);
    }

    public function handle_error_message($client, $message) {
        //
        // {
        //     m => 'disconnected',
        //     code => 100005,
        //     reason => 'INVALID_WS_REQUEST_DATA',
        //     info => 'Session is disconnected due to missing pong $message from the client'
        //   }
        //
        $errorCode = $this->safe_integer($message, 'code');
        try {
            if ($errorCode !== null) {
                $feedback = $this->id . ' ' . $this->json($message);
                $this->throw_exactly_matched_exception($this->exceptions['exact'], $errorCode, $feedback);
                $messageString = $this->safe_value($message, 'message');
                if ($messageString !== null) {
                    $this->throw_broadly_matched_exception($this->exceptions['broad'], $messageString, $feedback);
                }
            }
        } catch (Exception $e) {
            if ($e instanceof AuthenticationError) {
                $client->reject ($e, 'authenticated');
                $method = 'auth';
                if (is_array($client->subscriptions) && array_key_exists($method, $client->subscriptions)) {
                    unset($client->subscriptions[$method]);
                }
                return false;
            } else {
                $client->reject ($e);
            }
        }
        return $message;
    }

    public function handle_authenticate($client, $message) {
        //
        //     array( m => 'auth', id => '1647605234', code => 0 )
        //
        $future = $client->futures['authenticated'];
        $future->resolve (1);
        return $message;
    }

    public function handle_message($client, $message) {
        if (!$this->handle_error_message($client, $message)) {
            return;
        }
        //
        //     array( m => 'ping', hp => 3 )
        //
        //     array( m => 'sub', ch => 'bar:BTC/USDT', code => 0 )
        //
        //     array( m => 'sub', id => '1647515701', ch => 'depth:BTC/USDT', code => 0 )
        //
        //     array( m => 'connected', type => 'unauth' )
        //
        //     array( m => 'auth', id => '1647605234', code => 0 )
        //
        // order or balance sub
        // {
        //     m => 'sub',
        //     id => '1647605952',
        //     ch => 'order:cshF5SlR9ukAXoDOuXbND4dVpBMw9gzH', or futures-order
        //     code => 0
        //   }
        //
        // ohlcv
        //  {
        //     m => 'bar',
        //     s => 'BTC/USDT',
        //     data => {
        //       i => '1',
        //       ts => 1647510060000,
        //       o => '40813.93',
        //       c => '40804.57',
        //       h => '40814.21',
        //       l => '40804.56',
        //       v => '0.01537'
        //     }
        //   }
        //
        // trades
        //
        //    {
        //        m => 'trades',
        //        symbol => 'BTC/USDT',
        //        data => array(
        //          {
        //            p => '40762.26',
        //            q => '0.01500',
        //            ts => 1647514306759,
        //            bm => true,
        //            seqnum => 72057633465795180
        //          }
        //        )
        //    }
        //
        // orderbook deltas
        //
        // {
        //     "m":"depth",
        //     "symbol":"BTC/USDT",
        //     "data":{
        //        "ts":1647527417715,
        //        "seqnum":28590257013,
        //        "asks":[
        //           ["40990.47","0.01619"],
        //           ["41021.21","0"],
        //           ["41031.59","0.06096"]
        //        ],
        //        "bids":[
        //           ["40990.46","0.76114"],
        //           ["40985.18","0"]
        //        ]
        //     }
        //  }
        //
        // orderbook snapshot
        //  {
        //     m => 'depth-snapshot',
        //     symbol => 'BTC/USDT',
        //     data => {
        //       ts => 1647525938513,
        //       seqnum => 28590504772,
        //       asks => [
        //         [Array], [Array], [Array], [Array], [Array], [Array], [Array],
        //         [Array], [Array], [Array], [Array], [Array], [Array], [Array],
        //         [Array], [Array], [Array], [Array], [Array], [Array], [Array],
        //          (...)
        //       ]
        //  }
        //
        // spot order update
        //  {
        //      "m" => "order",
        //      "accountId" => "cshQtyfq8XLAA9kcf19h8bXHbAwwoqDo",
        //      "ac" => "CASH",
        //      "data" => {
        //          "s" =>       "BTC/USDT",
        //          "sn" =>       8159711,
        //          "sd" =>      "Buy",
        //          "ap" =>      "0",
        //          "bab" =>     "2006.5974027",
        //          "btb" =>     "2006.5974027",
        //          "cf" =>      "0",
        //          "cfq" =>     "0",
        //          (...)
        //      }
        //  }
        // future order update
        // {
        //     m => 'futures-order',
        //     sn => 19404258063,
        //     e => 'ExecutionReport',
        //     a => 'futF5SlR9ukAXoDOuXbND4dVpBMw9gzH',
        //     ac => 'FUTURES',
        //     t => 1647681792543,
        //     ct => 1647622515413,
        //     orderId => 'r17f9df469b1U7223046196Okf5KbmdL',
        //         (...)
        //     ptpt => 'None'
        //   }
        //
        // balance update cash
        // {
        //     "m" => "balance",
        //     "accountId" => "cshQtyfq8XLAA9kcf19h8bXHbAwwoqDo",
        //     "ac" => "CASH",
        //     "data" => {
        //         "a" : "USDT",
        //         "sn" => 8159798,
        //         "tb" => "600",
        //         "ab" => "600"
        //     }
        // }
        //
        // balance update margin
        // {
        //     "m" => "balance",
        //     "accountId" => "marOxpKJV83dxTRx0Eyxpa0gxc4Txt0P",
        //     "ac" => "MARGIN",
        //     "data" => {
        //         "a"  : "USDT",
        //         "sn" : 8159802,
        //         "tb" : "400",
        //         "ab" : "400",
        //         "brw" => "0",
        //         "int" => "0"
        //     }
        // }
        //
        $subject = $this->safe_string($message, 'm');
        $methods = array(
            'ping' => array($this, 'handle_ping'),
            'auth' => array($this, 'handle_authenticate'),
            'sub' => array($this, 'handle_subscription_status'),
            'depth-realtime' => array($this, 'handle_order_book'),
            'depth-snapshot-realtime' => array($this, 'handle_order_book_snapshot'),
            'trades' => array($this, 'handle_trades'),
            'bar' => array($this, 'handle_ohlcv'),
            'balance' => array($this, 'handle_balance'),
            'futures-account-update' => array($this, 'handle_balance'),
        );
        $method = $this->safe_value($methods, $subject);
        if ($method !== null) {
            $method($client, $message);
        }
        if (($subject === 'order') || ($subject === 'futures-order')) {
            // $this->handle_order($client, $message);
            // balance updates may be in the order structure
            // they may also be standalone balance updates related to account transfers
            $this->handle_order($client, $message);
            if ($subject === 'order') {
                $this->handle_balance($client, $message);
            }
        }
        return $message;
    }

    public function handle_subscription_status($client, $message) {
        //
        //     array( m => 'sub', ch => 'bar:BTC/USDT', code => 0 )
        //
        //     array( m => 'sub', id => '1647515701', ch => 'depth:BTC/USDT', code => 0 )
        //
        $channel = $this->safe_string($message, 'ch', '');
        if (mb_strpos($channel, 'depth-realtime') > -1) {
            $this->handle_order_book_subscription($client, $message);
        }
        return $message;
    }

    public function handle_order_book_subscription($client, $message) {
        $channel = $this->safe_string($message, 'ch');
        $parts = explode(':', $channel);
        $marketId = $parts[1];
        $symbol = $this->safe_symbol($marketId);
        if (is_array($this->orderbooks) && array_key_exists($symbol, $this->orderbooks)) {
            unset($this->orderbooks[$symbol]);
        }
        $this->orderbooks[$symbol] = $this->order_book(array());
        $this->spawn(array($this, 'watch_order_book_snapshot'), $symbol);
    }

    public function pong($client, $message) {
        return Async\async(function () use ($client, $message) {
            //
            //     array( m => 'ping', hp => 3 )
            //
            Async\await($client->send (array( 'op' => 'pong', 'hp' => $this->safe_integer($message, 'hp') )));
        }) ();
    }

    public function handle_ping($client, $message) {
        $this->spawn(array($this, 'pong'), $client, $message);
    }

    public function authenticate($url, $params = array ()) {
        return Async\async(function () use ($url, $params) {
            $this->check_required_credentials();
            $messageHash = 'authenticated';
            $client = $this->client($url);
            $future = $this->safe_value($client->futures, $messageHash);
            if ($future === null) {
                $future = $client->future ('authenticated');
                $client->future ($messageHash);
                $timestamp = (string) $this->milliseconds();
                $urlParts = explode('/', $url);
                $partsLength = count($urlParts);
                $path = $this->safe_string($urlParts, $partsLength - 1);
                $version = $this->safe_string($urlParts, $partsLength - 2);
                $auth = $timestamp . '+' . $version . '/' . $path;
                $secret = base64_decode($this->secret);
                $signature = $this->hmac($this->encode($auth), $secret, 'sha256', 'base64');
                $request = array(
                    'op' => 'auth',
                    'id' => (string) $this->nonce(),
                    't' => $timestamp,
                    'key' => $this->apiKey,
                    'sig' => $signature,
                );
                $this->spawn(array($this, 'watch'), $url, $messageHash, array_merge($request, $params));
            }
            return Async\await($future);
        }) ();
    }
}
