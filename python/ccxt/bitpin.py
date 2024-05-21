# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.base.exchange import Exchange
from ccxt.abstract.bitpin import ImplicitAPI
from ccxt.base.types import Int, Market, OrderBook, Strings, Ticker, Tickers
from typing import List


class bitpin(Exchange, ImplicitAPI):

    def describe(self):
        return self.deep_extend(super(bitpin, self).describe(), {
            'id': 'bitpin',
            'name': 'bitpin',
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
                    'tierBased': False,
                    'percentage': True,
                    'maker': self.parse_number('0.001'),
                    'taker': self.parse_number('0.001'),
                },
            },
        })

    def fetch_markets(self, symbols: Strings = None, params={}) -> List[Market]:
        """
        retrieves data on all markets for bitpin
        :see: https://api-docs.bitpin.ir/#be8d9c51a2
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict[]: an array of objects representing market data
        """
        response = self.publicGetV1MktMarkets(params)
        markets = self.safe_dict(response, 'results')
        result = []
        for i in range(0, len(markets)):
            market = self.parse_market(markets[i])
            result.append(market)
        return result

    def parse_market(self, market) -> Market:
        id = self.safe_string(market, 'id')
        baseCurrency = self.safe_dict(market, 'currency1')
        quoteCurrency = self.safe_dict(market, 'currency2')
        baseId = self.safe_string(baseCurrency, 'code')
        quoteId = self.safe_string(quoteCurrency, 'code')
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

    def fetch_tickers(self, symbols: Strings = None, params={}) -> Tickers:
        """
        fetches price tickers for multiple markets, statistical information calculated over the past 24 hours for each market
        :see: https://api-docs.bitpin.ir/#be8d9c51a2
        :param str[]|None symbols: unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `ticker structures <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        self.load_markets()
        if symbols is not None:
            symbols = self.market_symbols(symbols)
        response = self.publicGetV1MktMarkets(params)
        markets = self.safe_dict(response, 'results')
        result = {}
        for i in range(0, len(markets)):
            is_active = self.safe_bool(markets[i], 'tradable')
            if is_active is True:
                ticker = self.parse_ticker(markets[i])
                symbol = ticker['symbol']
                result[symbol] = ticker
        return self.filter_by_array_tickers(result, 'symbol', symbols)

    def fetch_ticker(self, symbol: str, params={}) -> Ticker:
        """
        fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
        :see: https://api-docs.bitpin.ir/#be8d9c51a2
        :param str symbol: unified symbol of the market to fetch the ticker for
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a `ticker structure <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        ticker = self.fetch_tickers([symbol])
        return ticker[symbol]

    def parse_ticker(self, ticker, market: Market = None) -> Ticker:
        # {
        #     'id': 1,
        #     'currency1': {
        #         'id': 1,
        #         'title': 'Bitcoin',
        #         'title_fa': 'بیت کوین',
        #         'code': 'BTC',
        #         'tradable': True,
        #         'for_test': False,
        #         'image': 'https://cdn.bitpin.ir/media/market/currency/1697370601.svg',
        #         'decimal': 2,
        #         'decimal_amount': 8,
        #         'decimal_irt': 0,
        #         'color': 'f7931a',
        #         'high_risk': False,
        #         'show_high_risk': False,
        #         'withdraw_commission': '0.003000000000000000',
        #         'tags': [
        #             {
        #                 'id': 44,
        #                 'name': 'لایه ۱',
        #                 'name_en': 'layer-1',
        #                 'has_chart': True,
        #             },
        #             {
        #                 'id': 52,
        #                 'name': 'اثبات کار',
        #                 'name_en': 'pow',
        #                 'has_chart': True,
        #             },
        #         ],
        #         'etf': False,
        #         'for_binvest': False,
        #         'for_loan': True,
        #         'for_stake': False,
        #         'recommend_for_deposit_weight': 1,
        #     },
        #     'currency2': {
        #         'id': 2,
        #         'title': 'Toman',
        #         'title_fa': 'تومان',
        #         'code': 'IRT',
        #         'tradable': True,
        #         'for_test': False,
        #         'image': 'https://cdn.bitpin.ir/media/market/currency/1684671406.svg',
        #         'decimal': 0,
        #         'decimal_amount': 0,
        #         'decimal_irt': 1,
        #         'color': '00fd22',
        #         'high_risk': False,
        #         'show_high_risk': False,
        #         'withdraw_commission': '0.000200000000000000',
        #         'tags': [],
        #         'etf': False,
        #         'for_binvest': False,
        #         'for_loan': False,
        #         'for_stake': False,
        #         'recommend_for_deposit_weight': 0,
        #     },
        #     'tradable': True,
        #     'for_test': False,
        #     'otc_sell_percent': '0.01000',
        #     'otc_buy_percent': '0.01000',
        #     'otc_max_buy_amount': '0.017000000000000000',
        #     'otc_max_sell_amount': '0.017000000000000000',
        #     'order_book_info': {
        #         'created_at': null,
        #         'price': '3894924262',
        #         'change': 0.0179,
        #         'min': '3777777800',
        #         'max': '3925000000',
        #         'time': '2024-05-19T13:45:00.000Z',
        #         'mean': '3833950912',
        #         'value': '6215833783',
        #         'amount': '1.62286922',
        #     },
        #     'internal_price_info': {
        #         'created_at': 1716126301.298626,
        #         'price': '3894924262',
        #         'change': 1.8,
        #         'min': '3777777800',
        #         'max': '3925000000',
        #         'time': null,
        #         'mean': null,
        #         'value': null,
        #         'amount': null,
        #     },
        #     'price_info': {
        #         'created_at': 1716126370.677,
        #         'price': '3906940950',
        #         'change': 2.04,
        #         'min': '3785113135',
        #         'max': '3921003333',
        #         'time': null,
        #         'mean': null,
        #         'value': null,
        #         'amount': null,
        #     },
        #     'price': '3906940950',
        #     'title': 'Bitcoin/Toman',
        #     'code': 'BTC_IRT',
        #     'title_fa': 'بیت کوین/تومان',
        #     'trading_view_source': 'BINANCE',
        #     'trading_view_symbol': 'BTCUSDT',
        #     'otc_market': False,
        #     'text': '',
        #     'volume_24h': '2318294704054686.000000000000000000',
        #     'market_cap': '43370130583253964.000000000000000000',
        #     'circulating_supply': '19588837.000000000000000000',
        #     'all_time_high': '3577014315.000000000000000000',
        #     'popularity_weight': 0,
        #     'freshness_weight': 0,
        # }
        marketType = 'spot'
        priceInfo = self.safe_value(ticker, 'order_book_info')
        marketId = self.safe_string(ticker, 'id')
        symbol = self.safe_symbol(marketId, market, None, marketType)
        high = self.safe_float(priceInfo, 'max', 0)
        low = self.safe_float(priceInfo, 'min', 0)
        last = self.safe_float(priceInfo, 'lastPrice', 0)
        change = self.safe_float(priceInfo, 'change', 0)
        quoteVolume = self.safe_float(priceInfo, '24h_quoteVolume', 0)
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
            'open': None,
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

    def fetch_ohlcv(self, symbol: str, timeframe='1m', since: Int = None, limit: Int = None, params={}) -> List[list]:
        """
        fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
        :see: https://api-docs.bitpin.ir/#be8d9c51a2
        :param str symbol: unified symbol of the market to fetch OHLCV data for
        :param str timeframe: the length of time each candle represents
        :param int [since]: timestamp in ms of the earliest candle to fetch
        :param int [limit]: the maximum amount of candles to fetch
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns int[][]: A list of candles ordered, open, high, low, close, volume
        """
        self.load_markets()
        market = self.market(symbol)
        endTime = Date.now()
        request = {
            'symbol': market['symbol'].replace('/', '_'),
            'from': (endTime / 1000) - (24 * 60 * 60),
            'to': endTime / 1000,
            'res': self.safe_string(self.timeframes, timeframe, timeframe),
        }
        if since is not None:
            request['from'] = since / 1000
        request['from'] = self.safe_integer(request, 'from')
        request['to'] = self.safe_integer(request, 'to')
        if timeframe is not None:
            request['res'] = self.safe_string(self.timeframes, timeframe, timeframe)
        response = self.publicGetV1MktTvGetBars(request)
        ohlcvs = []
        for i in range(0, len(response)):
            ohlcvs.append([
                self.safe_value(response[i], 'ts'),
                self.safe_float(response[i], 'open'),
                self.safe_float(response[i], 'high'),
                self.safe_float(response[i], 'low'),
                self.safe_float(response[i], 'close'),
                self.safe_float(response[i], 'volume'),
            ])
        return self.parse_ohlcvs(ohlcvs, market, timeframe, since, limit)

    def fetch_order_book(self, symbol: str, limit: Int = None, params={}) -> OrderBook:
        """
        fetches information on open orders with bid(buy) and ask(sell) prices, volumes and other data for multiple markets
        :see: https://api-docs.bitpin.ir/#be8d9c51a2
        :param str[]|None symbols: list of unified market symbols, all symbols fetched if None, default is None
        :param int [limit]: max number of entries per orderbook to return, default is None
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `order book structures <https://docs.ccxt.com/#/?id=order-book-structure>` indexed by market symbol
        """
        self.load_markets()
        market = self.market(symbol)
        request = {
            'symbol': market['id'],
            'type': 'buy',
        }
        Buyresponse = self.publicGetV2MthActives(request)
        request['type'] = 'sell'
        Sellresponse = self.publicGetV2MthActives(request)
        BuyorderBook = self.safe_dict(Buyresponse, 'orders', {})
        SellorderBook = self.safe_dict(Sellresponse, 'orders', {})
        orderBook = {'bid': BuyorderBook, 'ask': SellorderBook}
        timestamp = Date.now()
        return self.parse_order_book(orderBook, symbol, timestamp, 'bid', 'ask', 'price', 'amount')

    def sign(self, path, api='public', method='GET', params={}, headers=None, body=None):
        query = self.omit(params, self.extract_params(path))
        url = self.urls['api'][api] + '/' + path
        if path == 'v1/mkt/tv/get_bars/':
            url = self.urls['api']['OHLCV'] + '/' + path + '?' + self.urlencode(query)
        if path == 'v2/mth/actives/':
            url = url + params['symbol'] + '/?type=' + params['type']
        headers = {'Content-Type': 'application/json'}
        return {'url': url, 'method': method, 'body': body, 'headers': headers}
