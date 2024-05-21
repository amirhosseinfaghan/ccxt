<?php

namespace ccxt;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use ccxt\abstract\bitpin as Exchange;

class bitpin extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe(), array(
            'id' => 'bitpin',
            'name' => 'bitpin',
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
                'fetchL3OrderBook' => false,
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
                'logo' => 'https://cdn.arz.digital/cr-odin/img/exchanges/bitpin/64x64.png',
                'api' => array(
                    'public' => 'https://api.bitpin.ir',
                    'OHLCV' => 'https://api.bitpin.org',
                ),
                'www' => 'https://bitpin.ir',
                'doc' => array(
                    'https://docs.bitpin.ir',
                ),
            ),
            'timeframes' => array(
                '1m' => '1',
                '5m' => '5',
                '15m' => '15',
                '30m' => '30',
                '1h' => '60',
                '3h' => '180',
                '4h' => '240',
                '12h' => '720',
                '1d' => '1D',
                '1w' => '1W',
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'v1/mkt/markets/' => 1,
                        'v2/mth/actives/' => 1,
                        'v1/mkt/tv/get_bars/' => 1,
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
         * retrieves data on all $markets for bitpin
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array[]} an array of objects representing $market data
         */
        $response = $this->publicGetV1MktMarkets ($params);
        $markets = $this->safe_dict($response, 'results');
        $result = array();
        for ($i = 0; $i < count($markets); $i++) {
            $market = $this->parse_market($markets[$i]);
            $result[] = $market;
        }
        return $result;
    }

    public function parse_market($market): array {
        $id = $this->safe_string($market, 'id');
        $baseCurrency = $this->safe_dict($market, 'currency1');
        $quoteCurrency = $this->safe_dict($market, 'currency2');
        $baseId = $this->safe_string($baseCurrency, 'code');
        $quoteId = $this->safe_string($quoteCurrency, 'code');
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
         * fetches price tickers for multiple $markets, statistical information calculated over the past 24 hours for each market
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string[]|null} $symbols unified $symbols of the $markets to fetch the $ticker for, all market tickers are returned if not assigned
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array} a dictionary of ~@link https://docs.ccxt.com/#/?id=$ticker-structure $ticker structures~
         */
        $this->load_markets();
        if ($symbols !== null) {
            $symbols = $this->market_symbols($symbols);
        }
        $response = $this->publicGetV1MktMarkets ($params);
        $markets = $this->safe_dict($response, 'results');
        $result = array();
        for ($i = 0; $i < count($markets); $i++) {
            $is_active = $this->safe_bool($markets[$i], 'tradable');
            if ($is_active === true) {
                $ticker = $this->parse_ticker($markets[$i]);
                $symbol = $ticker['symbol'];
                $result[$symbol] = $ticker;
            }
        }
        return $this->filter_by_array_tickers($result, 'symbol', $symbols);
    }

    public function fetch_ticker(string $symbol, $params = array ()): array {
        /**
         * fetches a price $ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string} $symbol unified $symbol of the market to fetch the $ticker for
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array} a ~@link https://docs.ccxt.com/#/?id=$ticker-structure $ticker structure~
         */
        $ticker = $this->fetch_tickers(array( $symbol ));
        return $ticker[$symbol];
    }

    public function parse_ticker($ticker, ?array $market = null): array {
        // {
        //     'id' => 1,
        //     'currency1' => array(
        //         'id' => 1,
        //         'title' => 'Bitcoin',
        //         'title_fa' => 'بیت کوین',
        //         'code' => 'BTC',
        //         'tradable' => true,
        //         'for_test' => false,
        //         'image' => 'https://cdn.bitpin.ir/media/market/currency/1697370601.svg',
        //         'decimal' => 2,
        //         'decimal_amount' => 8,
        //         'decimal_irt' => 0,
        //         'color' => 'f7931a',
        //         'high_risk' => false,
        //         'show_high_risk' => false,
        //         'withdraw_commission' => '0.003000000000000000',
        //         'tags' => array(
        //             array(
        //                 'id' => 44,
        //                 'name' => 'لایه ۱',
        //                 'name_en' => 'layer-1',
        //                 'has_chart' => true,
        //             ),
        //             array(
        //                 'id' => 52,
        //                 'name' => 'اثبات کار',
        //                 'name_en' => 'pow',
        //                 'has_chart' => true,
        //             ),
        //         ),
        //         'etf' => false,
        //         'for_binvest' => false,
        //         'for_loan' => true,
        //         'for_stake' => false,
        //         'recommend_for_deposit_weight' => 1,
        //     ),
        //     'currency2' => array(
        //         'id' => 2,
        //         'title' => 'Toman',
        //         'title_fa' => 'تومان',
        //         'code' => 'IRT',
        //         'tradable' => true,
        //         'for_test' => false,
        //         'image' => 'https://cdn.bitpin.ir/media/market/currency/1684671406.svg',
        //         'decimal' => 0,
        //         'decimal_amount' => 0,
        //         'decimal_irt' => 1,
        //         'color' => '00fd22',
        //         'high_risk' => false,
        //         'show_high_risk' => false,
        //         'withdraw_commission' => '0.000200000000000000',
        //         'tags' => [ ],
        //         'etf' => false,
        //         'for_binvest' => false,
        //         'for_loan' => false,
        //         'for_stake' => false,
        //         'recommend_for_deposit_weight' => 0,
        //     ),
        //     'tradable' => true,
        //     'for_test' => false,
        //     'otc_sell_percent' => '0.01000',
        //     'otc_buy_percent' => '0.01000',
        //     'otc_max_buy_amount' => '0.017000000000000000',
        //     'otc_max_sell_amount' => '0.017000000000000000',
        //     'order_book_info' => array(
        //         'created_at' => null,
        //         'price' => '3894924262',
        //         'change' => 0.0179,
        //         'min' => '3777777800',
        //         'max' => '3925000000',
        //         'time' => '2024-05-19T13:45:00.000Z',
        //         'mean' => '3833950912',
        //         'value' => '6215833783',
        //         'amount' => '1.62286922',
        //     ),
        //     'internal_price_info' => array(
        //         'created_at' => 1716126301.298626,
        //         'price' => '3894924262',
        //         'change' => 1.8,
        //         'min' => '3777777800',
        //         'max' => '3925000000',
        //         'time' => null,
        //         'mean' => null,
        //         'value' => null,
        //         'amount' => null,
        //     ),
        //     'price_info' => array(
        //         'created_at' => 1716126370.677,
        //         'price' => '3906940950',
        //         'change' => 2.04,
        //         'min' => '3785113135',
        //         'max' => '3921003333',
        //         'time' => null,
        //         'mean' => null,
        //         'value' => null,
        //         'amount' => null,
        //     ),
        //     'price' => '3906940950',
        //     'title' => 'Bitcoin/Toman',
        //     'code' => 'BTC_IRT',
        //     'title_fa' => 'بیت کوین/تومان',
        //     'trading_view_source' => 'BINANCE',
        //     'trading_view_symbol' => 'BTCUSDT',
        //     'otc_market' => false,
        //     'text' => '',
        //     'volume_24h' => '2318294704054686.000000000000000000',
        //     'market_cap' => '43370130583253964.000000000000000000',
        //     'circulating_supply' => '19588837.000000000000000000',
        //     'all_time_high' => '3577014315.000000000000000000',
        //     'popularity_weight' => 0,
        //     'freshness_weight' => 0,
        // }
        $marketType = 'spot';
        $priceInfo = $this->safe_value($ticker, 'order_book_info');
        $marketId = $this->safe_string($ticker, 'id');
        $symbol = $this->safe_symbol($marketId, $market, null, $marketType);
        $high = $this->safe_float($priceInfo, 'max', 0);
        $low = $this->safe_float($priceInfo, 'min', 0);
        $last = $this->safe_float($priceInfo, 'lastPrice', 0);
        $change = $this->safe_float($priceInfo, 'change', 0);
        $quoteVolume = $this->safe_float($priceInfo, '24h_quoteVolume', 0);
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => null,
            'datetime' => null,
            'high' => $high,
            'low' => $low,
            'bid' => null,
            'bidVolume' => null,
            'ask' => null,
            'askVolume' => null,
            'vwap' => null,
            'open' => null,
            'close' => $last,
            'last' => $last,
            'previousClose' => null,
            'change' => $change,
            'percentage' => null,
            'average' => null,
            'baseVolume' => null,
            'quoteVolume' => $quoteVolume,
            'info' => $ticker,
        ), $market);
    }

    public function fetch_ohlcv(string $symbol, $timeframe = '1m', ?int $since = null, ?int $limit = null, $params = array ()): array {
        /**
         * fetches historical candlestick data containing the open, high, low, and close price, and the volume of a $market
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string} $symbol unified $symbol of the $market to fetch OHLCV data for
         * @param {string} $timeframe the length of time each candle represents
         * @param {int} [$since] timestamp in ms of the earliest candle to fetch
         * @param {int} [$limit] the maximum amount of candles to fetch
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {int[][]} A list of candles ordered, open, high, low, close, volume
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $endTime = Date.now ();
        $request = array(
            'symbol' => str_replace('/', '_', $market['symbol']),
            'from' => ($endTime / 1000) - (24 * 60 * 60),
            'to' => $endTime / 1000,
            'res' => $this->safe_string($this->timeframes, $timeframe, $timeframe),
        );
        if ($since !== null) {
            $request['from'] = $since / 1000;
        }
        $request['from'] = $this->safe_integer($request, 'from');
        $request['to'] = $this->safe_integer($request, 'to');
        if ($timeframe !== null) {
            $request['res'] = $this->safe_string($this->timeframes, $timeframe, $timeframe);
        }
        $response = $this->publicGetV1MktTvGetBars ($request);
        $ohlcvs = array();
        for ($i = 0; $i < count($response); $i++) {
            $ohlcvs[] = [
                $this->safe_value($response[$i], 'ts'),
                $this->safe_float($response[$i], 'open'),
                $this->safe_float($response[$i], 'high'),
                $this->safe_float($response[$i], 'low'),
                $this->safe_float($response[$i], 'close'),
                $this->safe_float($response[$i], 'volume'),
            ];
        }
        return $this->parse_ohlcvs($ohlcvs, $market, $timeframe, $since, $limit);
    }

    public function fetch_order_book(string $symbol, ?int $limit = null, $params = array ()): array {
        /**
         * fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data for multiple markets
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string[]|null} symbols list of unified $market symbols, all symbols fetched if null, default is null
         * @param {int} [$limit] max number of entries per orderbook to return, default is null
         * @param {array} [$params] extra parameters specific to the exchange API endpoint
         * @return {array} a dictionary of ~@link https://docs.ccxt.com/#/?id=order-book-structure order book structures~ indexed by $market $symbol
         */
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
            'type' => 'buy',
        );
        $Buyresponse = $this->publicGetV2MthActives ($request);
        $request['type'] = 'sell';
        $Sellresponse = $this->publicGetV2MthActives ($request);
        $BuyorderBook = $this->safe_dict($Buyresponse, 'orders', array());
        $SellorderBook = $this->safe_dict($Sellresponse, 'orders', array());
        $orderBook = array( 'bid' => $BuyorderBook, 'ask' => $SellorderBook );
        $timestamp = Date.now ();
        return $this->parse_order_book($orderBook, $symbol, $timestamp, 'bid', 'ask', 'price', 'amount');
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $query = $this->omit($params, $this->extract_params($path));
        $url = $this->urls['api'][$api] . '/' . $path;
        if ($path === 'v1/mkt/tv/get_bars/') {
            $url = $this->urls['api']['OHLCV'] . '/' . $path . '?' . $this->urlencode($query);
        }
        if ($path === 'v2/mth/actives/') {
            $url = $url . $params['symbol'] . '/?type=' . $params['type'];
        }
        $headers = array( 'Content-Type' => 'application/json' );
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }
}
