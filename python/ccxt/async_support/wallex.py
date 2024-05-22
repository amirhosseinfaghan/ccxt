# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.async_support.base.exchange import Exchange
from ccxt.abstract.wallex import ImplicitAPI
from ccxt.base.types import Int, Market, OrderBook, Strings, Ticker, Tickers
from typing import List


class wallex(Exchange, ImplicitAPI):

    def describe(self):
        return self.deep_extend(super(wallex, self).describe(), {
            'id': 'wallex',
            'name': 'Wallex',
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
                'fetchL3OrderBook': False,
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
                'logo': 'https://cdn.arz.digital/cr-odin/img/exchanges/wallex/64x64.png',
                'api': {
                    'public': 'https://api.wallex.ir',
                },
                'www': 'https://wallex.ir',
                'doc': [
                    'https://api-docs.wallex.ir',
                ],
            },
            'timeframes': {
                '1m': '1',
                '1h': '60',
                '3h': '180',
                '6h': '360',
                '12h': '720',
                '1d': '1D',
            },
            'api': {
                'public': {
                    'get': {
                        'v1/markets': 1,
                        'v1/currencies/stats': 1,
                        'v1/depth': 1,
                        'v1/udf/history': 1,
                    },
                },
            },
            'commonCurrencies': {
                'TMN': 'IRT',
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
        retrieves data on all markets for wallex
        :see: https://api-docs.wallex.ir/#be8d9c51a2
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict[]: an array of objects representing market data
        """
        response = await self.publicGetV1Markets(params)
        markets = self.safe_dict(response, 'result')
        marketList = self.safe_dict(markets, 'symbols')
        marketKeys = list(marketList.keys())
        result = []
        for i in range(0, len(marketKeys)):
            index = marketKeys[i]
            market = await self.parse_market(marketList[index])
            result.append(market)
        return result

    def parse_market(self, market) -> Market:
        #  {
        # symbol: "PEPETMN",
        # baseAsset: "PEPE",
        # baseAsset_png_icon: "https://api.wallex.ir/coins/PEPE/icon/png",
        # baseAsset_svg_icon: "https://api.wallex.ir/coins/PEPE/icon/svg",
        # baseAssetPrecision: 8,
        # quoteAsset: "TMN",
        # quoteAsset_png_icon: "https://api.wallex.ir/coins/TMN/icon/png",
        # quoteAsset_svg_icon: "https://api.wallex.ir/coins/TMN/icon/svg",
        # quotePrecision: 0,
        # faName: "پپه - تومان",
        # enName: "Pepe - Toman",
        # faBaseAsset: "پپه",
        # enBaseAsset: "Pepe",
        # faQuoteAsset: "تومان",
        # enQuoteAsset: "Toman",
        # stepSize: 0,
        # tickSize: 4,
        # minQty: 1,
        # minNotional: 100000,
        # stats: {
        # bidPrice: "0.5800000000000000",
        # askPrice: "0.5810000000000000",
        # 24h_ch: -2.35,
        # 7d_ch: 9.52,
        # 24h_volume: "102899374056.0000000000000000",
        # 7d_volume: "1444394386948.000000000000000",
        # 24h_quoteVolume: "60901904450.9036000000000000",
        # 24h_highPrice: "0.6086000000000000",
        # 24h_lowPrice: "0.5780000000000000",
        # lastPrice: "0.5810000000000000",
        # lastQty: "0.5810000000000000",
        # lastTradeSide: "SELL",
        # bidVolume: "0",
        # askVolume: "0",
        # bidCount: 7052,
        # askCount: 6395,
        # direction: {
        # SELL: 60,
        # BUY: 40
        # },
        # 24h_tmnVolume: "60901904450.9036000000000000"
        # },
        # createdAt: "2023-05-24T00:00:00.000000Z",
        # isNew: False,
        # isZeroFee: False
        # },
        id = self.safe_string(market, 'symbol')
        baseId = self.safe_string(market, 'baseAsset')
        quoteId = self.safe_string(market, 'quoteAsset')
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
        :see: https://api-docs.wallex.ir/#be8d9c51a2
        :param str[]|None symbols: unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `ticker structures <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        await self.load_markets()
        if symbols is not None:
            symbols = self.market_symbols(symbols)
        response = await self.publicGetV1Markets(params)
        markets = self.safe_dict(response, 'result')
        marketList = self.safe_dict(markets, 'symbols')
        marketKeys = list(marketList.keys())
        result = {}
        for i in range(0, len(marketKeys)):
            index = marketKeys[i]
            ticker = await self.parse_ticker(marketList[index])
            symbol = ticker['symbol']
            result[symbol] = ticker
        return self.filter_by_array_tickers(result, 'symbol', symbols)

    async def fetch_ticker(self, symbol: str, params={}) -> Ticker:
        """
        fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
        :see: https://api-docs.wallex.ir/#be8d9c51a2
        :param str symbol: unified symbol of the market to fetch the ticker for
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a `ticker structure <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        await self.load_markets()
        market = self.market(symbol)
        response = await self.publicGetV1Markets(params)
        markets = self.safe_dict(response, 'result')
        marketList = self.safe_dict(markets, 'symbols')
        ticker = await self.parse_ticker(marketList[market['id']])
        return ticker

    def parse_ticker(self, ticker, market: Market = None) -> Ticker:
        # {
        # symbol: "PEPETMN",
        # baseAsset: "PEPE",
        # baseAsset_png_icon: "https://api.wallex.ir/coins/PEPE/icon/png",
        # baseAsset_svg_icon: "https://api.wallex.ir/coins/PEPE/icon/svg",
        # baseAssetPrecision: 8,
        # quoteAsset: "TMN",
        # quoteAsset_png_icon: "https://api.wallex.ir/coins/TMN/icon/png",
        # quoteAsset_svg_icon: "https://api.wallex.ir/coins/TMN/icon/svg",
        # quotePrecision: 0,
        # faName: "پپه - تومان",
        # enName: "Pepe - Toman",
        # faBaseAsset: "پپه",
        # enBaseAsset: "Pepe",
        # faQuoteAsset: "تومان",
        # enQuoteAsset: "Toman",
        # stepSize: 0,
        # tickSize: 4,
        # minQty: 1,
        # minNotional: 100000,
        # stats: {
        # bidPrice: "0.5800000000000000",
        # askPrice: "0.5810000000000000",
        # 24h_ch: -2.35,
        # 7d_ch: 9.52,
        # 24h_volume: "102899374056.0000000000000000",
        # 7d_volume: "1444394386948.000000000000000",
        # 24h_quoteVolume: "60901904450.9036000000000000",
        # 24h_highPrice: "0.6086000000000000",
        # 24h_lowPrice: "0.5780000000000000",
        # lastPrice: "0.5810000000000000",
        # lastQty: "0.5810000000000000",
        # lastTradeSide: "SELL",
        # bidVolume: "0",
        # askVolume: "0",
        # bidCount: 7052,
        # askCount: 6395,
        # direction: {
        # SELL: 60,
        # BUY: 40
        # },
        # 24h_tmnVolume: "60901904450.9036000000000000"
        # },
        # createdAt: "2023-05-24T00:00:00.000000Z",
        # isNew: False,
        # isZeroFee: False
        # },
        marketType = 'spot'
        stats = self.safe_value(ticker, 'stats')
        marketId = self.safe_string(ticker, 'symbol')
        symbol = self.safe_symbol(marketId, market, None, marketType)
        high = self.safe_float(stats, '24h_highPrice', 0)
        low = self.safe_float(stats, '24h_lowPrice', 0)
        bid = self.safe_float(stats, 'bidPrice', 0)
        ask = self.safe_float(stats, 'askPrice', 0)
        last = self.safe_float(stats, 'lastPrice', 0)
        quoteVolume = self.safe_float(stats, '24h_quoteVolume', 0)
        baseVolume = self.safe_float(stats, '24h_volume', 0)
        return self.safe_ticker({
            'symbol': symbol,
            'timestamp': None,
            'datetime': None,
            'high': high,
            'low': low,
            'bid': self.safe_string(bid, 0),
            'bidVolume': None,
            'ask': self.safe_string(ask, 0),
            'askVolume': None,
            'vwap': None,
            'open': None,
            'close': last,
            'last': last,
            'previousClose': None,
            'change': None,
            'percentage': None,
            'average': None,
            'baseVolume': baseVolume,
            'quoteVolume': quoteVolume,
            'info': ticker,
        }, market)

    async def fetch_ohlcv(self, symbol: str, timeframe='1m', since: Int = None, limit: Int = None, params={}) -> List[list]:
        """
        fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
        :see: https://api-docs.wallex.ir/#be8d9c51a2
        :param str symbol: unified symbol of the market to fetch OHLCV data for
        :param str timeframe: the length of time each candle represents
        :param int [since]: timestamp in ms of the earliest candle to fetch
        :param int [limit]: the maximum amount of candles to fetch
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns int[][]: A list of candles ordered, open, high, low, close, volume
        """
        await self.load_markets()
        market = self.market(symbol)
        endTime = Date.now()
        request = {
            'symbol': market['id'],
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
        response = await self.publicGetV1UdfHistory(request)
        openList = self.safe_value(response, 'o', [])
        highList = self.safe_list(response, 'h', [])
        lastList = self.safe_list(response, 'l', [])
        closeList = self.safe_list(response, 'c', [])
        volumeList = self.safe_list(response, 'v', [])
        timestampList = self.safe_list(response, 't', [])
        ohlcvs = []
        for i in range(0, len(openList)):
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
        :see: https://api-docs.wallex.ir/#be8d9c51a2
        :param str[]|None symbols: list of unified market symbols, all symbols fetched if None, default is None
        :param int [limit]: max number of entries per orderbook to return, default is None
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `order book structures <https://docs.ccxt.com/#/?id=order-book-structure>` indexed by market symbol
        """
        await self.load_markets()
        market = self.market(symbol)
        request = {
            'symbol': market['id'],
        }
        response = await self.publicGetV1Depth(request)
        orderBook = self.safe_dict(response, 'result', {})
        timestamp = Date.now()
        return self.parse_order_book(orderBook, symbol, timestamp, 'bid', 'ask', 'price', 'quantity')

    def sign(self, path, api='public', method='GET', params={}, headers=None, body=None):
        query = self.omit(params, self.extract_params(path))
        url = self.urls['api']['public'] + '/' + path
        if path == 'v1/udf/history':
            url = url + '?' + self.urlencode(query)
        if path == 'v1/depth':
            url = url + '?' + self.urlencode(query)
        headers = {'Content-Type': 'application/json'}
        return {'url': url, 'method': method, 'body': body, 'headers': headers}
