<?php

namespace ccxt\pro;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\ExchangeError;
use React\Async;
use React\Promise\PromiseInterface;

class bitopro extends \ccxt\async\bitopro {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'has' => array(
                'ws' => true,
                'watchBalance' => true,
                'watchMyTrades' => true,
                'watchOHLCV' => false,
                'watchOrderBook' => true,
                'watchOrders' => false,
                'watchTicker' => true,
                'watchTickers' => false,
                'watchTrades' => true,
            ),
            'urls' => array(
                'ws' => array(
                    'public' => 'wss://stream.bitopro.com:443/ws/v1/pub',
                    'private' => 'wss://stream.bitopro.com:443/ws/v1/pub/auth',
                ),
            ),
            'requiredCredentials' => array(
                'apiKey' => true,
                'secret' => true,
                'login' => true,
            ),
            'options' => array(
                'tradesLimit' => 1000,
                'ordersLimit' => 1000,
                'ws' => array(
                    'options' => array(
                        // headers is required for the authentication
                        'headers' => array(),
                    ),
                ),
            ),
        ));
    }

    public function watch_public($path, $messageHash, $marketId) {
        return Async\async(function () use ($path, $messageHash, $marketId) {
            $url = $this->urls['ws']['public'] . '/' . $path . '/' . $marketId;
            return Async\await($this->watch($url, $messageHash, null, $messageHash));
        }) ();
    }

    public function watch_order_book(string $symbol, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $limit, $params) {
            /**
             * watches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
             * @see https://github.com/bitoex/bitopro-offical-api-docs/blob/master/ws/public/order_book_stream.md
             * @param {string} $symbol unified $symbol of the $market to fetch the order book for
             * @param {int} [$limit] the maximum amount of order book entries to return
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} A dictionary of ~@link https://docs.ccxt.com/#/?id=order-book-structure order book structures~ indexed by $market symbols
             */
            if ($limit !== null) {
                if (($limit !== 5) && ($limit !== 10) && ($limit !== 20) && ($limit !== 50) && ($limit !== 100) && ($limit !== 500) && ($limit !== 1000)) {
                    throw new ExchangeError($this->id . ' watchOrderBook $limit argument must be null, 5, 10, 20, 50, 100, 500 or 1000');
                }
            }
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $messageHash = 'ORDER_BOOK' . ':' . $symbol;
            $endPart = null;
            if ($limit === null) {
                $endPart = $market['id'];
            } else {
                $endPart = $market['id'] . ':' . $limit;
            }
            $orderbook = Async\await($this->watch_public('order-books', $messageHash, $endPart));
            return $orderbook->limit ();
        }) ();
    }

    public function handle_order_book(Client $client, $message) {
        //
        //     {
        //         "event" => "ORDER_BOOK",
        //         "timestamp" => 1650121915308,
        //         "datetime" => "2022-04-16T15:11:55.308Z",
        //         "pair" => "BTC_TWD",
        //         "limit" => 5,
        //         "scale" => 0,
        //         "bids" => array(
        //             array( price => "1188178", amount => '0.0425', count => 1, total => "0.0425" ),
        //         ),
        //         "asks" => array(
        //             array(
        //                 "price" => "1190740",
        //                 "amount" => "0.40943964",
        //                 "count" => 1,
        //                 "total" => "0.40943964"
        //             ),
        //         )
        //     }
        //
        $marketId = $this->safe_string($message, 'pair');
        $market = $this->safe_market($marketId, null, '_');
        $symbol = $market['symbol'];
        $event = $this->safe_string($message, 'event');
        $messageHash = $event . ':' . $symbol;
        $orderbook = $this->safe_value($this->orderbooks, $symbol);
        if ($orderbook === null) {
            $orderbook = $this->order_book(array());
        }
        $timestamp = $this->safe_integer($message, 'timestamp');
        $snapshot = $this->parse_order_book($message, $symbol, $timestamp, 'bids', 'asks', 'price', 'amount');
        $orderbook->reset ($snapshot);
        $client->resolve ($orderbook, $messageHash);
    }

    public function watch_trades(string $symbol, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * get the list of most recent $trades for a particular $symbol
             * @see https://github.com/bitoex/bitopro-offical-api-docs/blob/master/ws/public/trade_stream.md
             * @param {string} $symbol unified $symbol of the $market to fetch $trades for
             * @param {int} [$since] timestamp in ms of the earliest trade to fetch
             * @param {int} [$limit] the maximum amount of $trades to fetch
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of ~@link https://docs.ccxt.com/#/?id=public-$trades trade structures~
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $messageHash = 'TRADE' . ':' . $symbol;
            $trades = Async\await($this->watch_public('trades', $messageHash, $market['id']));
            if ($this->newUpdates) {
                $limit = $trades->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($trades, $since, $limit, 'timestamp', true);
        }) ();
    }

    public function handle_trade(Client $client, $message) {
        //
        //     {
        //         "event" => "TRADE",
        //         "timestamp" => 1650116346665,
        //         "datetime" => "2022-04-16T13:39:06.665Z",
        //         "pair" => "BTC_TWD",
        //         "data" => array(
        //             array(
        //                 "event" => '',
        //                 "datetime" => '',
        //                 "pair" => '',
        //                 "timestamp" => 1650116227,
        //                 "price" => "1189429",
        //                 "amount" => "0.0153127",
        //                 "isBuyer" => true
        //             ),
        //         )
        //     }
        //
        $marketId = $this->safe_string($message, 'pair');
        $market = $this->safe_market($marketId, null, '_');
        $symbol = $market['symbol'];
        $event = $this->safe_string($message, 'event');
        $messageHash = $event . ':' . $symbol;
        $rawData = $this->safe_value($message, 'data', array());
        $trades = $this->parse_trades($rawData, $market);
        $tradesCache = $this->safe_value($this->trades, $symbol);
        if ($tradesCache === null) {
            $limit = $this->safe_integer($this->options, 'tradesLimit', 1000);
            $tradesCache = new ArrayCache ($limit);
        }
        for ($i = 0; $i < count($trades); $i++) {
            $tradesCache->append ($trades[$i]);
        }
        $this->trades[$symbol] = $tradesCache;
        $client->resolve ($tradesCache, $messageHash);
    }

    public function watch_my_trades(?string $symbol = null, ?int $since = null, ?int $limit = null, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $since, $limit, $params) {
            /**
             * watches information on multiple $trades made by the user
             * @see https://github.com/bitoex/bitopro-offical-api-docs/blob/master/ws/private/matches_stream.md
             * @param {string} $symbol unified $market $symbol of the $market $trades were made in
             * @param {int} [$since] the earliest time in ms to fetch $trades for
             * @param {int} [$limit] the maximum number of trade structures to retrieve
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array[]} a list of [trade structures]{@link https://docs.ccxt.com/#/?id=trade-structure
             */
            $this->check_required_credentials();
            Async\await($this->load_markets());
            $messageHash = 'USER_TRADE';
            if ($symbol !== null) {
                $market = $this->market($symbol);
                $messageHash = $messageHash . ':' . $market['symbol'];
            }
            $url = $this->urls['ws']['private'] . '/' . 'user-trades';
            $this->authenticate($url);
            $trades = Async\await($this->watch($url, $messageHash, null, $messageHash));
            if ($this->newUpdates) {
                $limit = $trades->getLimit ($symbol, $limit);
            }
            return $this->filter_by_since_limit($trades, $since, $limit, 'timestamp', true);
        }) ();
    }

    public function handle_my_trade(Client $client, $message) {
        //
        //     {
        //         "event" => "USER_TRADE",
        //         "timestamp" => 1694667358782,
        //         "datetime" => "2023-09-14T12:55:58.782Z",
        //         "data" => {
        //             "base" => "usdt",
        //             "quote" => "twd",
        //             "side" => "ask",
        //             "price" => "32.039",
        //             "volume" => "1",
        //             "fee" => "6407800",
        //             "feeCurrency" => "twd",
        //             "transactionTimestamp" => 1694667358,
        //             "eventTimestamp" => 1694667358,
        //             "orderID" => 390733918,
        //             "orderType" => "LIMIT",
        //             "matchID" => "bd07673a-94b1-419e-b5ee-d7b723261a5d",
        //             "isMarket" => false,
        //             "isMaker" => false
        //         }
        //     }
        //
        $data = $this->safe_value($message, 'data', array());
        $baseId = $this->safe_string($data, 'base');
        $quoteId = $this->safe_string($data, 'quote');
        $base = $this->safe_currency_code($baseId);
        $quote = $this->safe_currency_code($quoteId);
        $symbol = $this->symbol($base . '/' . $quote);
        $messageHash = $this->safe_string($message, 'event');
        if ($this->myTrades === null) {
            $limit = $this->safe_integer($this->options, 'tradesLimit', 1000);
            $this->myTrades = new ArrayCacheBySymbolById ($limit);
        }
        $trades = $this->myTrades;
        $parsed = $this->parse_ws_trade($data);
        $trades->append ($parsed);
        $client->resolve ($trades, $messageHash);
        $client->resolve ($trades, $messageHash . ':' . $symbol);
    }

    public function parse_ws_trade($trade, ?array $market = null): array {
        //
        //     {
        //         "base" => "usdt",
        //         "quote" => "twd",
        //         "side" => "ask",
        //         "price" => "32.039",
        //         "volume" => "1",
        //         "fee" => "6407800",
        //         "feeCurrency" => "twd",
        //         "transactionTimestamp" => 1694667358,
        //         "eventTimestamp" => 1694667358,
        //         "orderID" => 390733918,
        //         "orderType" => "LIMIT",
        //         "matchID" => "bd07673a-94b1-419e-b5ee-d7b723261a5d",
        //         "isMarket" => false,
        //         "isMaker" => false
        //     }
        //
        $id = $this->safe_string($trade, 'matchID');
        $orderId = $this->safe_string($trade, 'orderID');
        $timestamp = $this->safe_timestamp($trade, 'transactionTimestamp');
        $baseId = $this->safe_string($trade, 'base');
        $quoteId = $this->safe_string($trade, 'quote');
        $base = $this->safe_currency_code($baseId);
        $quote = $this->safe_currency_code($quoteId);
        $symbol = $this->symbol($base . '/' . $quote);
        $market = $this->safe_market($symbol, $market);
        $price = $this->safe_string($trade, 'price');
        $type = $this->safe_string_lower($trade, 'orderType');
        $side = $this->safe_string($trade, 'side');
        if ($side !== null) {
            if ($side === 'ask') {
                $side = 'sell';
            } elseif ($side === 'bid') {
                $side = 'buy';
            }
        }
        $amount = $this->safe_string($trade, 'volume');
        $fee = null;
        $feeAmount = $this->safe_string($trade, 'fee');
        $feeSymbol = $this->safe_currency_code($this->safe_string($trade, 'feeCurrency'));
        if ($feeAmount !== null) {
            $fee = array(
                'cost' => $feeAmount,
                'currency' => $feeSymbol,
                'rate' => null,
            );
        }
        $isMaker = $this->safe_value($trade, 'isMaker');
        $takerOrMaker = null;
        if ($isMaker !== null) {
            if ($isMaker) {
                $takerOrMaker = 'maker';
            } else {
                $takerOrMaker = 'taker';
            }
        }
        return $this->safe_trade(array(
            'id' => $id,
            'info' => $trade,
            'order' => $orderId,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'symbol' => $symbol,
            'takerOrMaker' => $takerOrMaker,
            'type' => $type,
            'side' => $side,
            'price' => $price,
            'amount' => $amount,
            'cost' => null,
            'fee' => $fee,
        ), $market);
    }

    public function watch_ticker(string $symbol, $params = array ()): PromiseInterface {
        return Async\async(function () use ($symbol, $params) {
            /**
             * watches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
             * @see https://github.com/bitoex/bitopro-offical-api-docs/blob/master/ws/public/ticker_stream.md
             * @param {string} $symbol unified $symbol of the $market to fetch the ticker for
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=ticker-structure ticker structure~
             */
            Async\await($this->load_markets());
            $market = $this->market($symbol);
            $symbol = $market['symbol'];
            $messageHash = 'TICKER' . ':' . $symbol;
            return Async\await($this->watch_public('tickers', $messageHash, $market['id']));
        }) ();
    }

    public function handle_ticker(Client $client, $message) {
        //
        //     {
        //         "event" => "TICKER",
        //         "timestamp" => 1650119165710,
        //         "datetime" => "2022-04-16T14:26:05.710Z",
        //         "pair" => "BTC_TWD",
        //         "lastPrice" => "1189110",
        //         "lastPriceUSD" => "40919.1328",
        //         "lastPriceTWD" => "1189110",
        //         "isBuyer" => true,
        //         "priceChange24hr" => "1.23",
        //         "volume24hr" => "7.2090",
        //         "volume24hrUSD" => "294985.5375",
        //         "volume24hrTWD" => "8572279",
        //         "high24hr" => "1193656",
        //         "low24hr" => "1179321"
        //     }
        //
        $marketId = $this->safe_string($message, 'pair');
        $market = $this->safe_market($marketId, null, '_');
        $symbol = $market['symbol'];
        $event = $this->safe_string($message, 'event');
        $messageHash = $event . ':' . $symbol;
        $result = $this->parse_ticker($message);
        $timestamp = $this->safe_integer($message, 'timestamp');
        $datetime = $this->safe_string($message, 'datetime');
        $result['timestamp'] = $timestamp;
        $result['datetime'] = $datetime;
        $this->tickers[$symbol] = $result;
        $client->resolve ($result, $messageHash);
    }

    public function authenticate($url) {
        if (($this->clients !== null) && (is_array($this->clients) && array_key_exists($url, $this->clients))) {
            return;
        }
        $this->check_required_credentials();
        $nonce = $this->milliseconds();
        $rawData = $this->json(array(
            'nonce' => $nonce,
            'identity' => $this->login,
        ));
        $payload = base64_encode($rawData);
        $signature = $this->hmac($this->encode($payload), $this->encode($this->secret), 'sha384');
        $defaultOptions = array(
            'ws' => array(
                'options' => array(
                    'headers' => array(),
                ),
            ),
        );
        // $this->options = $this->extend($defaultOptions, $this->options);
        $this->extend_exchange_options($defaultOptions);
        $originalHeaders = $this->options['ws']['options']['headers'];
        $headers = array(
            'X-BITOPRO-API' => 'ccxt',
            'X-BITOPRO-APIKEY' => $this->apiKey,
            'X-BITOPRO-PAYLOAD' => $payload,
            'X-BITOPRO-SIGNATURE' => $signature,
        );
        $this->options['ws']['options']['headers'] = $headers;
        // instantiate client
        $this->client($url);
        $this->options['ws']['options']['headers'] = $originalHeaders;
    }

    public function watch_balance($params = array ()): PromiseInterface {
        return Async\async(function () use ($params) {
            /**
             * watch balance and get the amount of funds available for trading or funds locked in orders
             * @see https://github.com/bitoex/bitopro-offical-api-docs/blob/master/ws/private/user_balance_stream.md
             * @param {array} [$params] extra parameters specific to the exchange API endpoint
             * @return {array} a ~@link https://docs.ccxt.com/#/?id=balance-structure balance structure~
             */
            $this->check_required_credentials();
            Async\await($this->load_markets());
            $messageHash = 'ACCOUNT_BALANCE';
            $url = $this->urls['ws']['private'] . '/' . 'account-balance';
            $this->authenticate($url);
            return Async\await($this->watch($url, $messageHash, null, $messageHash));
        }) ();
    }

    public function handle_balance(Client $client, $message) {
        //
        //     {
        //         "event" => "ACCOUNT_BALANCE",
        //         "timestamp" => 1650450505715,
        //         "datetime" => "2022-04-20T10:28:25.715Z",
        //         "data" => {
        //           "ADA" => array(
        //             "currency" => "ADA",
        //             "amount" => "0",
        //             "available" => "0",
        //             "stake" => "0",
        //             "tradable" => true
        //           ),
        //         }
        //     }
        //
        $event = $this->safe_string($message, 'event');
        $data = $this->safe_value($message, 'data');
        $timestamp = $this->safe_integer($message, 'timestamp');
        $datetime = $this->safe_string($message, 'datetime');
        $currencies = is_array($data) ? array_keys($data) : array();
        $result = array(
            'info' => $data,
            'timestamp' => $timestamp,
            'datetime' => $datetime,
        );
        for ($i = 0; $i < count($currencies); $i++) {
            $currency = $this->safe_string($currencies, $i);
            $balance = $this->safe_value($data, $currency);
            $currencyId = $this->safe_string($balance, 'currency');
            $code = $this->safe_currency_code($currencyId);
            $account = $this->account();
            $account['free'] = $this->safe_string($balance, 'available');
            $account['total'] = $this->safe_string($balance, 'amount');
            $result[$code] = $account;
        }
        $this->balance = $this->safe_balance($result);
        $client->resolve ($this->balance, $event);
    }

    public function handle_message(Client $client, $message) {
        $methods = array(
            'TRADE' => array($this, 'handle_trade'),
            'TICKER' => array($this, 'handle_ticker'),
            'ORDER_BOOK' => array($this, 'handle_order_book'),
            'ACCOUNT_BALANCE' => array($this, 'handle_balance'),
            'USER_TRADE' => array($this, 'handle_my_trade'),
        );
        $event = $this->safe_string($message, 'event');
        $method = $this->safe_value($methods, $event);
        if ($method !== null) {
            $method($client, $message);
        }
    }
}
