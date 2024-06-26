// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

namespace ccxt;

public partial class tabdeal : Exchange
{
    public tabdeal (object args = null): base(args) {}

    public async Task<object> publicGetPlotsMarketInformation (object parameters = null)
    {
        return await this.callAsync ("publicGetPlotsMarketInformation",parameters);
    }

    public async Task<object> publicGetRApiV1Depth (object parameters = null)
    {
        return await this.callAsync ("publicGetRApiV1Depth",parameters);
    }

    public async Task<object> publicGetRPlotsHistory (object parameters = null)
    {
        return await this.callAsync ("publicGetRPlotsHistory",parameters);
    }

}