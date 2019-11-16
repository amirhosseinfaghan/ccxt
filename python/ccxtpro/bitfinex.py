# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

import ccxt.async_support as ccxt


class bitfinex(ccxt.bitfinex):

    def describe(self):
        return self.deep_extend(super(bitfinex, self).describe(), {
            'has': {
                'fetchWsTicker': True,
                'fetchWsOrderBook': True,
            },
            'urls': {
                'api': {
                    'wss': 'wss://api-pub.bitfinex.com/ws/2',
                },
            },
        })

    def get_ws_message_hash(self, client, response):
        if isinstance(response, list) and isinstance(response[1], list):
            return self.options['channels'][response[0]]

    async def fetch_ws_ticker(self, symbol, params={}):
        await self.load_markets()
        market = self.market(symbol)
        marketId = market['id']
        url = self.urls['api']['websocket']['public']
        return await self.WsTickerMessage(url, 'ticker/' + marketId, {
            'event': 'subscribe',
            'channel': 'ticker',
            'symbol': marketId,
        })

    def handle_ws_ticker(self, ticker):
        data = ticker[1]
        symbol = self.parse_symbol(ticker)
        return {
            'symbol': symbol,
            'bid': float(data[1]),
            'ask': float(data[2]),
            'change': float(data[4]),
            'percent': float(data[5]),
            'last': float(data[6]),
            'volume': float(data[7]),
            'high': float(data[8]),
            'low': float(data[9]),
            'info': data,
        }

    async def fetch_ws_order_book(self, symbol, limit=None, params={}):
        await self.load_markets()
        market = self.market(symbol)
        marketId = market['id']
        url = self.urls['api']['websocket']['public']
        return await self.WsOrderBookMessage(url, 'book/' + marketId, {
            'event': 'subscribe',
            'channel': 'book',
            'symbol': marketId,
        })

    def handle_ws_order_book(self, orderBook):
        data = orderBook[1]
        deltas = data if isinstance(data[0], list) else [data]
        bids = []
        asks = []
        for i in range(0, len(deltas)):
            delta = deltas[i]
            price = float(delta[0])
            amount = float(delta[2])
            count = int(delta[1])
            if amount < 0:
                amount = -amount
                asks.append([price, amount, count])
            else:
                bids.append([price, amount, count])
        symbol = self.parse_symbol(orderBook)
        # if not (symbol in list(self.orderBooks.keys())):
        #     self.orderBooks[symbol] = IncrementalOrderBook()
        # }
        nonce = None
        timestamp = None
        return self.orderBooks[symbol].update(nonce, timestamp, bids, asks)

    def parse_delta(self, delta):
        price = float(delta[0])
        amount = float(delta[2])
        count = int(delta[1])
        side = None
        if amount < 0:
            side = 'asks'
            amount = -amount
        else:
            side = 'bids'
        operation = 'add'
        if count == 0:
            operation = 'delete'
        return [None, operation, side, price, amount]

    def handle_ws_dropped(self, client, message, messageHash):
        if self.safe_string(message, 'event') == 'subscribed':
            channel = message['channel']
            marketId = message['pair']
            channelId = message['chanId']
            self.options['channels'][channelId] = channel + '/' + marketId
            return
        if messageHash is not None and messageHash.startsWith('book'):
            self.handle_ws_order_book(message)

    def parse_symbol(self, message):
        channelId = message[0]
        marketId = self.options['channels'][channelId].split('/')[1]
        return self.marketsById[marketId]['symbol']
