<?php

namespace ccxt;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\abstract\exir as Exchange;

class exir extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'id' => 'exir',
            'name' => 'Exir',
            'country' => array( 'IR' ),
            'rateLimit' => 1000,
            'version' => '1',
            'certified' => false,
            'pro' => false,
            'has' => array(
                'CORS' => null,
                'spot' => true,
                'margin' => false,
                'swap' => false,
                'future' => false,
                'option' => false,
                'addMargin' => false,
                'cancelAllOrders' => false,
                'cancelOrder' => false,
                'cancelOrders' => false,
                'createDepositAddress' => false,
                'createOrder' => false,
                'createStopLimitOrder' => false,
                'createStopMarketOrder' => false,
                'createStopOrder' => false,
                'editOrder' => false,
                'fetchBalance' => false,
                'fetchBorrowInterest' => false,
                'fetchBorrowRateHistories' => false,
                'fetchBorrowRateHistory' => false,
                'fetchClosedOrders' => false,
                'fetchCrossBorrowRate' => false,
                'fetchCrossBorrowRates' => false,
                'fetchCurrencies' => false,
                'fetchDepositAddress' => false,
                'fetchDeposits' => false,
                'fetchFundingHistory' => false,
                'fetchFundingRate' => false,
                'fetchFundingRateHistory' => false,
                'fetchFundingRates' => false,
                'fetchIndexOHLCV' => false,
                'fetchIsolatedBorrowRate' => false,
                'fetchIsolatedBorrowRates' => false,
                'fetchL2OrderBook' => false,
                'fetchLedger' => false,
                'fetchLedgerEntry' => false,
                'fetchLeverageTiers' => false,
                'fetchMarkets' => true,
                'fetchMarkOHLCV' => false,
                'fetchMyTrades' => false,
                'fetchOHLCV' => true,
                'fetchOpenInterestHistory' => false,
                'fetchOpenOrders' => false,
                'fetchOrder' => false,
                'fetchOrderBook' => true,
                'fetchOrders' => false,
                'fetchOrderTrades' => 'emulated',
                'fetchPositions' => false,
                'fetchPremiumIndexOHLCV' => false,
                'fetchTicker' => true,
                'fetchTickers' => true,
                'fetchTime' => false,
                'fetchTrades' => false,
                'fetchTradingFee' => false,
                'fetchTradingFees' => false,
                'fetchWithdrawals' => false,
                'setLeverage' => false,
                'setMarginMode' => false,
                'transfer' => false,
                'withdraw' => false,
            ),
            'comment' => 'This comment is optional',
            'urls' => array(
                'logo' => 'https://cdn.arz.digital/cr-odin/img/exchanges/exir/64x64.png',
                'api' => array(
                    'public' => 'https://api.exir.io',
                ),
                'www' => 'https://www.exir.io/',
                'doc' => array(
                    'https://apidocs.exir.io',
                ),
            ),
            'timeframes' => array(
                '15m' => '15',
                '1h' => '60',
                '4h' => '240',
                '1d' => '1D',
                '1w' => '1W',
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'v2/tickers' => 1,
                        'v2/ticker' => 1,
                        'v2/chart' => 1,
                        'v2/orderbook' => 1,
                    ),
                ),
            ),
            'fees' => array(
                'trading' => array(
                    'tierBased' => false,
                    'percentage' => true,
                    'maker' => $this->parse_number('0.001'),
                    'taker' => $this->parse_number('0.001'),
                ),
            ),
        ));
    }

    public function fetch_markets(?array $symbols = null, $params = array ()): array {
        /**
         * retrieves data on all markets for exir
         * @see https://apidocs.exir.io/#tickers
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array[]} an array of objects representing $market data
         */
        $response = $this->publicGetV2Tickers ();
        $marketKeys = is_array($response) ? array_keys($response) : array();
        $result = array();
        for ($i = 0; $i < count($marketKeys); $i++) {
            $symbol = $marketKeys[$i];
            $response[$symbol]['symbol'] = $symbol;
            $market = $this->parse_market($response[$symbol]);
            $result[] = $market;
        }
        return $result;
    }

    public function parse_market($market): array {
        //        array(
        // $symbol => btc-usdt
        // isClosed => false,
        // bestSell => "39659550020",
        // bestBuy => "39650000000",
        // volumeSrc => "11.6924501388",
        // volumeDst => "464510376461.05263193275",
        // latest => "39659550020",
        // mark => "39817678220",
        // dayLow => "38539978000",
        // dayHigh => "40809999990",
        // dayOpen => "38553149810",
        // dayClose => "39659550020",
        // dayChange => "2.87"
        // ),
        $symbol = $this->safe_value($market, 'symbol');
        $id = $symbol;
        list($baseId, $quoteId) = explode('-', $symbol);
        $base = $this->safe_currency_code($baseId);
        $quote = $this->safe_currency_code($quoteId);
        $baseId = strtolower($baseId);
        $quoteId = strtolower($quoteId);
        return array(
            'id' => $id,
            'symbol' => $base . '/' . $quote,
            'base' => $base,
            'quote' => $quote,
            'settle' => null,
            'baseId' => $baseId,
            'quoteId' => $quoteId,
            'settleId' => null,
            'type' => 'spot',
            'spot' => true,
            'margin' => false,
            'swap' => false,
            'future' => false,
            'option' => false,
            'active' => true,
            'contract' => false,
            'linear' => null,
            'inverse' => null,
            'contractSize' => null,
            'expiry' => null,
            'expiryDatetime' => null,
            'strike' => null,
            'optionType' => null,
            'precision' => array(
                'amount' => null,
                'price' => null,
            ),
            'limits' => array(
                'leverage' => array(
                    'min' => null,
                    'max' => null,
                ),
                'amount' => array(
                    'min' => null,
                    'max' => null,
                ),
                'price' => array(
                    'min' => null,
                    'max' => null,
                ),
                'cost' => array(
                    'min' => null,
                    'max' => null,
                ),
            ),
            'created' => null,
            'info' => $market,
        );
    }

    public function fetch_tickers(?array $symbols = null, $params = array ()): array {
        /**
         * fetches price tickers for multiple markets, statistical information calculated over the past 24 hours for each market
         * @see https://apidocs.exir.io/#tickers
         * @param {string[]|null} $symbols unified $symbols of the markets to fetch the $ticker for, all market tickers are returned if not assigned
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array} a dictionary of ~@link https://docs.ccxt.com/#/?id=$ticker-structure $ticker structures~
         */
        $this->load_markets();
        if ($symbols !== null) {
            $symbols = $this->market_symbols($symbols);
        }
        $response = $this->publicGetV2Tickers ();
        $marketKeys = is_array($response) ? array_keys($response) : array();
        $result = array();
        for ($i = 0; $i < count($marketKeys); $i++) {
            $symbol = $marketKeys[$i];
            $response[$symbol]['symbol'] = $symbol;
            $ticker = $this->parse_ticker($response[$symbol]);
            $symbol = $ticker['symbol'];
            $result[$symbol] = $ticker;
        }
        return $this->filter_by_array_tickers($result, 'symbol', $symbols);
    }

    public function fetch_ticker(string $symbol, $params = array ()): array {
        /**
         * fetches a price $ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
         * @see https://apidocs.exir.io/#$ticker
         * @param {string} $symbol unified $symbol of the $market to fetch the $ticker for
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array} a ~@link https://docs.ccxt.com/#/?id=$ticker-structure $ticker structure~
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = $this->publicGetV2Ticker ($request);
        $response['symbol'] = $market['id'];
        $response['time'] = $response['timestamp'];
        $ticker = $this->parse_ticker($response);
        return $ticker;
    }

    public function parse_ticker($ticker, ?array $market = null): array {
        //  array(
        //     'time' => '2024-05-26T08:40:02.305Z',
        //     'open' => 26125,
        //     'close' => 26298,
        //     'high' => 26939,
        //     'low' => 25791,
        //     'last' => 26298,
        //     'volume' => 32167,
        //     'symbol' => 'ada-irt',
        // ),
        $marketType = 'spot';
        $symbol = $this->safe_value($ticker, 'symbol');
        $marketId = $symbol;
        $symbol = $this->safe_symbol($marketId, $market, null, $marketType);
        $high = $this->safe_float($ticker, 'high');
        $low = $this->safe_float($ticker, 'low');
        $bid = $this->safe_float($ticker, 'last');
        $ask = $this->safe_float($ticker, 'last');
        $open = $this->safe_float($ticker, 'open');
        $close = $this->safe_float($ticker, 'close');
        $last = $this->safe_float($ticker, 'last');
        $quoteVolume = $this->safe_float($ticker, 'volume');
        $datetime = $this->safe_string($ticker, 'time');
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => $this->parse8601($datetime),
            'datetime' => $datetime,
            'high' => $high,
            'low' => $low,
            'bid' => $this->safe_float($bid, 0),
            'bidVolume' => null,
            'ask' => $this->safe_float($ask, 0),
            'askVolume' => null,
            'vwap' => null,
            'open' => $open,
            'close' => $close,
            'last' => $last,
            'previousClose' => null,
            'change' => null,
            'percentage' => null,
            'average' => null,
            'baseVolume' => null,
            'quoteVolume' => $quoteVolume,
            'info' => $ticker,
        ), $market);
    }

    public function fetch_ohlcv(string $symbol, $timeframe = '1h', ?int $since = null, ?int $limit = null, $params = array ()): array {
        /**
         * fetches historical candlestick data containing the $open, $high, $low, and $close price, and the $volume of a $market
         * @see https://apidocs.exir.io/#chart
         * @param {string} $symbol unified $symbol of the $market to fetch OHLCV data for
         * @param {string} $timeframe the length of time each $candle represents
         * @param {int} [$since] timestamp in ms of the earliest $candle to fetch
         * @param {int} [$limit] the maximum amount of candles to fetch
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {int[][]} A list of candles ordered, $open, $high, $low, $close, $volume
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $endTime = Date.now ();
        $request = array(
            'symbol' => $market['id'],
            'from' => ($endTime / 1000) - (24 * 60 * 60),
            'to' => $endTime / 1000,
            'resolution' => $this->safe_string($this->timeframes, $timeframe, $timeframe),
        );
        if ($since !== null) {
            $request['from'] = $since / 1000;
        }
        $request['from'] = $this->safe_integer($request, 'from');
        $request['to'] = $this->safe_integer($request, 'to');
        if ($timeframe !== null) {
            $request['resolution'] = $this->safe_string($this->timeframes, $timeframe, $timeframe);
        }
        $response = $this->publicGetV2Chart ($request);
        $ohlcvs = array();
        for ($i = 0; $i < count($response); $i++) {
            $candle = $response[$i];
            $ts = Date.parse ($candle['time']);
            $open = $this->safe_float($candle, 'open');
            $high = $this->safe_float($candle, 'high');
            $low = $this->safe_float($candle, 'low');
            $close = $this->safe_float($candle, 'close');
            $volume = $this->safe_float($candle, 'volume');
            $ohlcvs[] = array(
                $ts,
                $open,
                $high,
                $low,
                $close,
                $volume,
            );
        }
        return $this->parse_ohlcvs($ohlcvs, $market, $timeframe, $since, $limit);
    }

    public function fetch_order_book(string $symbol, ?int $limit = null, $params = array ()): array {
        /**
         * fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data for multiple markets
         * @see https://apidocs.exir.io/#orderbook
         * @param {string[]|null} symbols list of unified $market symbols, all symbols fetched if null, default is null
         * @param {int} [$limit] max number of entries per orderbook to return, default is null
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array} a dictionary of ~@link https://docs.ccxt.com/#/?id=order-book-structure order book structures~ indexed by $market $symbol
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = $this->publicGetV2Orderbook ($request);
        $timestamp = Date.parse ($response[$market['id']]['timestamp']);
        return $this->parse_order_book($response[$market['id']], $symbol, $timestamp);
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $query = $this->omit($params, $this->extract_params($path));
        $url = $this->urls['api']['public'] . '/' . $path;
        if ($path === 'v2/ticker') {
            $url = $this->urls['api']['public'] . '/' . $path . '?' . $this->urlencode($query);
        }
        if ($path === 'v2/chart') {
            $url = $url . '?' . $this->urlencode($query);
        }
        if ($path === 'v2/orderbook') {
            $url = $url . '?' . $this->urlencode($query);
        }
        $headers = array( 'Content-Type' => 'application/json' );
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }
}
