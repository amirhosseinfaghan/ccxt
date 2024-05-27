// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

namespace ccxt;

public partial class exir : Exchange
{
    public exir (object args = null): base(args) {}

    public async Task<object> publicGetV2Tickers (object parameters = null)
    {
        return await this.callAsync ("publicGetV2Tickers",parameters);
    }

    public async Task<object> publicGetV2Ticker (object parameters = null)
    {
        return await this.callAsync ("publicGetV2Ticker",parameters);
    }

    public async Task<object> publicGetV2Chart (object parameters = null)
    {
        return await this.callAsync ("publicGetV2Chart",parameters);
    }

    public async Task<object> publicGetV2Orderbook (object parameters = null)
    {
        return await this.callAsync ("publicGetV2Orderbook",parameters);
    }

}