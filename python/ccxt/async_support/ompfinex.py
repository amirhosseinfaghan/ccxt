# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.async_support.base.exchange import Exchange
from ccxt.abstract.ompfinex import ImplicitAPI
from ccxt.base.types import Int, Market, OrderBook, Strings, Ticker, Tickers
from typing import List


class ompfinex(Exchange, ImplicitAPI):

    def describe(self):
        return self.deep_extend(super(ompfinex, self).describe(), {
            'id': 'ompfinex',
            'name': 'OMPFinex',
            'country': ['IR'],
            'rateLimit': 1000,
            'version': '1',
            'certified': False,
            'pro': False,
            'has': {
                'CORS': None,
                'spot': True,
                'margin': False,
                'swap': False,
                'future': False,
                'option': False,
                'addMargin': False,
                'cancelAllOrders': False,
                'cancelOrder': False,
                'cancelOrders': False,
                'createDepositAddress': False,
                'createOrder': False,
                'createStopLimitOrder': False,
                'createStopMarketOrder': False,
                'createStopOrder': False,
                'editOrder': False,
                'fetchBalance': False,
                'fetchBorrowInterest': False,
                'fetchBorrowRateHistories': False,
                'fetchBorrowRateHistory': False,
                'fetchClosedOrders': False,
                'fetchCrossBorrowRate': False,
                'fetchCrossBorrowRates': False,
                'fetchCurrencies': False,
                'fetchDepositAddress': False,
                'fetchDeposits': False,
                'fetchFundingHistory': False,
                'fetchFundingRate': False,
                'fetchFundingRateHistory': False,
                'fetchFundingRates': False,
                'fetchIndexOHLCV': False,
                'fetchIsolatedBorrowRate': False,
                'fetchIsolatedBorrowRates': False,
                'fetchL2OrderBook': False,
                'fetchLedger': False,
                'fetchLedgerEntry': False,
                'fetchLeverageTiers': False,
                'fetchMarkets': True,
                'fetchMarkOHLCV': False,
                'fetchMyTrades': False,
                'fetchOHLCV': True,
                'fetchOpenInterestHistory': False,
                'fetchOpenOrders': False,
                'fetchOrder': False,
                'fetchOrderBook': True,
                'fetchOrders': False,
                'fetchOrderTrades': 'emulated',
                'fetchPositions': False,
                'fetchPremiumIndexOHLCV': False,
                'fetchTicker': True,
                'fetchTickers': True,
                'fetchTime': False,
                'fetchTrades': False,
                'fetchTradingFee': False,
                'fetchTradingFees': False,
                'fetchWithdrawals': False,
                'setLeverage': False,
                'setMarginMode': False,
                'transfer': False,
                'withdraw': False,
            },
            'comment': 'This comment is optional',
            'urls': {
                'logo': 'https://cdn.arz.digital/cr-odin/img/exchanges/ompfinex/64x64.png',
                'api': {
                    'public': 'https://api.ompfinex.com',
                },
                'www': 'https://www.ompfinex.com/',
                'doc': [
                    'https://docs.ompfinex.com/',
                ],
            },
            'timeframes': {
                '1h': '60',
                '3h': '180',
                '6h': '360',
                '12h': '720',
                '1d': '1D',
                '1W': '1W',
                '1M': '3M',
            },
            'api': {
                'public': {
                    'get': {
                        'v1/market': 1,
                        'v2/udf/real/history': 1,
                        'v1/orderbook': 1,
                    },
                },
            },
            'commonCurrencies': {
                'IRR': 'IRT',
            },
            'fees': {
                'trading': {
                    'tierBased': False,
                    'percentage': True,
                    'maker': self.parse_number('0.001'),
                    'taker': self.parse_number('0.001'),
                },
            },
        })

    async def fetch_markets(self, symbols: Strings = None, params={}) -> List[Market]:
        """
        retrieves data on all markets for ompfinex
        :see: https://apidocs.ompfinex.ir/#6ae2dae4a2
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict[]: an array of objects representing market data
        """
        response = await self.publicGetV1Market()
        markets = self.safe_list(response, 'data')
        result = []
        for i in range(0, len(markets)):
            market = await self.parse_market(markets[i])
            result.append(market)
        return result

    def parse_market(self, market) -> Market:
        # {
        #     'id': 1,
        #     'base_currency': {
        #         'id': 'BTC',
        #         'icon_path': 'https://s3.ir-thr-at1.arvanstorage.com/ompfinex-static/t/btc.png',
        #         'name': 'بیت کوین',
        #         'decimal_precision': 8,
        #     },
        #     'quote_currency': {
        #         'id': 'IRR',
        #         'icon_path': 'https://s3.ir-thr-at1.arvanstorage.com/ompfinex-static/t/irt.png',
        #         'name': 'تومان',
        #         'decimal_precision': 0,
        #     },
        #     'name': 'بیت کوین - تومان',
        #     'quote_currency_precision': 0,
        #     'base_currency_precision': 8,
        #     'history': [
        #         '39904073000',
        #         '39869830000',
        #         '39724396000',
        #         '39701684000',
        #         '39712038000',
        #         '39528137000',
        #         '39639658000',
        #         '39644885000',
        #         '39654055000',
        #         '39574451000',
        #         '39615152000',
        #         '39677500800',
        #         '39606862870',
        #         '39737426850',
        #         '39546858000',
        #         '39593530000',
        #         '39385856000',
        #         '39502536080',
        #         '39527561000',
        #         '39581729000',
        #         '39637343000',
        #         '39806512800',
        #         '39616055090',
        #         '39516007000',
        #     ],
        #     'min_price': '39382265000',
        #     'max_price': '40128888990',
        #     'last_price': '39516007000',
        #     'last_volume': '186449950855',
        #     'day_change_percent': -0.97,
        #     'week_change_percent': 1.64,
        #     'tradingview_symbol': 'BINANCE:BTCUSDT',
        #     'is_visible': True,
        # }
        baseAsset = self.safe_dict(market, 'base_currency')
        quoteAsset = self.safe_dict(market, 'quote_currency')
        baseId = self.safe_string_upper(baseAsset, 'id')
        quoteId = self.safe_string_upper(quoteAsset, 'id')
        id = self.safe_value(market, 'id')
        base = self.safe_currency_code(baseId)
        quote = self.safe_currency_code(quoteId)
        baseId = baseId.lower()
        quoteId = quoteId.lower()
        return {
            'id': id,
            'symbol': base + '/' + quote,
            'base': base,
            'quote': quote,
            'settle': None,
            'baseId': baseId,
            'quoteId': quoteId,
            'settleId': None,
            'type': 'spot',
            'spot': True,
            'margin': False,
            'swap': False,
            'future': False,
            'option': False,
            'active': True,
            'contract': False,
            'linear': None,
            'inverse': None,
            'contractSize': None,
            'expiry': None,
            'expiryDatetime': None,
            'strike': None,
            'optionType': None,
            'precision': {
                'amount': None,
                'price': None,
            },
            'limits': {
                'leverage': {
                    'min': None,
                    'max': None,
                },
                'amount': {
                    'min': None,
                    'max': None,
                },
                'price': {
                    'min': None,
                    'max': None,
                },
                'cost': {
                    'min': None,
                    'max': None,
                },
            },
            'created': None,
            'info': market,
        }

    async def fetch_tickers(self, symbols: Strings = None, params={}) -> Tickers:
        """
        fetches price tickers for multiple markets, statistical information calculated over the past 24 hours for each market
        :see: https://api-doc.ompfinex.com/#get-5
        :param str[]|None symbols: unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `ticker structures <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        await self.load_markets()
        if symbols is not None:
            symbols = self.market_symbols(symbols)
        response = await self.publicGetV1Market()
        markets = self.safe_list(response, 'data')
        result = []
        for i in range(0, len(markets)):
            ticker = await self.parse_ticker(markets[i])
            symbol = ticker['symbol']
            result[symbol] = ticker
        return self.filter_by_array_tickers(result, 'symbol', symbols)

    async def fetch_ticker(self, symbol: str, params={}) -> Ticker:
        """
        fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
        :see: https://api-doc.ompfinex.com/#get-5
        :param str symbol: unified symbol of the market to fetch the ticker for
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a `ticker structure <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        await self.load_markets()
        market = self.market(symbol)
        request = {
            'id': market['id'],
        }
        response = await self.publicGetV1Market(request)
        markets = self.safe_dict(response, 'data')
        ticker = await self.parse_ticker(markets)
        return ticker

    def parse_ticker(self, ticker, market: Market = None) -> Ticker:
        # {
        #     'id': 1,
        #     'base_currency': {
        #         'id': 'BTC',
        #         'icon_path': 'https://s3.ir-thr-at1.arvanstorage.com/ompfinex-static/t/btc.png',
        #         'name': 'بیت کوین',
        #         'decimal_precision': 8,
        #     },
        #     'quote_currency': {
        #         'id': 'IRR',
        #         'icon_path': 'https://s3.ir-thr-at1.arvanstorage.com/ompfinex-static/t/irt.png',
        #         'name': 'تومان',
        #         'decimal_precision': 0,
        #     },
        #     'name': 'بیت کوین - تومان',
        #     'quote_currency_precision': 0,
        #     'base_currency_precision': 8,
        #     'history': [
        #         '39904073000',
        #         '39869830000',
        #         '39724396000',
        #         '39701684000',
        #         '39712038000',
        #         '39528137000',
        #         '39639658000',
        #         '39644885000',
        #         '39654055000',
        #         '39574451000',
        #         '39615152000',
        #         '39677500800',
        #         '39606862870',
        #         '39737426850',
        #         '39546858000',
        #         '39593530000',
        #         '39385856000',
        #         '39502536080',
        #         '39527561000',
        #         '39581729000',
        #         '39637343000',
        #         '39806512800',
        #         '39616055090',
        #         '39516007000',
        #     ],
        #     'min_price': '39382265000',
        #     'max_price': '40128888990',
        #     'last_price': '39516007000',
        #     'last_volume': '186449950855',
        #     'day_change_percent': -0.97,
        #     'week_change_percent': 1.64,
        #     'tradingview_symbol': 'BINANCE:BTCUSDT',
        #     'is_visible': True,
        # }
        marketType = 'spot'
        marketId = self.safe_value(ticker, 'id')
        marketinfo = self.market(marketId)
        symbol = self.safe_symbol(marketId, market, None, marketType)
        high = self.safe_float(ticker, 'max_price')
        low = self.safe_float(ticker, 'min_price')
        change = self.safe_float(ticker, 'day_change_percent')
        last = self.safe_float(ticker, 'last_price')
        quoteVolume = self.safe_float(ticker, 'last_volume')
        if marketinfo['quote'] == 'IRT':
            high /= 10
            low /= 10
            last /= 10
            quoteVolume /= 10
        return self.safe_ticker({
            'symbol': symbol,
            'timestamp': None,
            'datetime': None,
            'high': high,
            'low': low,
            'bid': None,
            'bidVolume': None,
            'ask': None,
            'askVolume': None,
            'vwap': None,
            'open': last,
            'close': last,
            'last': last,
            'previousClose': None,
            'change': change,
            'percentage': None,
            'average': None,
            'baseVolume': None,
            'quoteVolume': quoteVolume,
            'info': ticker,
        }, market)

    async def fetch_ohlcv(self, symbol: str, timeframe='1m', since: Int = None, limit: Int = None, params={}) -> List[list]:
        """
        fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
        :see: https://api-doc.ompfinex.com/
        :param str symbol: unified symbol of the market to fetch OHLCV data for
        :param str timeframe: the length of time each candle represents
        :param int [since]: timestamp in ms of the earliest candle to fetch
        :param int [limit]: the maximum amount of candles to fetch
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns int[][]: A list of candles ordered, open, high, low, close, volume
        """
        await self.load_markets()
        market = self.market(symbol)
        if market['quote'] == 'IRT':
            symbol = market['base'] + 'IRR'
        endTime = Date.now()
        request = {
            'symbol': symbol.replace('/', ''),
            'from': (endTime / 1000) - (24 * 60 * 60),
            'to': endTime / 1000,
            'resolution': self.safe_string(self.timeframes, timeframe, timeframe),
            # 'limit': 500,
        }
        if since is not None:
            request['from'] = since / 1000
        request['from'] = self.safe_integer(request, 'from')
        request['to'] = self.safe_integer(request, 'to')
        if timeframe is not None:
            request['resolution'] = self.safe_string(self.timeframes, timeframe, timeframe)
        response = await self.publicGetV2UdfRealHistory(request)
        openList = self.safe_value(response, 'o', [])
        highList = self.safe_list(response, 'h', [])
        lastList = self.safe_list(response, 'l', [])
        closeList = self.safe_list(response, 'c', [])
        volumeList = self.safe_list(response, 'v', [])
        timestampList = self.safe_list(response, 't', [])
        ohlcvs = []
        for i in range(0, len(openList)):
            if market['quote'] == 'IRT':
                openList[i] /= 10
                highList[i] /= 10
                lastList[i] /= 10
                closeList[i] /= 10
                volumeList[i] /= 10
            ohlcvs.append([
                timestampList[i],
                openList[i],
                highList[i],
                lastList[i],
                closeList[i],
                volumeList[i],
            ])
        return self.parse_ohlcvs(ohlcvs, market, timeframe, since, limit)

    async def fetch_order_book(self, symbol: str, limit: Int = None, params={}) -> OrderBook:
        """
        fetches information on open orders with bid(buy) and ask(sell) prices, volumes and other data for multiple markets
        :see: https://api-doc.ompfinex.com/#get
        :param str[]|None symbols: list of unified market symbols, all symbols fetched if None, default is None
        :param int [limit]: max number of entries per orderbook to return, default is None
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `order book structures <https://docs.ccxt.com/#/?id=order-book-structure>` indexed by market symbol
        """
        await self.load_markets()
        market = self.market(symbol)
        response = await self.publicGetV1Orderbook()
        orderbook = self.safe_dict(response, 'data')
        if market['quote'] == 'IRT':
            orderbook = self.safe_dict(orderbook, market['base'] + 'IRR')
            bids = self.safe_list(orderbook, 'bids')
            asks = self.safe_list(orderbook, 'asks')
            for i in range(0, len(bids)):
                bids[i][0] /= 10
            for i in range(0, len(asks)):
                asks[i][0] /= 10
            orderbook['bids'] = asks
            orderbook['asks'] = bids
        else:
            orderbook = self.safe_dict(orderbook, market['base'] + market['quote'])
        timestamp = Date.now()
        return self.parse_order_book(orderbook, symbol, timestamp, 'bids', 'asks', 'price', 'amount')

    def sign(self, path, api='public', method='GET', params={}, headers=None, body=None):
        query = self.omit(params, self.extract_params(path))
        url = self.urls['api']['public'] + '/' + path
        if params['id'] is not None:
            url = url + '/' + params['id']
        if path == 'v2/udf/real/history':
            url = self.urls['api']['public'] + '/' + path + '?' + self.urlencode(query)
        headers = {'Content-Type': 'application/json'}
        return {'url': url, 'method': method, 'body': body, 'headers': headers}
