// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

namespace ccxt;

public partial class tetherland : Exchange
{
    public tetherland (object args = null): base(args) {}

    public async Task<object> publicGetApiV5Currencies (object parameters = null)
    {
        return await this.callAsync ("publicGetApiV5Currencies",parameters);
    }

}