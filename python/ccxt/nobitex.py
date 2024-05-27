# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.base.exchange import Exchange
from ccxt.abstract.nobitex import ImplicitAPI
from ccxt.base.types import Int, Market, OrderBook, Strings, Ticker, Tickers
from typing import List


class nobitex(Exchange, ImplicitAPI):

    def describe(self):
        return self.deep_extend(super(nobitex, self).describe(), {
            'id': 'nobitex',
            'name': 'Nobitex',
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
                'logo': 'https://cdn.arz.digital/cr-odin/img/exchanges/nobitex/64x64.png',
                'api': {
                    'public': 'https://api.nobitex.ir',
                },
                'www': 'https://nobitex.ir/',
                'doc': [
                    'https://apidocs.nobitex.ir',
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
                '6h': '360',
                '12h': '720',
                '1d': 'D',
                '2d': '2D',
                '3d': '3D',
            },
            'api': {
                'public': {
                    'get': {
                        'market/stats': 1,
                        'market/udf/history': 1,
                        'v2/orderbook': 1,
                    },
                },
            },
            'commonCurrencies': {
                'RLS': 'IRT',
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
        retrieves data on all markets for nobitex
        :see: https://apidocs.nobitex.ir/#6ae2dae4a2
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict[]: an array of objects representing market data
        """
        request = {
            'srcCurrency': 'btc,usdt,eth,etc,doge,ada,bch,ltc,bnb,eos,xlm,xrp,trx,uni,link,dai,dot,shib,aave,ftm,matic,axs,mana,sand,avax,usdc,gmt,mkr,sol,atom,grt,bat,near,ape,qnt,chz,xmr,egala,busd,algo,hbar,1inch,yfi,flow,snx,enj,crv,fil,wbtc,ldo,dydx,apt,mask,comp,bal,lrc,lpt,ens,sushi,api3,one,glm,pmn,dao,cvc,nmr,storj,snt,ant,zrx,slp,egld,imx,blur,100k_floki,1b_babydoge,1m_nft,1m_btt,t,celr,arb,magic,gmx,band,cvx,ton,ssv,mdt,omg,wld,rdnt,jst,bico,rndr,woo,skl,gal,agix,fet,not,xtz,agld,trb,rsr,ethfi',
            'dstCurrency': 'rls,usdt',
        }
        response = self.publicGetMarketStats(request)
        markets = self.safe_dict(response, 'stats')
        marketKeys = list(markets.keys())
        result = []
        for i in range(0, len(marketKeys)):
            symbol = marketKeys[i]
            markets[symbol]['symbol'] = symbol
            market = self.parse_market(markets[symbol])
            result.append(market)
        return result

    def parse_market(self, market) -> Market:
        #        {
        # symbol: btc-usdt
        # isClosed: False,
        # bestSell: "39659550020",
        # bestBuy: "39650000000",
        # volumeSrc: "11.6924501388",
        # volumeDst: "464510376461.05263193275",
        # latest: "39659550020",
        # mark: "39817678220",
        # dayLow: "38539978000",
        # dayHigh: "40809999990",
        # dayOpen: "38553149810",
        # dayClose: "39659550020",
        # dayChange: "2.87"
        # },
        symbol = self.safe_string_upper(market, 'symbol')
        id = symbol.replace('-', '')
        baseId, quoteId = symbol.split('-')
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
        :see: https://apidocs.nobitex.ir/#6ae2dae4a2
        :param str[]|None symbols: unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `ticker structures <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        self.load_markets()
        if symbols is not None:
            symbols = self.market_symbols(symbols)
        request = {
            'srcCurrency': 'btc,usdt,eth,etc,doge,ada,bch,ltc,bnb,eos,xlm,xrp,trx,uni,link,dai,dot,shib,aave,ftm,matic,axs,mana,sand,avax,usdc,gmt,mkr,sol,atom,grt,bat,near,ape,qnt,chz,xmr,egala,busd,algo,hbar,1inch,yfi,flow,snx,enj,crv,fil,wbtc,ldo,dydx,apt,mask,comp,bal,lrc,lpt,ens,sushi,api3,one,glm,pmn,dao,cvc,nmr,storj,snt,ant,zrx,slp,egld,imx,blur,100k_floki,1b_babydoge,1m_nft,1m_btt,t,celr,arb,magic,gmx,band,cvx,ton,ssv,mdt,omg,wld,rdnt,jst,bico,rndr,woo,skl,gal,agix,fet,not,xtz,agld,trb,rsr,ethfi',
            'dstCurrency': 'rls,usdt',
        }
        response = self.publicGetMarketStats(request)
        markets = self.safe_dict(response, 'stats')
        marketKeys = list(markets.keys())
        result = []
        for i in range(0, len(marketKeys)):
            symbol = marketKeys[i]
            markets[symbol]['symbol'] = symbol
            ticker = self.parse_ticker(markets[symbol])
            symbol = ticker['symbol']
            result[symbol] = ticker
        return self.filter_by_array_tickers(result, 'symbol', symbols)

    def fetch_ticker(self, symbol: str, params={}) -> Ticker:
        """
        fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
        :see: https://apidocs.nobitex.ir/#6ae2dae4a2
        :param str symbol: unified symbol of the market to fetch the ticker for
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a `ticker structure <https://docs.ccxt.com/#/?id=ticker-structure>`
        """
        ticker = self.fetch_tickers([symbol])
        return ticker[symbol]

    def parse_ticker(self, ticker, market: Market = None) -> Ticker:
        #
        #     {
        #      symbol: "USDT-IRT",
        #      last: "61338.0",
        #      best_ask: "61338.0",
        #      best_bid: "61338.0",
        #      open_24h: "61419",
        #      high_24h: 61739,
        #      low_24h: 60942,
        #      vol_24h_pair: 11017655160,
        #      vol_24h: 17968,
        #      ts: 1715074621
        #     }
        #
        marketType = 'spot'
        symbol = self.safe_string_upper(ticker, 'symbol')
        marketId = symbol.replace('-', '')
        marketinfo = self.market(marketId)
        symbol = self.safe_symbol(marketId, market, None, marketType)
        high = self.safe_float(ticker, 'dayHigh')
        low = self.safe_float(ticker, 'dayLow')
        bid = self.safe_float(ticker, 'bestBuy')
        ask = self.safe_float(ticker, 'bestSell')
        open = self.safe_float(ticker, 'dayOpen')
        close = self.safe_float(ticker, 'dayClose')
        change = self.safe_float(ticker, 'dayChange')
        last = self.safe_float(ticker, 'latest')
        quoteVolume = self.safe_float(ticker, 'volumeDst')
        baseVolume = self.safe_float(ticker, 'volumeSrc')
        if marketinfo['quote'] == 'IRT':
            high /= 10
            low /= 10
            bid /= 10
            ask /= 10
            open /= 10
            close /= 10
            last /= 10
            quoteVolume /= 10
        return self.safe_ticker({
            'symbol': symbol.replace('-', '/'),
            'timestamp': None,
            'datetime': None,
            'high': high,
            'low': low,
            'bid': self.safe_float(bid, 0),
            'bidVolume': None,
            'ask': self.safe_float(ask, 0),
            'askVolume': None,
            'vwap': None,
            'open': open,
            'close': close,
            'last': last,
            'previousClose': None,
            'change': change,
            'percentage': None,
            'average': None,
            'baseVolume': baseVolume,
            'quoteVolume': quoteVolume,
            'info': ticker,
        }, market)

    def fetch_ohlcv(self, symbol: str, timeframe='1m', since: Int = None, limit: Int = None, params={}) -> List[list]:
        """
        fetches historical candlestick data containing the open, high, low, and close price, and the volume of a market
        :see: https://apidocs.nobitex.ir/#ohlc
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
        response = self.publicGetMarketUdfHistory(request)
        openList = self.safe_value(response, 'o', [])
        highList = self.safe_list(response, 'h', [])
        lowList = self.safe_list(response, 'l', [])
        closeList = self.safe_list(response, 'c', [])
        volumeList = self.safe_list(response, 'v', [])
        timestampList = self.safe_list(response, 't', [])
        ohlcvs = []
        for i in range(0, len(openList)):
            if market['quote'] == 'IRT':
                openList[i] /= 10
                highList[i] /= 10
                lowList[i] /= 10
                closeList[i] /= 10
                volumeList[i] /= 10
            ohlcvs.append([
                timestampList[i],
                openList[i],
                highList[i],
                lowList[i],
                closeList[i],
                volumeList[i],
            ])
        return self.parse_ohlcvs(ohlcvs, market, timeframe, since, limit)

    def fetch_order_book(self, symbol: str, limit: Int = None, params={}) -> OrderBook:
        """
        fetches information on open orders with bid(buy) and ask(sell) prices, volumes and other data for multiple markets
        :see: https://apidocs.nobitex.ir/#orderbook
        :param str[]|None symbols: list of unified market symbols, all symbols fetched if None, default is None
        :param int [limit]: max number of entries per orderbook to return, default is None
        :param dict [params]: extra parameters specific to the exchange API endpoint
        :returns dict: a dictionary of `order book structures <https://docs.ccxt.com/#/?id=order-book-structure>` indexed by market symbol
        """
        self.load_markets()
        market = self.market(symbol)
        request = {
            'symbol': symbol.replace('/', ''),
        }
        response = self.publicGetV2Orderbook(request)
        if market['quote'] == 'IRT':
            bids = self.safe_list(response, 'bids')
            asks = self.safe_list(response, 'asks')
            for i in range(0, len(bids)):
                bids[i][0] /= 10
            for i in range(0, len(asks)):
                asks[i][0] /= 10
            response['bids'] = bids
            response['asks'] = asks
        timestamp = self.safe_integer(response, 'lastUpdate')
        return self.parse_order_book(response, symbol, timestamp)

    def sign(self, path, api='public', method='GET', params={}, headers=None, body=None):
        query = self.omit(params, self.extract_params(path))
        url = self.urls['api']['public'] + '/' + path
        if path == 'market/udf/history':
            url = self.urls['api']['public'] + '/' + path + '?' + self.urlencode(query)
        if path == 'market/stats':
            url = url + '?' + self.urlencode(query)
        if path == 'v2/orderbook':
            url = url + '/' + params['symbol']
        headers = {'Content-Type': 'application/json'}
        return {'url': url, 'method': method, 'body': body, 'headers': headers}
