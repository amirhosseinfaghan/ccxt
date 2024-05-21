
//  ---------------------------------------------------------------------------

import Exchange from './abstract/bitpin.js';
import { Int, Market, OHLCV, OrderBook, Strings, Ticker, Tickers } from './base/types.js';

//  ---------------------------------------------------------------------------

/**
 * @class bitpin
 * @augments Exchange
 * @description Set rateLimit to 1000 if fully verified
 */
export default class bitpin extends Exchange {
    describe () {
        return this.deepExtend (super.describe (), {
            'id': 'bitpin',
            'name': 'bitpin',
            'country': [ 'IR' ],
            'rateLimit': 1000,
            'version': '1',
            'certified': false,
            'pro': false,
            'has': {
                'CORS': undefined,
                'spot': true,
                'margin': false,
                'swap': false,
                'future': false,
                'option': false,
                'addMargin': false,
                'cancelAllOrders': false,
                'cancelOrder': false,
                'cancelOrders': false,
                'createDepositAddress': false,
                'createOrder': false,
                'createStopLimitOrder': false,
                'createStopMarketOrder': false,
                'createStopOrder': false,
                'editOrder': false,
                'fetchBalance': false,
                'fetchBorrowInterest': false,
                'fetchBorrowRateHistories': false,
                'fetchBorrowRateHistory': false,
                'fetchClosedOrders': false,
                'fetchCrossBorrowRate': false,
                'fetchCrossBorrowRates': false,
                'fetchCurrencies': false,
                'fetchDepositAddress': false,
                'fetchDeposits': false,
                'fetchFundingHistory': false,
                'fetchFundingRate': false,
                'fetchFundingRateHistory': false,
                'fetchFundingRates': false,
                'fetchIndexOHLCV': false,
                'fetchIsolatedBorrowRate': false,
                'fetchIsolatedBorrowRates': false,
                'fetchL2OrderBook': false,
                'fetchL3OrderBook': false,
                'fetchLedger': false,
                'fetchLedgerEntry': false,
                'fetchLeverageTiers': false,
                'fetchMarkets': true,
                'fetchMarkOHLCV': false,
                'fetchMyTrades': false,
                'fetchOHLCV': true,
                'fetchOpenInterestHistory': false,
                'fetchOpenOrders': false,
                'fetchOrder': false,
                'fetchOrderBook': true,
                'fetchOrders': false,
                'fetchOrderTrades': 'emulated',
                'fetchPositions': false,
                'fetchPremiumIndexOHLCV': false,
                'fetchTicker': true,
                'fetchTickers': true,
                'fetchTime': false,
                'fetchTrades': false,
                'fetchTradingFee': false,
                'fetchTradingFees': false,
                'fetchWithdrawals': false,
                'setLeverage': false,
                'setMarginMode': false,
                'transfer': false,
                'withdraw': false,
            },
            'comment': 'This comment is optional',
            'urls': {
                'logo': 'https://cdn.arz.digital/cr-odin/img/exchanges/bitpin/64x64.png',
                'api': {
                    'public': 'https://api.bitpin.ir',
                    'OHLCV': 'https://api.bitpin.org',
                },
                'www': 'https://bitpin.ir',
                'doc': [
                    'https://docs.bitpin.ir',
                ],
            },
            'timeframes': {
                '1m': '1',
                '5m': '5',
                '15m': '15',
                '30m': '30',
                '1h': '60',
                '3h': '180',
                '4h': '240',
                '12h': '720',
                '1d': '1D',
                '1w': '1W',
            },
            'api': {
                'public': {
                    'get': {
                        'v1/mkt/markets/': 1,
                        'v2/mth/actives/': 1,
                        'v1/mkt/tv/get_bars/': 1,
                    },
                },
            },
            'fees': {
                'trading': {
                    'tierBased': false,
                    'percentage': true,
                    'maker': this.parseNumber ('0.001'),
                    'taker': this.parseNumber ('0.001'),
                },
            },
        });
    }

    async fetchMarkets (symbols: Strings = undefined, params = {}): Promise<Market[]> {
        /**
         * @method
         * @name bitpin#fetchMarkets
         * @description retrieves data on all markets for bitpin
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object[]} an array of objects representing market data
         */
        const response = await this.publicGetV1MktMarkets (params);
        const markets = this.safeDict (response, 'results');
        const result = [];
        for (let i = 0; i < markets.length; i++) {
            const market = await this.parseMarket (markets[i]);
            result.push (market);
        }
        return result;
    }

    parseMarket (market): Market {
        const id = this.safeString (market, 'id');
        const baseCurrency = this.safeDict (market, 'currency1');
        const quoteCurrency = this.safeDict (market, 'currency2');
        let baseId = this.safeString (baseCurrency, 'code');
        let quoteId = this.safeString (quoteCurrency, 'code');
        const base = this.safeCurrencyCode (baseId);
        const quote = this.safeCurrencyCode (quoteId);
        baseId = baseId.toLowerCase ();
        quoteId = quoteId.toLowerCase ();
        return {
            'id': id,
            'symbol': base + '/' + quote,
            'base': base,
            'quote': quote,
            'settle': undefined,
            'baseId': baseId,
            'quoteId': quoteId,
            'settleId': undefined,
            'type': 'spot',
            'spot': true,
            'margin': false,
            'swap': false,
            'future': false,
            'option': false,
            'active': true,
            'contract': false,
            'linear': undefined,
            'inverse': undefined,
            'contractSize': undefined,
            'expiry': undefined,
            'expiryDatetime': undefined,
            'strike': undefined,
            'optionType': undefined,
            'precision': {
                'amount': undefined,
                'price': undefined,
            },
            'limits': {
                'leverage': {
                    'min': undefined,
                    'max': undefined,
                },
                'amount': {
                    'min': undefined,
                    'max': undefined,
                },
                'price': {
                    'min': undefined,
                    'max': undefined,
                },
                'cost': {
                    'min': undefined,
                    'max': undefined,
                },
            },
            'created': undefined,
            'info': market,
        };
    }

    async fetchTickers (symbols: Strings = undefined, params = {}): Promise<Tickers> {
        /**
         * @method
         * @name bitpin#fetchTickers
         * @description fetches price tickers for multiple markets, statistical information calculated over the past 24 hours for each market
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string[]|undefined} symbols unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a dictionary of [ticker structures]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets ();
        if (symbols !== undefined) {
            symbols = this.marketSymbols (symbols);
        }
        const response = await this.publicGetV1MktMarkets (params);
        const markets = this.safeDict (response, 'results');
        const result = {};
        for (let i = 0; i < markets.length; i++) {
            const is_active = this.safeBool (markets[i], 'tradable');
            if (is_active === true) {
                const ticker = await this.parseTicker (markets[i]);
                const symbol = ticker['symbol'];
                result[symbol] = ticker;
            }
        }
        return this.filterByArrayTickers (result, 'symbol', symbols);
    }

    async fetchTicker (symbol: string, params = {}): Promise<Ticker> {
        /**
         * @method
         * @name bitpin#fetchTicker
         * @description fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string} symbol unified symbol of the market to fetch the ticker for
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        const ticker = await this.fetchTickers ([ symbol ]);
        return ticker[symbol];
    }

    parseTicker (ticker, market: Market = undefined): Ticker {
        // {
        //     'id': 1,
        //     'currency1': {
        //         'id': 1,
        //         'title': 'Bitcoin',
        //         'title_fa': 'بیت کوین',
        //         'code': 'BTC',
        //         'tradable': true,
        //         'for_test': false,
        //         'image': 'https://cdn.bitpin.ir/media/market/currency/1697370601.svg',
        //         'decimal': 2,
        //         'decimal_amount': 8,
        //         'decimal_irt': 0,
        //         'color': 'f7931a',
        //         'high_risk': false,
        //         'show_high_risk': false,
        //         'withdraw_commission': '0.003000000000000000',
        //         'tags': [
        //             {
        //                 'id': 44,
        //                 'name': 'لایه ۱',
        //                 'name_en': 'layer-1',
        //                 'has_chart': true,
        //             },
        //             {
        //                 'id': 52,
        //                 'name': 'اثبات کار',
        //                 'name_en': 'pow',
        //                 'has_chart': true,
        //             },
        //         ],
        //         'etf': false,
        //         'for_binvest': false,
        //         'for_loan': true,
        //         'for_stake': false,
        //         'recommend_for_deposit_weight': 1,
        //     },
        //     'currency2': {
        //         'id': 2,
        //         'title': 'Toman',
        //         'title_fa': 'تومان',
        //         'code': 'IRT',
        //         'tradable': true,
        //         'for_test': false,
        //         'image': 'https://cdn.bitpin.ir/media/market/currency/1684671406.svg',
        //         'decimal': 0,
        //         'decimal_amount': 0,
        //         'decimal_irt': 1,
        //         'color': '00fd22',
        //         'high_risk': false,
        //         'show_high_risk': false,
        //         'withdraw_commission': '0.000200000000000000',
        //         'tags': [ ],
        //         'etf': false,
        //         'for_binvest': false,
        //         'for_loan': false,
        //         'for_stake': false,
        //         'recommend_for_deposit_weight': 0,
        //     },
        //     'tradable': true,
        //     'for_test': false,
        //     'otc_sell_percent': '0.01000',
        //     'otc_buy_percent': '0.01000',
        //     'otc_max_buy_amount': '0.017000000000000000',
        //     'otc_max_sell_amount': '0.017000000000000000',
        //     'order_book_info': {
        //         'created_at': null,
        //         'price': '3894924262',
        //         'change': 0.0179,
        //         'min': '3777777800',
        //         'max': '3925000000',
        //         'time': '2024-05-19T13:45:00.000Z',
        //         'mean': '3833950912',
        //         'value': '6215833783',
        //         'amount': '1.62286922',
        //     },
        //     'internal_price_info': {
        //         'created_at': 1716126301.298626,
        //         'price': '3894924262',
        //         'change': 1.8,
        //         'min': '3777777800',
        //         'max': '3925000000',
        //         'time': null,
        //         'mean': null,
        //         'value': null,
        //         'amount': null,
        //     },
        //     'price_info': {
        //         'created_at': 1716126370.677,
        //         'price': '3906940950',
        //         'change': 2.04,
        //         'min': '3785113135',
        //         'max': '3921003333',
        //         'time': null,
        //         'mean': null,
        //         'value': null,
        //         'amount': null,
        //     },
        //     'price': '3906940950',
        //     'title': 'Bitcoin/Toman',
        //     'code': 'BTC_IRT',
        //     'title_fa': 'بیت کوین/تومان',
        //     'trading_view_source': 'BINANCE',
        //     'trading_view_symbol': 'BTCUSDT',
        //     'otc_market': false,
        //     'text': '',
        //     'volume_24h': '2318294704054686.000000000000000000',
        //     'market_cap': '43370130583253964.000000000000000000',
        //     'circulating_supply': '19588837.000000000000000000',
        //     'all_time_high': '3577014315.000000000000000000',
        //     'popularity_weight': 0,
        //     'freshness_weight': 0,
        // }
        const marketType = 'spot';
        const priceInfo = this.safeValue (ticker, 'order_book_info');
        const marketId = this.safeString (ticker, 'id');
        const symbol = this.safeSymbol (marketId, market, undefined, marketType);
        const high = this.safeFloat (priceInfo, 'max', 0);
        const low = this.safeFloat (priceInfo, 'min', 0);
        const last = this.safeFloat (priceInfo, 'lastPrice', 0);
        const change = this.safeFloat (priceInfo, 'change', 0);
        const quoteVolume = this.safeFloat (priceInfo, '24h_quoteVolume', 0);
        return this.safeTicker ({
            'symbol': symbol,
            'timestamp': undefined,
            'datetime': undefined,
            'high': high,
            'low': low,
            'bid': undefined,
            'bidVolume': undefined,
            'ask': undefined,
            'askVolume': undefined,
            'vwap': undefined,
            'open': undefined,
            'close': last,
            'last': last,
            'previousClose': undefined,
            'change': change,
            'percentage': undefined,
            'average': undefined,
            'baseVolume': undefined,
            'quoteVolume': quoteVolume,
            'info': ticker,
        }, market);
    }

    async fetchOHLCV (symbol: string, timeframe = '1m', since: Int = undefined, limit: Int = undefined, params = {}): Promise<OHLCV[]> {
        /**
         * @method
         * @name bitpin#fetchOHLCV
         * @description fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string} symbol unified symbol of the market to fetch OHLCV data for
         * @param {string} timeframe the length of time each candle represents
         * @param {int} [since] timestamp in ms of the earliest candle to fetch
         * @param {int} [limit] the maximum amount of candles to fetch
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {int[][]} A list of candles ordered as timestamp, open, high, low, close, volume
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        const endTime = Date.now ();
        const request = {
            'symbol': market['symbol'].replace ('/', '_'),
            'from': (endTime / 1000) - (24 * 60 * 60),
            'to': endTime / 1000,
            'res': this.safeString (this.timeframes, timeframe, timeframe),
        };
        if (since !== undefined) {
            request['from'] = since / 1000;
        }
        request['from'] = this.safeInteger (request, 'from');
        request['to'] = this.safeInteger (request, 'to');
        if (timeframe !== undefined) {
            request['res'] = this.safeString (this.timeframes, timeframe, timeframe);
        }
        const response = await this.publicGetV1MktTvGetBars (request);
        const ohlcvs = [];
        for (let i = 0; i < response.length; i++) {
            ohlcvs.push ([
                this.safeValue (response[i], 'ts'),
                this.safeFloat (response[i], 'open'),
                this.safeFloat (response[i], 'high'),
                this.safeFloat (response[i], 'low'),
                this.safeFloat (response[i], 'close'),
                this.safeFloat (response[i], 'volume'),
            ]);
        }
        return this.parseOHLCVs (ohlcvs, market, timeframe, since, limit);
    }

    async fetchOrderBook (symbol: string, limit: Int = undefined, params = {}): Promise<OrderBook> {
        /**
         * @method
         * @name bitpin#fetchOrderBooks
         * @description fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data for multiple markets
         * @see https://api-docs.bitpin.ir/#be8d9c51a2
         * @param {string[]|undefined} symbols list of unified market symbols, all symbols fetched if undefined, default is undefined
         * @param {int} [limit] max number of entries per orderbook to return, default is undefined
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a dictionary of [order book structures]{@link https://docs.ccxt.com/#/?id=order-book-structure} indexed by market symbol
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'symbol': market['id'],
            'type': 'buy',
        };
        const Buyresponse = await this.publicGetV2MthActives (request);
        request['type'] = 'sell';
        const Sellresponse = await this.publicGetV2MthActives (request);
        const BuyorderBook = this.safeDict (Buyresponse, 'orders', {});
        const SellorderBook = this.safeDict (Sellresponse, 'orders', {});
        const orderBook = { 'bid': BuyorderBook, 'ask': SellorderBook };
        const timestamp = Date.now ();
        return this.parseOrderBook (orderBook, symbol, timestamp, 'bid', 'ask', 'price', 'amount');
    }

    sign (path, api = 'public', method = 'GET', params = {}, headers = undefined, body = undefined) {
        const query = this.omit (params, this.extractParams (path));
        let url = this.urls['api'][api] + '/' + path;
        if (path === 'v1/mkt/tv/get_bars/') {
            url = this.urls['api']['OHLCV'] + '/' + path + '?' + this.urlencode (query);
        }
        if (path === 'v2/mth/actives/') {
            url = url + params['symbol'] + '/?type=' + params['type'];
        }
        headers = { 'Content-Type': 'application/json' };
        return { 'url': url, 'method': method, 'body': body, 'headers': headers };
    }
}
