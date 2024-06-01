# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.async_support.base.exchange import Exchange
from ccxt.abstract.eterex import ImplicitAPI
from ccxt.base.types import Market, Strings, Ticker, Tickers
from typing import List


class eterex(Exchange, ImplicitAPI):

    def describe(self):
        return self.deep_extend(super(eterex, self).describe(), {
            'id': 'eterex',
            'name': 'Eterex',
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
                'fetchOHLCV': False,
                'fetchOpenInterestHistory': False,
                'fetchOpenOrders': False,
                'fetchOrder': False,
                'fetchOrderBook': False,
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
                    'tierBased': False,
                    'percentage': True,
                    'maker': self.parse_number('0.001'),
                    'taker': self.parse_number('0.001'),
                },
            },
        })

    async def fetch_markets(self, symbols: Strings = None, params={}) -> List[Market]:
        """
        retrieves data on all markets for eterex
        :see: https://reward.eterex.com
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict[]: an array of objects representing market data
        """
        response = await self.publicGetAdRates(params)
        markets = self.safe_dict(response, 'markets')
        marketKeys = list(markets.keys())
        result = []
        for i in range(0, len(marketKeys)):
            index = marketKeys[i]
            market = await self.parse_market(markets[index])
            result.append(market)
        return result

    def parse_market(self, market) -> Market:
        #  {
        #     'sell_price': 4001252619,
        #     'buy_price': 3960630765,
        #     'base': 'BTC',
        #     'quote': 'IRT',
        #     'sell_max': 9000,
        #     'buy_max': 9000,
        #     'sell_active': True,
        #     'buy_active': True,
        #     '24h_volume': 44734409872.22664,
        # },
        baseId = self.safe_string(market, 'base')
        quoteId = self.safe_string(market, 'quote')
        base = self.safe_currency_code(baseId)
        quote = self.safe_currency_code(quoteId)
        id = base + quote
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
        :see: https://reward.eterex.com
        :param str[]|None symbols: unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `ticker structures <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        await self.load_markets()
        if symbols is not None:
            symbols = self.market_symbols(symbols)
        response = await self.publicGetAdRates(params)
        markets = self.safe_dict(response, 'markets')
        marketKeys = list(markets.keys())
        result = {}
        for i in range(0, len(marketKeys)):
            index = marketKeys[i]
            markets[index]['symbol'] = index
            ticker = await self.parse_ticker(markets[index])
            symbol = ticker['symbol']
            result[symbol] = ticker
        return self.filter_by_array_tickers(result, 'symbol', symbols)

    async def fetch_ticker(self, symbol: str, params={}) -> Ticker:
        """
        fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
        :see: https://reward.eterex.com
        :param str symbol: unified symbol of the market to fetch the ticker for
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a `ticker structure <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        await self.load_markets()
        market = self.market(symbol)
        response = await self.publicGetAdRates(params)
        markets = self.safe_dict(response, 'markets')
        markets[market['id']]['symbol'] = market['id']
        ticker = await self.parse_ticker(markets[market['id']])
        return ticker

    def parse_ticker(self, ticker, market: Market = None) -> Ticker:
        #  {
        #     'sell_price': 4001252619,
        #     'buy_price': 3960630765,
        #     'base': 'BTC',
        #     'quote': 'IRT',
        #     'sell_max': 9000,
        #     'buy_max': 9000,
        #     'sell_active': True,
        #     'buy_active': True,
        #     '24h_volume': 44734409872.22664,
        # },
        marketType = 'otc'
        marketId = self.safe_string(ticker, 'symbol')
        symbol = self.safe_symbol(marketId, market, None, marketType)
        high = self.safe_float(ticker, 'sell_price', 0)
        low = self.safe_float(ticker, 'buy_price', 0)
        bid = self.safe_float(ticker, 'sell_price', 0)
        ask = self.safe_float(ticker, 'buy_price', 0)
        last = self.safe_float(ticker, 'buy_price', 0)
        quoteVolume = self.safe_float(ticker, '24h_volume', 0)
        return self.safe_ticker({
            'symbol': symbol,
            'timestamp': None,
            'datetime': None,
            'high': high,
            'low': low,
            'bid': bid,
            'bidVolume': None,
            'ask': ask,
            'askVolume': None,
            'vwap': None,
            'open': None,
            'close': last,
            'last': last,
            'previousClose': None,
            'change': None,
            'percentage': None,
            'average': None,
            'baseVolume': None,
            'quoteVolume': quoteVolume,
            'info': ticker,
        }, market)

    def sign(self, path, api='public', method='GET', params={}, headers=None, body=None):
        url = self.urls['api']['public'] + '/' + path
        headers = {'Content-Type': 'application/json'}
        return {'url': url, 'method': method, 'body': body, 'headers': headers}
