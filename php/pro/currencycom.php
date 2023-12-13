<?php

namespace ccxt\pro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\Precise;
use React\Async;
use React\Promise\PromiseInterface;

class currencycom extends \ccxt\async\currencycom {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'has' => array(
                'ws' => true,
                'watchBalance' => true,
                'watchTicker' => true,
                'watchTickers' => false, // for now
                'watchTrades' => true,
                'watchOrderBook' => true,
                // 'watchStatus' => true,
                // 'watchHeartbeat' => true,
                'watchOHLCV' => true,
            ),
            'urls' => array(
                'api' => array(
                    'ws' => 'wss://api-adapter.backend.currency.com/connect',
                ),
            ),
            'options' => array(
                'tradesLimit' => 1000,
                'OHLCVLimit' => 1000,
                // WS timeframes differ from REST timeframes
                'timeframes' => array(
                    '1m' => 'M1',
                    '3m' => 'M3',
                    '5m' => 'M5',
                    '15m' => 'M15',
                    '30m' => 'M30',
                    '1h' => 'H1',
                    '4h' => 'H4',
                    '1d' => 'D1',
                    '1w' => 'W1',
                ),
            ),
            'streaming' => array(
                // okex does not support built-in ws protocol-level ping-pong
                // instead it requires a custom text-based ping-pong
                'ping' => array($this, 'ping'),
                'keepAlive' => 20000,
            ),
        ));
    }

    public function ping($client) {
        // custom ping-pong
        $requestId = (string) $this->request_id();
        return array(
            'destination' => 'ping',
            'correlationId' => $requestId,
            'payload' => array(),
        );
    }

    public function handle_pong(Client $client, $message) {
        $client->lastPong = $this->milliseconds();
        return $message;
    }

    public function handle_balance(Client $client, $message, $subscription) {
        //
        //     {
        //         "status" => "OK",
        //         "correlationId" => "1",
        //         "payload" => {
        //             "makerCommission" => 0.2,
        //             "takerCommission" => 0.2,
        //             "buyerCommission" => 0.2,
        //             "sellerCommission" => 0.2,
        //             "canTrade" => true,
        //             "canWithdraw" => true,
        //             "canDeposit" => true,
        //             "updateTime" => 1596742699,
        //             "balances" => array(
        //                 array(
        //                     "accountId" => 5470306579272968,
        //                     "collateralCurrency" => true,
        //                     "asset" => "ETH",
        //                     "free" => 0,
        //                     "locked" => 0,
        //                     "default" => false
        //                 ),
        //                 array(
        //                     "accountId" => 5470310874305732,
        //                     "collateralCurrency" => true,
        //                     "asset" => "USD",
        //                     "free" => 47.82576735,
        //                     "locked" => 1.187925,
        //                     "default" => true
        //                 ),
        //             )
        //         }
        //     }
        //
        $payload = $this->safe_value($message, 'payload');
        $balance = $this->parse_balance($payload);
        $this->balance = array_merge($this->balance, $balance);
        $messageHash = $this->safe_string($subscription, 'messageHash');
        $client->resolve ($this->balance, $messageHash);
        if (is_array($client->subscriptions) && array_key_exists($messageHash, $client->subscriptions)) {
            unset($client->subscriptions[$messageHash]);
        }
    }

    public function handle_ticker(Client $client, $message, $subscription) {
        //
        //     {
        //         "status" => "OK",
        //         "correlationId" => "1",
        //         "payload" => {
        //             "tickers" => array(
        //                 {
        //                     "symbol" => "BTC/USD_LEVERAGE",
        //                     "priceChange" => "484.05",
        //                     "priceChangePercent" => "4.14",
        //                     "weightedAvgPrice" => "11682.83",
        //                     "prevClosePrice" => "11197.70",
        //                     "lastPrice" => "11682.80",
        //                     "lastQty" => "0.25",
        //                     "bidPrice" => "11682.80",
        //                     "askPrice" => "11682.85",
        //                     "openPrice" => "11197.70",
        //                     "highPrice" => "11734.05",
        //                     "lowPrice" => "11080.95",
        //                     "volume" => "299.133",
        //                     "quoteVolume" => "3488040.3465",
        //                     "openTime" => 1596585600000,
        //                     "closeTime" => 1596654452674
        //                 }
        //             )
        //         }
        //     }
        //
        $destination = '/api/v1/ticker/24hr';
        $payload = $this->safe_value($message, 'payload');
        $tickers = $this->safe_value($payload, 'tickers', array());
        for ($i = 0; $i < count($tickers); $i++) {
            $ticker = $this->parse_ticker($tickers[$i]);
            $symbol = $ticker['symbol'];
            $this->tickers[$symbol] = $ticker;
            $messageHash = $destination . ':' . $symbol;
            $client->resolve ($ticker, $messageHash);
            if (is_array($client->subscriptions) && array_key_exists($messageHash, $client->subscriptions)) {
                unset($client->subscriptions[$messageHash]);
            }
        }
    }

    public function handle_trade($trade, $market = null) {
        //
        //     {
        //         "price" => 11668.55,
        //         "size" => 0.001,
        //         "id" => 1600300736,
        //         "ts" => 1596653426822,
        //         "symbol" => "BTC/USD_LEVERAGE",
        //         "orderId" => "00a02503-0079-54c4-0000-00004020163c",
        //         "clientOrderId" => "00a02503-0079-54c4-0000-482f0000754f",
        //         "buyer" => false
        //     }
        //
        $marketId = $this->safe_string($trade, 'symbol');
        $symbol = $this->safe_symbol($marketId, null, '/');
        $timestamp = $this->safe_integer($trade, 'ts');
        $priceString = $this->safe_string($trade, 'price');
        $amountString = $this->safe_string($trade, 'size');
        $cost = $this->parse_number(Precise::string_mul($priceString, $amountString));
        $price = $this->parse_number($priceString);
        $amount = $this->parse_number($amountString);
        $id = $this->safe_string($trade, 'id');
        $orderId = $this->safe_string($trade, 'orderId');
        $buyer = $this->safe_value($trade, 'buyer');
        $side = $buyer ? 'buy' : 'sell';
        return array(
            'info' => $trade,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'symbol' => $symbol,
            'id' => $id,
            'order' => $orderId,
            'type' => null,
            'takerOrMaker' => null,
            'side' => $side,
            'price' => $price,
            'amount' => $amount,
            'cost' => $cost,
            'fee' => null,
        );
    }

    public function handle_trades(Client $client, $message, $subscription) {
        //
        //     {
        //         "status" => "OK",
        //         "destination" => "internal.trade",
        //         "payload" => {
        //             "price" => 11668.55,
        //             "size" => 0.001,
        //             "id" => 1600300736,
        //             "ts" => 1596653426822,
        //             "symbol" => "BTC/USD_LEVERAGE",
        //             "orderId" => "00a02503-0079-54c4-0000-00004020163c",
        //             "clientOrderId" => "00a02503-0079-54c4-0000-482f0000754f",
        //             "buyer" => false
        //         }
        //     }
        //
        $payload = $this->safe_value($message, 'payload');
        $parsed = $this->handle_trade($payload);
        $symbol = $parsed['symbol'];
        // $destination = $this->safe_string($message, 'destination');
        $destination = 'trades.subscribe';
        $messageHash = $destination . ':' . $symbol;
        $stored = $this->safe_value($this->trades, $symbol);
        if ($stored === null) {
            $limit = $this->safe_integer($this->options, 'tradesLimit', 1000);
            $stored = new ArrayCache ($limit);
            $this->trades[$symbol] = $stored;
        }
        $stored->append ($parsed);
        $client->resolve ($stored, $messageHash);
    }

    public function find_timeframe($timeframe, $defaultTimeframes = null) {
        $timeframes = $this->safe_value($this->options, 'timeframes', $defaultTimeframes);
        $keys = is_array($timeframes) ? array_keys($timeframes) : array();
        for ($i = 0; $i < count($keys); $i++) {
            $key = $keys[$i];
            if ($timeframes[$key] === $timeframe) {
                return $key;
            }
        }
        return null;
    }

    public function handle_ohlcv(Client $client, $message) {
        //
        //     {
        //         "status" => "OK",
        //         "destination" => "ohlc.event",
        //         "payload" => {
        //             "interval" => "M1",
        //             "symbol" => "BTC/USD_LEVERAGE",
        //             "t" => 1596650940000,
        //             "h" => 11670.05,
        //             "l" => 11658.1,
        //             "o" => 11668.55,
        //             "c" => 11666.05
        //         }
        //     }
        //
        // $destination = $this->safe_string($message, 'destination');
        $destination = 'OHLCMarketData.subscribe';
        $payload = $this->safe_value($message, 'payload', array());
        $interval = $this->safe_string($payload, 'interval');
        $timeframe = $this->find_timeframe($interval);
        $marketId = $this->safe_string($payload, 'symbol');
        $market = $this->safe_market($marketId);
        $symbol = $market['symbol'];
        $messageHash = $destination . ':' . $timeframe . ':' . $symbol;
        $result = array(
            $this->safe_integer($payload, 't'),
            $this->safe_number($payload, 'o'),
            $this->safe_number($payload, 'h'),
            $this->safe_number($payload, 'l'),
            $this->safe_number($payload, 'c'),
            null, // no volume v in OHLCV
        );
        $this->ohlcvs[$symbol] = $this->safe_value($this->ohlcvs, $symbol, array());
        $stored = $this->safe_value($this->ohlcvs[$symbol], $timeframe);
        if ($stored === null) {
            $limit = $this->safe_integer($this->options, 'OHLCVLimit', 1000);
            $stored = new ArrayCacheByTimestamp ($limit);
            $this->ohlcvs[$symbol][$timeframe] = $stored;
        }
        $stored->append ($result);
        $client->resolve ($stored, $messageHash);
    }

    public function request_id() {
        $reqid = $this->sum($this->safe_integer($this->options, 'correlationId', 0), 1);
        $this->options['correlationId'] = $reqid;
        return $reqid;
    }

    public function watch_public($destination, $symbol, $params = array ()) {
        return Async\async(function () use ($destination, $symbol, $params) {
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $messageHash = $destination . ':' . $symbol;
            $url = $this->urls['api']['ws'];
            $requestId = (string) $this->request_id();
            $request = $this->deep_extend(array(
                'destination' => $destination,
                'correlationId' => $requestId,
                'payload' => array(
                    'symbols' => [ $market['id'] ],
                ),
            ), $params);
            $subscription = array_merge($request, array(
                'messageHash' => $messageHash,
                'symbol' => $symbol,
            ));
            return Async\await($this->watch($url, $messageHash, $request, $messageHash, $subscription));
        }) ();
    }

    public function watch_private($destination, $params = array ()) {
        return Async\async(function () use ($destination, $params) {
            Async\await($this->load_markets());
            $messageHash = '/api/v1/account';
            $url = $this->urls['api']['ws'];
            $requestId = (string) $this->request_id();
            $payload = array(
                'timestamp' => $this->milliseconds(),
                'apiKey' => $this->apiKey,
            );
            $auth = $this->urlencode($this->keysort($payload));
            $request = $this->deep_extend(array(
                'destination' => $destination,
                'correlationId' => $requestId,
                'payload' => $payload,
            ), $params);
            $request['payload']['signature'] = $this->hmac($this->encode($auth), $this->encode($this->secret), 'sha256');
            $subscription = array_merge($request, array(
                'messageHash' => $messageHash,
            ));
            return Async\await($this->watch($url, $messageHash, $request, $messageHash, $subscription));
        }) ();
    }

    public function watch_balance($params = array ()): PromiseInterface {
        return Async\async(function () use ($params) {
            /**
             * watch balance and get the amount of funds available for trading or funds locked in orders
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=balance-structure balance structure~
             */
            Async\await($this->load_markets());
            return Async\await($this->watch_private('/api/v1/account', $params));
        }) ();
    }

    public function watch_ticker(string $symbol, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $params) {
            /**
             * watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
             * @param {string} $symbol unified $symbol of the $market to fetch the ticker for
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=ticker-structure ticker structure~
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $destination = '/api/v1/ticker/24hr';
            $messageHash = $destination . ':' . $symbol;
            $url = $this->urls['api']['ws'];
            $requestId = (string) $this->request_id();
            $request = $this->deep_extend(array(
                'destination' => $destination,
                'correlationId' => $requestId,
                'payload' => array(
                    'symbol' => $market['id'],
                ),
            ), $params);
            $subscription = array_merge($request, array(
                'messageHash' => $messageHash,
                'symbol' => $symbol,
            ));
            return Async\await($this->watch($url, $messageHash, $request, $messageHash, $subscription));
        }) ();
    }

    public function watch_trades(string $symbol, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * get the list of most recent $trades for a particular $symbol
             * @param {string} $symbol unified $symbol of the market to fetch $trades for
             * @param {int} [$since] timestamp in ms of the earliest trade to fetch
             * @param {int} [$limit] the maximum amount of $trades to fetch
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of ~@link https://docs.ccxt.com/#/?id=public-$trades trade structures~
             */
            Async\await($this->load_markets());
            $symbol = $this->symbol($symbol);
            $trades = Async\await($this->watch_public('trades.subscribe', $symbol, $params));
            if ($this->newUpdates) {
                $limit = $trades->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($trades, $since, $limit, 'timestamp', true);
        }) ();
    }

    public function watch_order_book(string $symbol, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $limit, $params) {
            /**
             * watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
             * @param {string} $symbol unified $symbol of the market to fetch the order book for
             * @param {int} [$limit] the maximum amount of order book entries to return
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} A dictionary of ~@link https://docs.ccxt.com/#/?id=order-book-structure order book structures~ indexed by market symbols
             */
            Async\await($this->load_markets());
            $symbol = $this->symbol($symbol);
            $orderbook = Async\await($this->watch_public('depthMarketData.subscribe', $symbol, $params));
            return $orderbook->limit ();
        }) ();
    }

    public function watch_ohlcv(string $symbol, $timeframe = '1m', ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $timeframe, $since, $limit, $params) {
            /**
             * watches historical candlestick data containing the open, high, low, and close price, and the volume of a market
             * @param {string} $symbol unified $symbol of the market to fetch OHLCV data for
             * @param {string} $timeframe the length of time each candle represents
             * @param {int} [$since] timestamp in ms of the earliest candle to fetch
             * @param {int} [$limit] the maximum amount of candles to fetch
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {int[][]} A list of candles ordered, open, high, low, close, volume
             */
            Async\await($this->load_markets());
            $symbol = $this->symbol($symbol);
            $destination = 'OHLCMarketData.subscribe';
            $messageHash = $destination . ':' . $timeframe;
            $timeframes = $this->safe_value($this->options, 'timeframes');
            $request = array(
                'destination' => $destination,
                'payload' => array(
                    'intervals' => [
                        $timeframes[$timeframe],
                    ],
                ),
            );
            $ohlcv = Async\await($this->watch_public($messageHash, $symbol, array_merge($request, $params)));
            if ($this->newUpdates) {
                $limit = $ohlcv->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($ohlcv, $since, $limit, 0, true);
        }) ();
    }

    public function handle_deltas($bookside, $deltas) {
        $prices = is_array($deltas) ? array_keys($deltas) : array();
        for ($i = 0; $i < count($prices); $i++) {
            $price = $prices[$i];
            $amount = $deltas[$price];
            $bookside->store (floatval($price), floatval($amount));
        }
    }

    public function handle_order_book(Client $client, $message) {
        //
        //     {
        //         "status" => "OK",
        //         "destination" => "marketdepth.event",
        //         "payload" => {
        //             "data" => "array("ts":1596235401337,"bid":array("11366.85":0.2500,"11366.1":5.0000,"11365.6":0.5000,"11363.0":2.0000),"ofr":array("11366.9":0.2500,"11367.65":5.0000,"11368.15":0.5000))",
        //             "symbol" => "BTC/USD_LEVERAGE"
        //         }
        //     }
        //
        $payload = $this->safe_value($message, 'payload', array());
        $data = $this->safe_value($payload, 'data', array());
        $marketId = $this->safe_string($payload, 'symbol');
        $symbol = $this->safe_symbol($marketId, null, '/');
        // $destination = $this->safe_string($message, 'destination');
        $destination = 'depthMarketData.subscribe';
        $messageHash = $destination . ':' . $symbol;
        $timestamp = $this->safe_integer($data, 'ts');
        $orderbook = $this->safe_value($this->orderbooks, $symbol);
        if ($orderbook === null) {
            $orderbook = $this->order_book();
        }
        $orderbook->reset (array(
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
        ));
        $bids = $this->safe_value($data, 'bid', array());
        $asks = $this->safe_value($data, 'ofr', array());
        $this->handle_deltas($orderbook['bids'], $bids);
        $this->handle_deltas($orderbook['asks'], $asks);
        $this->orderbooks[$symbol] = $orderbook;
        $client->resolve ($orderbook, $messageHash);
    }

    public function handle_message(Client $client, $message) {
        //
        //     {
        //         "status" => "OK",
        //         "correlationId" => "1",
        //         "payload" => {
        //             "tickers" => array(
        //                 {
        //                     "symbol" => "1COV",
        //                     "priceChange" => "-0.29",
        //                     "priceChangePercent" => "-0.80",
        //                     "prevClosePrice" => "36.33",
        //                     "lastPrice" => "36.04",
        //                     "openPrice" => "36.33",
        //                     "highPrice" => "36.46",
        //                     "lowPrice" => "35.88",
        //                     "openTime" => 1595548800000,
        //                     "closeTime" => 1595795305401
        //                 }
        //             )
        //         }
        //     }
        //
        //     {
        //         "status" => "OK",
        //         "destination" => "marketdepth.event",
        //         "payload" => {
        //             "data" => "array("ts":1596235401337,"bid":array("11366.85":0.2500,"11366.1":5.0000,"11365.6":0.5000,"11363.0":2.0000),"ofr":array("11366.9":0.2500,"11367.65":5.0000,"11368.15":0.5000))",
        //             "symbol" => "BTC/USD_LEVERAGE"
        //         }
        //     }
        //
        //     {
        //         "status" => "OK",
        //         "destination" => "internal.trade",
        //         "payload" => {
        //             "price" => 11634.75,
        //             "size" => 0.001,
        //             "id" => 1605492357,
        //             "ts" => 1596263802399,
        //             "instrumentId" => 45076691096786110,
        //             "orderId" => "00a02503-0079-54c4-0000-0000401fff51",
        //             "clientOrderId" => "00a02503-0079-54c4-0000-482b00002f17",
        //             "buyer" => false
        //         }
        //     }
        //
        $requestId = $this->safe_string($message, 'correlationId');
        if ($requestId !== null) {
            $subscriptionsById = $this->index_by($client->subscriptions, 'correlationId');
            $status = $this->safe_string($message, 'status');
            $subscription = $this->safe_value($subscriptionsById, $requestId);
            if ($subscription !== null) {
                if ($status === 'OK') {
                    $subscriptionDestination = $this->safe_string($subscription, 'destination');
                    if ($subscriptionDestination !== null) {
                        $methods = array(
                            '/api/v1/ticker/24hr' => array($this, 'handle_ticker'),
                            '/api/v1/account' => array($this, 'handle_balance'),
                        );
                        $method = $this->safe_value($methods, $subscriptionDestination);
                        if ($method === null) {
                            return $message;
                        } else {
                            return $method($client, $message, $subscription);
                        }
                    }
                }
            }
        }
        $destination = $this->safe_string($message, 'destination');
        if ($destination !== null) {
            $methods = array(
                'marketdepth.event' => array($this, 'handle_order_book'),
                'internal.trade' => array($this, 'handle_trades'),
                'ohlc.event' => array($this, 'handle_ohlcv'),
                'ping' => array($this, 'handle_pong'),
            );
            $method = $this->safe_value($methods, $destination);
            if ($method === null) {
                return $message;
            } else {
                return $method($client, $message);
            }
        }
    }
}
