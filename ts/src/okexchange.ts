
//  ---------------------------------------------------------------------------

import Exchange from './abstract/okexchange.js';
import { Int, Market, OHLCV, OrderBook, Strings, Ticker, Tickers } from './base/types.js';

//  ---------------------------------------------------------------------------

/**
 * @class okexchange
 * @augments Exchange
 * @description Set rateLimit to 1000 if fully verified
 */
export default class okexchange extends Exchange {
    describe () {
        return this.deepExtend (super.describe (), {
            'id': 'okexchange',
            'name': 'OK-EX',
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
                'logo': 'https://cdn.arz.digital/cr-odin/img/exchanges/okexchange/64x64.png',
                'api': {
                    'public': 'https://api.ok-ex.io',
                    'ohlcv': 'https://azapi.ok-ex.io',
                },
                'www': 'https://ok-ex.io/',
                'doc': [
                    'https://docs.ok-ex.io',
                ],
            },
            'timeframes': {
                '1m': '1m',
                '5m': '5m',
                '15m': '15m',
                '30m': '30m',
                '1h': '1h',
                '2h': '2h',
                '4h': '4h',
                '6h': '6h',
                '12h': '12h',
                '1d': '1d',
                '3d': '3d',
                '1w': '1w',
            },
            'api': {
                'public': {
                    'get': {
                        'oapi/v1/market/tickers': 1,
                        'oapi/v1/otc/tickers': 1,
                        'sno/oapi/market/candle': 1,
                        'oapi/v1/market/orderbook': 1,
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
         * @name okexchange#fetchMarkets
         * @description retrieves data on all markets for okexchange
         * @see https://docs.ok-ex.io/#available-coin
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object[]} an array of objects representing market data
         */
        const response = await this.publicGetOapiV1MarketTickers (params);
        const markets = this.safeValue (response, 'tickers');
        const result = [];
        for (let i = 0; i < markets.length; i++) {
            const market = await this.parseMarket (markets[i]);
            result.push (market);
        }
        return result;
    }

    parseMarket (market):Market {
        const id = this.safeString (market, 'symbol');
        const symbol = this.safeString (market, 'symbol');
        let [ baseId, quoteId ] = symbol.split ('-');
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
         * @name okexchange#fetchTickers
         * @description fetches price tickers for multiple markets, statistical information calculated over the past 24 hours for each market
         * @see https://docs.ok-ex.io/#available-coin
         * @param {string[]|undefined} symbols unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a dictionary of [ticker structures]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets ();
        if (symbols !== undefined) {
            symbols = this.marketSymbols (symbols);
        }
        const response = await this.publicGetOapiV1MarketTickers (params);
        const markets = this.safeValue (response, 'tickers');
        const result = {};
        for (let index = 0; index < markets.length; index++) {
            const ticker = await this.parseTicker (markets[index]);
            const symbol = ticker['symbol'];
            result[symbol] = ticker;
        }
        return this.filterByArrayTickers (result, 'symbol', symbols);
    }

    async fetchTicker (symbol: string, params = {}): Promise<Ticker> {
        /**
         * @method
         * @name okexchange#fetchTicker
         * @description fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @see https://docs.ok-ex.io/#available-coin
         * @param {string} symbol unified symbol of the market to fetch the ticker for
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        const ticker = await this.fetchTickers ([ symbol ]);
        return ticker[symbol];
    }

    parseTicker (ticker, market: Market = undefined): Ticker {
        //
        //     {
        //      symbol: "USDT-IRT",
        //      last: "61338.0",
        //      best_ask: "61338.0",
        //      best_bid: "61338.0",
        //      open_24h: "61419",
        //      high_24h: 61739,
        //      low_24h: 60942,
        //      vol_24h_pair: 11017655160,
        //      vol_24h: 17968,
        //      ts: 1715074621
        //     }
        //
        const marketType = 'spot';
        const marketId = this.safeString (ticker, 'symbol');
        const symbol = this.safeSymbol (marketId, market, undefined, marketType);
        let high = this.safeString (ticker, 'high_24h');
        const low = this.safeString (ticker, 'low_24h');
        const bid = this.safeString (ticker, 'best_bid');
        const ask = this.safeString (ticker, 'best_ask');
        const open = this.safeString (ticker, 'open_24h');
        const last = this.safeString (ticker, 'last');
        let quoteVolume = undefined;
        let baseVolume = undefined;
        if (symbol !== 'USDT-IRT') {
            quoteVolume = this.safeString (ticker, 'vol_24h_pair');
            baseVolume = this.safeString (ticker, 'vol_24h');
        } else {
            ticker['ts'] = ticker['ts'] * 1000;
            high = low;
        }
        const timestamp = this.safeInteger (ticker, 'ts');
        return this.safeTicker ({
            'symbol': symbol.replace ('-', '/'),
            'timestamp': timestamp,
            'datetime': undefined,
            'high': high,
            'low': low,
            'bid': this.safeString (bid, 0),
            'bidVolume': undefined,
            'ask': this.safeString (ask, 0),
            'askVolume': undefined,
            'vwap': undefined,
            'open': open,
            'close': last,
            'last': last,
            'previousClose': undefined,
            'change': undefined,
            'percentage': undefined,
            'average': undefined,
            'baseVolume': baseVolume,
            'quoteVolume': quoteVolume,
            'info': ticker,
        }, market);
    }

    async fetchOHLCV (symbol: string, timeframe = '1m', since: Int = undefined, limit: Int = undefined, params = {}): Promise<OHLCV[]> {
        /**
         * @method
         * @name okexchange#fetchOHLCV
         * @description fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
         * @see https://docs.ok-ex.io/#trade
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
            'symbol': symbol.replace ('/', ''),
            'startTime': endTime - 24 * 60 * 60 * 1000,
            'endTime': endTime,
            'interval': '1m',
            'limit': 500,
            'prov': 0,
        };
        if (since !== undefined) {
            request['startTime'] = since;
        }
        if (limit !== undefined) {
            request['limit'] = limit;
        }
        if (timeframe !== undefined) {
            request['interval'] = timeframe;
        }
        const response = await this.publicGetSnoOapiMarketCandle (request);
        const ohlcvs = this.safeList (response, 'data', []);
        return this.parseOHLCVs (ohlcvs, market, timeframe, since, limit);
    }

    async fetchOrderBook (symbol: string, limit: Int = undefined, params = {}): Promise<OrderBook> {
        /**
         * @method
         * @name okexchange#fetchOrderBooks
         * @description fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data for multiple markets
         * @see https://docs.ok-ex.io/#orderbooks
         * @param {string[]|undefined} symbols list of unified market symbols, all symbols fetched if undefined, default is undefined
         * @param {int} [limit] max number of entries per orderbook to return, default is undefined
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a dictionary of [order book structures]{@link https://docs.ccxt.com/#/?id=order-book-structure} indexed by market symbol
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'symbol': market['symbol'].replace ('/', ''),
        };
        const response = await this.publicGetOapiV1MarketOrderbook (request);
        const orderBook = this.safeDict (response, 'books', {});
        const timestamp = Date.now ();
        return this.parseOrderBook (orderBook, symbol, timestamp);
    }

    sign (path, api = 'public', method = 'GET', params = {}, headers = undefined, body = undefined) {
        const query = this.omit (params, this.extractParams (path));
        let url = this.urls['api']['public'] + '/' + path;
        if (path === 'sno/oapi/market/candle') {
            url = this.urls['api']['ohlcv'] + '/' + path + '?' + this.urlencode (query);
        }
        if (path === 'oapi/v1/market/orderbook') {
            url = url + '?' + this.urlencode (query);
        }
        headers = { 'Content-Type': 'application/json' };
        return { 'url': url, 'method': method, 'body': body, 'headers': headers };
    }
}
