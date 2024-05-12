// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';

interface Exchange {
    publicGetOapiV1MarketTickers (params?: {}): Promise<implicitReturnType>;
    publicGetOapiV1OtcTickers (params?: {}): Promise<implicitReturnType>;
    publicGetSnoOapiMarketCandle (params?: {}): Promise<implicitReturnType>;
    publicGetOapiV1MarketOrderbook (params?: {}): Promise<implicitReturnType>;
    privatePostBalance (params?: {}): Promise<implicitReturnType>;
}
abstract class Exchange extends _Exchange {}

export default Exchange
