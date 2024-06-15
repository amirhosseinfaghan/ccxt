'use strict';

var bitimen$1 = require('./abstract/bitimen.js');

//  ---------------------------------------------------------------------------
//  ---------------------------------------------------------------------------
/**
 * @class bitimen
 * @augments Exchange
 * @description Set rateLimit to 1000 if fully verified
 */
class bitimen extends bitimen$1 {
    describe() {
        return this.deepExtend(super.describe(), {
            'id': 'bitimen',
            'name': 'Bitimen',
            'country': ['IR'],
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
                'logo': 'https://cdn.arz.digital/cr-odin/img/exchanges/bitimen/64x64.png',
                'api': {
                    'public': 'https://api.bitimen.com',
                },
                'www': 'https://bitimen.com',
                'doc': [
                    'https://bitimen.com',
                ],
            },
            'timeframes': {
                '1h': '60',
                '3h': '180',
                '6h': '360',
                '12h': '720',
                '1d': '1440',
            },
            'api': {
                'public': {
                    'get': {
                        'api/market/stats': 1,
                        'api/orderbook/depth': 1,
                        'api/kline/history': 1,
                    },
                },
            },
            'fees': {
                'trading': {
                    'tierBased': false,
                    'percentage': true,
                    'maker': this.parseNumber('0.001'),
                    'taker': this.parseNumber('0.001'),
                },
            },
        });
    }
    async fetchMarkets(symbols = undefined, params = {}) {
        /**
         * @method
         * @name bitimen#fetchMarkets
         * @description retrieves data on all markets for bitimen
         * @see https://bitimen.com
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object[]} an array of objects representing market data
         */
        const response = await this.publicGetApiMarketStats(params);
        const marketKeys = Object.keys(response);
        const result = [];
        for (let i = 0; i < marketKeys.length; i++) {
            const index = marketKeys[i];
            const market = await this.parseMarket(response[index]);
            result.push(market);
        }
        return result;
    }
    parseMarket(market) {
        //         BTC_IRT: {
        // identifier: "BTC_IRT",
        // name: "بیت‌کوین / تومان",
        // base_asset_name: "بیت‌کوین",
        // base_asset_ticker: "BTC",
        // base_asset_prec: "8",
        // base_asset_logo: "6c912caf_9517_210428023944.png",
        // quote_asset_name: "تومان",
        // quote_asset_ticker: "IRT",
        // quote_asset_prec: "0",
        // quote_asset_logo: "57caf3ea_7105_201105152450.png",
        // amount_prec: 8,
        // price_prec: 0,
        // min_price: 50,
        // max_price: 50,
        // min_amount: 50000,
        // change: -1.2210559541451,
        // change_display: "-1.22",
        // volume: "33,399,207,748",
        // best_ask: "3,901,117,155",
        // best_bid: "3,899,860,005",
        // best_bid_raw: 3899860005,
        // best_ask_raw: 3901117155,
        // open: "3,948,151,038",
        // close: "3,900,523,464",
        // last: "3,900,523,464",
        // high: "3,961,685,769",
        // low: "3,839,720,912"
        // },
        const id = this.safeString(market, 'identifier');
        let baseId = this.safeString(market, 'base_asset_ticker');
        let quoteId = this.safeString(market, 'quote_asset_ticker');
        const base = this.safeCurrencyCode(baseId);
        const quote = this.safeCurrencyCode(quoteId);
        baseId = baseId.toLowerCase();
        quoteId = quoteId.toLowerCase();
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
    async fetchTickers(symbols = undefined, params = {}) {
        /**
         * @method
         * @name bitimen#fetchTickers
         * @description fetches price tickers for multiple markets, statistical information calculated over the past 24 hours for each market
         * @see https://bitimen.com
         * @param {string[]|undefined} symbols unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a dictionary of [ticker structures]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets();
        if (symbols !== undefined) {
            symbols = this.marketSymbols(symbols);
        }
        const response = await this.publicGetApiMarketStats(params);
        const marketKeys = Object.keys(response);
        const result = {};
        for (let i = 0; i < marketKeys.length; i++) {
            const index = marketKeys[i];
            if (response[index]['last'] === '0') {
                continue;
            }
            const ticker = await this.parseTicker(response[index]);
            const symbol = ticker['symbol'];
            result[symbol] = ticker;
        }
        return this.filterByArrayTickers(result, 'symbol', symbols);
    }
    async fetchTicker(symbol, params = {}) {
        /**
         * @method
         * @name bitimen#fetchTicker
         * @description fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @see https://bitimen.com
         * @param {string} symbol unified symbol of the market to fetch the ticker for
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        const response = await this.publicGetApiMarketStats(params);
        const ticker = await this.parseTicker(response[market['id']]);
        return ticker;
    }
    parseTicker(ticker, market = undefined) {
        //         BTC_IRT: {
        // identifier: "BTC_IRT",
        // name: "بیت‌کوین / تومان",
        // base_asset_name: "بیت‌کوین",
        // base_asset_ticker: "BTC",
        // base_asset_prec: "8",
        // base_asset_logo: "6c912caf_9517_210428023944.png",
        // quote_asset_name: "تومان",
        // quote_asset_ticker: "IRT",
        // quote_asset_prec: "0",
        // quote_asset_logo: "57caf3ea_7105_201105152450.png",
        // amount_prec: 8,
        // price_prec: 0,
        // min_price: 50,
        // max_price: 50,
        // min_amount: 50000,
        // change: -1.2210559541451,
        // change_display: "-1.22",
        // volume: "33,399,207,748",
        // best_ask: "3,901,117,155",
        // best_bid: "3,899,860,005",
        // best_bid_raw: 3899860005,
        // best_ask_raw: 3901117155,
        // open: "3,948,151,038",
        // close: "3,900,523,464",
        // last: "3,900,523,464",
        // high: "3,961,685,769",
        // low: "3,839,720,912"
        // },
        ticker['high'] = ticker['high'].replace(',', '');
        ticker['low'] = ticker['low'].replace(',', '');
        ticker['close'] = ticker['close'].replace(',', '');
        ticker['open'] = ticker['open'].replace(',', '');
        ticker['best_bid'] = ticker['best_bid'].replace(',', '');
        ticker['best_ask'] = ticker['best_ask'].replace(',', '');
        ticker['best_ask'] = ticker['best_ask'].replace(',', '');
        ticker['volume'] = ticker['volume'].replace(',', '');
        const marketType = 'spot';
        const marketId = this.safeString(ticker, 'identifier');
        const symbol = this.safeSymbol(marketId, market, undefined, marketType);
        const high = this.safeFloat(ticker, 'high', 0);
        const low = this.safeFloat(ticker, 'low', 0);
        const close = this.safeFloat(ticker, 'close', 0);
        const open = this.safeFloat(ticker, 'open', 0);
        const bid = this.safeFloat(ticker, 'best_bid', 0);
        const ask = this.safeFloat(ticker, 'best_ask', 0);
        const last = this.safeFloat(ticker, 'last', 0);
        const change = this.safeFloat(ticker, 'change', 0);
        const quoteVolume = this.safeFloat(ticker, 'volume', 0);
        return this.safeTicker({
            'symbol': symbol,
            'timestamp': undefined,
            'datetime': undefined,
            'high': high,
            'low': low,
            'bid': bid,
            'bidVolume': undefined,
            'ask': ask,
            'askVolume': undefined,
            'vwap': undefined,
            'open': open,
            'close': close,
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
    async fetchOHLCV(symbol, timeframe = '1h', since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name bitimen#fetchOHLCV
         * @description fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
         * @see https://bitimen.com
         * @param {string} symbol unified symbol of the market to fetch OHLCV data for
         * @param {string} timeframe the length of time each candle represents
         * @param {int} [since] timestamp in ms of the earliest candle to fetch
         * @param {int} [limit] the maximum amount of candles to fetch
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {int[][]} A list of candles ordered as timestamp, open, high, low, close, volume
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        const endTime = Date.now();
        const request = {
            'symbol': market['id'],
            'from': (endTime / 1000) - (24 * 60 * 60),
            'to': endTime / 1000,
            'resolution': this.safeString(this.timeframes, timeframe, timeframe),
        };
        if (since !== undefined) {
            request['from'] = since / 1000;
        }
        request['from'] = this.safeInteger(request, 'from');
        request['to'] = this.safeInteger(request, 'to');
        if (timeframe !== undefined) {
            request['resolution'] = this.safeString(this.timeframes, timeframe, timeframe);
        }
        const response = await this.publicGetApiKlineHistory(request);
        const ohlcvs = [];
        for (let i = 0; i < response.length; i++) {
            ohlcvs.push([
                this.safeValue(response[i], 'time'),
                this.safeFloat(response[i], 'open'),
                this.safeFloat(response[i], 'high'),
                this.safeFloat(response[i], 'low'),
                this.safeFloat(response[i], 'close'),
                this.safeFloat(response[i], 'volume'),
            ]);
        }
        return this.parseOHLCVs(ohlcvs, market, timeframe, since, limit);
    }
    async fetchOrderBook(symbol, limit = undefined, params = {}) {
        /**
         * @method
         * @name bitimen#fetchOrderBooks
         * @description fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data for multiple markets
         * @see https://bitimen.com
         * @param {string[]|undefined} symbols list of unified market symbols, all symbols fetched if undefined, default is undefined
         * @param {int} [limit] max number of entries per orderbook to return, default is undefined
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a dictionary of [order book structures]{@link https://docs.ccxt.com/#/?id=order-book-structure} indexed by market symbol
         */
        await this.loadMarkets();
        const market = this.market(symbol);
        const request = {
            'symbol': market['id'],
        };
        const response = await this.publicGetApiOrderbookDepth(request);
        const timestamp = Date.now();
        return this.parseOrderBook(response, symbol, timestamp, 'bids', 'asks');
    }
    sign(path, api = 'public', method = 'GET', params = {}, headers = undefined, body = undefined) {
        const query = this.omit(params, this.extractParams(path));
        let url = this.urls['api']['public'] + '/' + path;
        if (path === 'api/kline/history') {
            url = url + '?' + this.urlencode(query);
        }
        if (path === 'api/orderbook/depth') {
            url = url + '/' + params['symbol'];
        }
        headers = { 'Content-Type': 'application/json' };
        return { 'url': url, 'method': method, 'body': body, 'headers': headers };
    }
}

module.exports = bitimen;
