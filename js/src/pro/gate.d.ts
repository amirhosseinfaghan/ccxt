import gateRest from '../gate.js';
import type { Int, Str, Strings, OrderBook, Order, Trade, Ticker, Tickers, OHLCV, Position, Balances } from '../base/types.js';
import Client from '../base/ws/Client.js';
export default class gate extends gateRest {
    describe(): any;
    watchOrderBook(symbol: string, limit?: Int, params?: {}): Promise<OrderBook>;
    handleOrderBookSubscription(client: Client, message: any, subscription: any): void;
    handleOrderBook(client: Client, message: any): void;
    getCacheIndex(orderBook: any, cache: any): any;
    handleBidAsks(bookSide: any, bidAsks: any): void;
    handleDelta(orderbook: any, delta: any): void;
    watchTicker(symbol: string, params?: {}): Promise<Ticker>;
    watchTickers(symbols?: Strings, params?: {}): Promise<Tickers>;
    handleTicker(client: Client, message: any): void;
    watchTrades(symbol: string, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    watchTradesForSymbols(symbols: string[], since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    handleTrades(client: Client, message: any): void;
    watchOHLCV(symbol: string, timeframe?: string, since?: Int, limit?: Int, params?: {}): Promise<OHLCV[]>;
    handleOHLCV(client: Client, message: any): void;
    watchMyTrades(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    handleMyTrades(client: Client, message: any): void;
    watchBalance(params?: {}): Promise<Balances>;
    handleBalance(client: Client, message: any): void;
    watchPositions(symbols?: Strings, since?: Int, limit?: Int, params?: {}): Promise<Position[]>;
    setPositionsCache(client: Client, type: any, symbols?: Strings): void;
    loadPositionsSnapshot(client: any, messageHash: any, type: any): Promise<void>;
    handlePositions(client: any, message: any): void;
    watchOrders(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<Order[]>;
    handleOrder(client: Client, message: any): void;
    handleErrorMessage(client: Client, message: any): boolean;
    handleBalanceSubscription(client: Client, message: any, subscription?: any): void;
    handleSubscriptionStatus(client: Client, message: any): void;
    handleMessage(client: Client, message: any): void;
    getUrlByMarket(market: any): any;
    getTypeByMarket(market: any): "spot" | "futures" | "options";
    getUrlByMarketType(type: any, isInverse?: boolean): any;
    getMarketTypeByUrl(url: string): any;
    requestId(): any;
    subscribePublic(url: any, messageHash: any, payload: any, channel: any, params?: {}, subscription?: any): Promise<any>;
    subscribePrivate(url: any, messageHash: any, payload: any, channel: any, params: any, requiresUid?: boolean): Promise<any>;
}
