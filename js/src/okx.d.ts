import Exchange from './abstract/okx.js';
import type { TransferEntry, Int, OrderSide, OrderType, Trade, OHLCV, Order, FundingRateHistory, OrderRequest, FundingHistory, Str, Transaction, Ticker, OrderBook, Balances, Tickers, Market, Greeks, Strings, MarketInterface, Currency, Leverage, Num, Account, OptionChain, Option, MarginModification, TradingFeeInterface, Currencies, Conversion, CancellationRequest, Dict, Position, CrossBorrowRate, CrossBorrowRates, TransferEntries } from './base/types.js';
/**
 * @class okx
 * @augments Exchange
 */
export default class okx extends Exchange {
    describe(): any;
    handleMarketTypeAndParams(methodName: string, market?: Market, params?: {}, defaultValue?: any): any;
    convertToInstrumentType(type: any): string;
    createExpiredOptionMarket(symbol: string): MarketInterface;
    safeMarket(marketId?: Str, market?: Market, delimiter?: Str, marketType?: Str): MarketInterface;
    fetchStatus(params?: {}): Promise<{
        updated: any;
        status: string;
        eta: any;
        url: any;
        info: any;
    }>;
    fetchTime(params?: {}): Promise<number>;
    fetchAccounts(params?: {}): Promise<Account[]>;
    fetchMarkets(params?: {}): Promise<Market[]>;
    parseMarket(market: any): Market;
    fetchMarketsByType(type: any, params?: {}): Promise<MarketInterface[]>;
    safeNetwork(networkId: any): string;
    fetchCurrencies(params?: {}): Promise<Currencies>;
    fetchOrderBook(symbol: string, limit?: Int, params?: {}): Promise<OrderBook>;
    parseTicker(ticker: Dict, market?: Market): Ticker;
    fetchTicker(symbol: string, params?: {}): Promise<Ticker>;
    fetchTickers(symbols?: Strings, params?: {}): Promise<Tickers>;
    parseTrade(trade: any, market?: Market): Trade;
    fetchTrades(symbol: string, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    parseOHLCV(ohlcv: any, market?: Market): OHLCV;
    fetchOHLCV(symbol: string, timeframe?: string, since?: Int, limit?: Int, params?: {}): Promise<OHLCV[]>;
    fetchFundingRateHistory(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<FundingRateHistory[]>;
    parseBalanceByType(type: any, response: any): Balances;
    parseTradingBalance(response: any): Balances;
    parseFundingBalance(response: any): Balances;
    parseTradingFee(fee: any, market?: Market): TradingFeeInterface;
    fetchTradingFee(symbol: string, params?: {}): Promise<TradingFeeInterface>;
    fetchBalance(params?: {}): Promise<Balances>;
    createMarketBuyOrderWithCost(symbol: string, cost: number, params?: {}): Promise<Order>;
    createMarketSellOrderWithCost(symbol: string, cost: number, params?: {}): Promise<Order>;
    createOrderRequest(symbol: string, type: OrderType, side: OrderSide, amount: number, price?: Num, params?: {}): any;
    createOrder(symbol: string, type: OrderType, side: OrderSide, amount: number, price?: Num, params?: {}): Promise<Order>;
    createOrders(orders: OrderRequest[], params?: {}): Promise<Order[]>;
    editOrderRequest(id: string, symbol: any, type: any, side: any, amount?: any, price?: any, params?: {}): any;
    editOrder(id: string, symbol: string, type: OrderType, side: OrderSide, amount?: Num, price?: Num, params?: {}): Promise<Order>;
    cancelOrder(id: string, symbol?: Str, params?: {}): Promise<any>;
    parseIds(ids: any): any;
    cancelOrders(ids: any, symbol?: Str, params?: {}): Promise<Order[]>;
    cancelOrdersForSymbols(orders: CancellationRequest[], params?: {}): Promise<Order[]>;
    cancelAllOrdersAfter(timeout: Int, params?: {}): Promise<any>;
    parseOrderStatus(status: any): string;
    parseOrder(order: any, market?: Market): Order;
    fetchOrder(id: string, symbol?: Str, params?: {}): Promise<Order>;
    fetchOpenOrders(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<Order[]>;
    fetchCanceledOrders(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<Order[]>;
    fetchClosedOrders(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<Order[]>;
    fetchMyTrades(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    fetchOrderTrades(id: string, symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    fetchLedger(code?: Str, since?: Int, limit?: Int, params?: {}): Promise<any>;
    parseLedgerEntryType(type: any): string;
    parseLedgerEntry(item: any, currency?: Currency): {
        id: string;
        info: any;
        timestamp: number;
        datetime: string;
        account: any;
        referenceId: string;
        referenceAccount: any;
        type: string;
        currency: string;
        symbol: string;
        amount: number;
        before: any;
        after: number;
        status: string;
        fee: any;
    };
    parseDepositAddress(depositAddress: any, currency?: Currency): {
        currency: string;
        address: string;
        tag: string;
        network: string;
        info: any;
    };
    fetchDepositAddressesByNetwork(code: string, params?: {}): Promise<import("./base/types.js").Dictionary<any>>;
    fetchDepositAddress(code: string, params?: {}): Promise<any>;
    withdraw(code: string, amount: number, address: string, tag?: any, params?: {}): Promise<Transaction>;
    fetchDeposits(code?: Str, since?: Int, limit?: Int, params?: {}): Promise<Transaction[]>;
    fetchDeposit(id: string, code?: Str, params?: {}): Promise<Transaction>;
    fetchWithdrawals(code?: Str, since?: Int, limit?: Int, params?: {}): Promise<Transaction[]>;
    fetchWithdrawal(id: string, code?: Str, params?: {}): Promise<Transaction>;
    parseTransactionStatus(status: any): string;
    parseTransaction(transaction: any, currency?: Currency): Transaction;
    fetchLeverage(symbol: string, params?: {}): Promise<Leverage>;
    parseLeverage(leverage: Dict, market?: Market): Leverage;
    fetchPosition(symbol: string, params?: {}): Promise<Position>;
    fetchPositions(symbols?: Strings, params?: {}): Promise<Position[]>;
    fetchPositionsForSymbol(symbol: string, params?: {}): Promise<Position[]>;
    parsePosition(position: any, market?: Market): Position;
    transfer(code: string, amount: number, fromAccount: string, toAccount: string, params?: {}): Promise<TransferEntry>;
    parseTransfer(transfer: Dict, currency?: Currency): TransferEntry;
    parseTransferStatus(status: Str): Str;
    fetchTransfer(id: string, code?: Str, params?: {}): Promise<TransferEntry>;
    fetchTransfers(code?: Str, since?: Int, limit?: Int, params?: {}): Promise<TransferEntries>;
    sign(path: any, api?: string, method?: string, params?: {}, headers?: any, body?: any): {
        url: string;
        method: string;
        body: any;
        headers: any;
    };
    parseFundingRate(contract: any, market?: Market): {
        info: any;
        symbol: string;
        markPrice: any;
        indexPrice: any;
        interestRate: number;
        estimatedSettlePrice: any;
        timestamp: any;
        datetime: any;
        fundingRate: number;
        fundingTimestamp: number;
        fundingDatetime: string;
        nextFundingRate: number;
        nextFundingTimestamp: number;
        nextFundingDatetime: string;
        previousFundingRate: any;
        previousFundingTimestamp: any;
        previousFundingDatetime: any;
    };
    fetchFundingRate(symbol: string, params?: {}): Promise<{
        info: any;
        symbol: string;
        markPrice: any;
        indexPrice: any;
        interestRate: number;
        estimatedSettlePrice: any;
        timestamp: any;
        datetime: any;
        fundingRate: number;
        fundingTimestamp: number;
        fundingDatetime: string;
        nextFundingRate: number;
        nextFundingTimestamp: number;
        nextFundingDatetime: string;
        previousFundingRate: any;
        previousFundingTimestamp: any;
        previousFundingDatetime: any;
    }>;
    fetchFundingHistory(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<FundingHistory[]>;
    setLeverage(leverage: Int, symbol?: Str, params?: {}): Promise<any>;
    fetchPositionMode(symbol?: Str, params?: {}): Promise<{
        info: any;
        hedged: boolean;
    }>;
    setPositionMode(hedged: boolean, symbol?: Str, params?: {}): Promise<any>;
    setMarginMode(marginMode: string, symbol?: Str, params?: {}): Promise<any>;
    fetchCrossBorrowRates(params?: {}): Promise<CrossBorrowRates>;
    fetchCrossBorrowRate(code: string, params?: {}): Promise<CrossBorrowRate>;
    parseBorrowRate(info: any, currency?: Currency): {
        currency: string;
        rate: number;
        period: number;
        timestamp: number;
        datetime: string;
        info: any;
    };
    parseBorrowRateHistories(response: any, codes: any, since: any, limit: any): {};
    parseBorrowRateHistory(response: any, code: any, since: any, limit: any): any;
    fetchBorrowRateHistories(codes?: any, since?: Int, limit?: Int, params?: {}): Promise<{}>;
    fetchBorrowRateHistory(code: string, since?: Int, limit?: Int, params?: {}): Promise<any>;
    modifyMarginHelper(symbol: string, amount: any, type: any, params?: {}): Promise<MarginModification>;
    parseMarginModification(data: Dict, market?: Market): MarginModification;
    reduceMargin(symbol: string, amount: number, params?: {}): Promise<MarginModification>;
    addMargin(symbol: string, amount: number, params?: {}): Promise<MarginModification>;
    fetchMarketLeverageTiers(symbol: string, params?: {}): Promise<any[]>;
    parseMarketLeverageTiers(info: any, market?: Market): any[];
    fetchBorrowInterest(code?: Str, symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<any>;
    parseBorrowInterest(info: any, market?: Market): {
        symbol: string;
        marginMode: string;
        currency: string;
        interest: number;
        interestRate: number;
        amountBorrowed: number;
        timestamp: number;
        datetime: string;
        info: any;
    };
    borrowCrossMargin(code: string, amount: number, params?: {}): Promise<{
        id: any;
        currency: string;
        amount: number;
        symbol: any;
        timestamp: any;
        datetime: any;
        info: any;
    }>;
    repayCrossMargin(code: string, amount: any, params?: {}): Promise<{
        id: any;
        currency: string;
        amount: number;
        symbol: any;
        timestamp: any;
        datetime: any;
        info: any;
    }>;
    parseMarginLoan(info: any, currency?: Currency): {
        id: any;
        currency: string;
        amount: number;
        symbol: any;
        timestamp: any;
        datetime: any;
        info: any;
    };
    fetchOpenInterest(symbol: string, params?: {}): Promise<import("./base/types.js").OpenInterest>;
    fetchOpenInterestHistory(symbol: string, timeframe?: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").OpenInterest[]>;
    parseOpenInterest(interest: any, market?: Market): import("./base/types.js").OpenInterest;
    setSandboxMode(enable: boolean): void;
    fetchDepositWithdrawFees(codes?: Strings, params?: {}): Promise<{}>;
    parseDepositWithdrawFees(response: any, codes?: any, currencyIdKey?: any): {};
    fetchSettlementHistory(symbol?: Str, since?: Int, limit?: Int, params?: {}): Promise<any>;
    parseSettlement(settlement: any, market: any): {
        info: any;
        symbol: string;
        price: number;
        timestamp: any;
        datetime: any;
    };
    parseSettlements(settlements: any, market: any): any[];
    fetchUnderlyingAssets(params?: {}): Promise<any>;
    fetchGreeks(symbol: string, params?: {}): Promise<Greeks>;
    parseGreeks(greeks: Dict, market?: Market): Greeks;
    closePosition(symbol: string, side?: OrderSide, params?: {}): Promise<Order>;
    fetchOption(symbol: string, params?: {}): Promise<Option>;
    fetchOptionChain(code: string, params?: {}): Promise<OptionChain>;
    parseOption(chain: Dict, currency?: Currency, market?: Market): Option;
    fetchConvertQuote(fromCode: string, toCode: string, amount?: Num, params?: {}): Promise<Conversion>;
    createConvertTrade(id: string, fromCode: string, toCode: string, amount?: Num, params?: {}): Promise<Conversion>;
    fetchConvertTrade(id: string, code?: Str, params?: {}): Promise<Conversion>;
    fetchConvertTradeHistory(code?: Str, since?: Int, limit?: Int, params?: {}): Promise<Conversion[]>;
    parseConversion(conversion: Dict, fromCurrency?: Currency, toCurrency?: Currency): Conversion;
    fetchConvertCurrencies(params?: {}): Promise<Currencies>;
    handleErrors(httpCode: any, reason: any, url: any, method: any, headers: any, body: any, response: any, requestHeaders: any, requestBody: any): any;
    fetchMarginAdjustmentHistory(symbol?: Str, type?: Str, since?: Num, limit?: Num, params?: {}): Promise<MarginModification[]>;
    fetchPositionsHistory(symbols?: Strings, since?: Int, limit?: Int, params?: {}): Promise<Position[]>;
}
