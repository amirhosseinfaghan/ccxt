
//  ---------------------------------------------------------------------------

import Exchange from './abstract/eterex.js';
import { Market, Strings, Ticker, Tickers } from './base/types.js';

//  ---------------------------------------------------------------------------

/**
 * @class eterex
 * @augments Exchange
 * @description Set rateLimit to 1000 if fully verified
 */
export default class eterex extends Exchange {
    describe () {
        return this.deepExtend (super.describe (), {
            'id': 'eterex',
            'name': 'Eterex',
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
                'fetchOHLCV': false,
                'fetchOpenInterestHistory': false,
                'fetchOpenOrders': false,
                'fetchOrder': false,
                'fetchOrderBook': false,
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
                'logo': 'https://cdn.arz.digital/cr-odin/img/exchanges/eterex/64x64.png',
                'api': {
                    'public': 'https://reward.eterex.com',
                },
                'www': 'https://eterex.com',
                'doc': [
                    'https://eterex.com',
                ],
            },
            'api': {
                'public': {
                    'get': {
                        'ad/rates': 1,
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
         * @name eterex#fetchMarkets
         * @description retrieves data on all markets for eterex
         * @see https://reward.eterex.com
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object[]} an array of objects representing market data
         */
        const response = await this.publicGetAdRates (params);
        const markets = this.safeDict (response, 'markets');
        const marketKeys = Object.keys (markets);
        const result = [];
        for (let i = 0; i < marketKeys.length; i++) {
            const index = marketKeys[i];
            const market = await this.parseMarket (markets[index]);
            result.push (market);
        }
        return result;
    }

    parseMarket (market): Market {
        //  {
        //     'sell_price': 4001252619,
        //     'buy_price': 3960630765,
        //     'base': 'BTC',
        //     'quote': 'IRT',
        //     'sell_max': 9000,
        //     'buy_max': 9000,
        //     'sell_active': true,
        //     'buy_active': true,
        //     '24h_volume': 44734409872.22664,
        // },
        let baseId = this.safeString (market, 'base');
        let quoteId = this.safeString (market, 'quote');
        const base = this.safeCurrencyCode (baseId);
        const quote = this.safeCurrencyCode (quoteId);
        const id = base + quote;
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
         * @name eterex#fetchTickers
         * @description fetches price tickers for multiple markets, statistical information calculated over the past 24 hours for each market
         * @see https://reward.eterex.com
         * @param {string[]|undefined} symbols unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a dictionary of [ticker structures]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets ();
        if (symbols !== undefined) {
            symbols = this.marketSymbols (symbols);
        }
        const response = await this.publicGetAdRates (params);
        const markets = this.safeDict (response, 'markets');
        const marketKeys = Object.keys (markets);
        const result = {};
        for (let i = 0; i < marketKeys.length; i++) {
            const index = marketKeys[i];
            markets[index]['symbol'] = index;
            const ticker = await this.parseTicker (markets[index]);
            const symbol = ticker['symbol'];
            result[symbol] = ticker;
        }
        return this.filterByArrayTickers (result, 'symbol', symbols);
    }

    async fetchTicker (symbol: string, params = {}): Promise<Ticker> {
        /**
         * @method
         * @name eterex#fetchTicker
         * @description fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @see https://reward.eterex.com
         * @param {string} symbol unified symbol of the market to fetch the ticker for
         * @param {object} [params] extra parameters specific to the exchange API endpoint
         * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/#/?id=ticker-structure}
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        const response = await this.publicGetAdRates (params);
        const markets = this.safeDict (response, 'markets');
        markets[market['id']]['symbol'] = market['id'];
        const ticker = await this.parseTicker (markets[market['id']]);
        return ticker;
    }

    parseTicker (ticker, market: Market = undefined): Ticker {
        //  {
        //     'sell_price': 4001252619,
        //     'buy_price': 3960630765,
        //     'base': 'BTC',
        //     'quote': 'IRT',
        //     'sell_max': 9000,
        //     'buy_max': 9000,
        //     'sell_active': true,
        //     'buy_active': true,
        //     '24h_volume': 44734409872.22664,
        // },
        const marketType = 'otc';
        const marketId = this.safeString (ticker, 'symbol');
        const symbol = this.safeSymbol (marketId, market, undefined, marketType);
        const high = this.safeFloat (ticker, 'sell_price', 0);
        const low = this.safeFloat (ticker, 'buy_price', 0);
        const bid = this.safeFloat (ticker, 'sell_price', 0);
        const ask = this.safeFloat (ticker, 'buy_price', 0);
        const last = this.safeFloat (ticker, 'buy_price', 0);
        const quoteVolume = this.safeFloat (ticker, '24h_volume', 0);
        return this.safeTicker ({
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
            'open': undefined,
            'close': last,
            'last': last,
            'previousClose': undefined,
            'change': undefined,
            'percentage': undefined,
            'average': undefined,
            'baseVolume': undefined,
            'quoteVolume': quoteVolume,
            'info': ticker,
        }, market);
    }

    sign (path, api = 'public', method = 'GET', params = {}, headers = undefined, body = undefined) {
        const url = this.urls['api']['public'] + '/' + path;
        headers = { 'Content-Type': 'application/json' };
        return { 'url': url, 'method': method, 'body': body, 'headers': headers };
    }
}
