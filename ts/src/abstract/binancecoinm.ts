// -------------------------------------------------------------------------------

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

// -------------------------------------------------------------------------------

import { implicitReturnType } from '../base/types.js';
import _binance from '../binance.js';

interface binance {
    sapiGetSystemStatus (params?: {}): Promise<implicitReturnType>;
    sapiGetAccountSnapshot (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginAsset (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginPair (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginAllAssets (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginAllPairs (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginPriceIndex (params?: {}): Promise<implicitReturnType>;
    sapiGetAssetAssetDividend (params?: {}): Promise<implicitReturnType>;
    sapiGetAssetDribblet (params?: {}): Promise<implicitReturnType>;
    sapiGetAssetTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetAssetAssetDetail (params?: {}): Promise<implicitReturnType>;
    sapiGetAssetTradeFee (params?: {}): Promise<implicitReturnType>;
    sapiGetAssetLedgerTransferCloudMiningQueryByPage (params?: {}): Promise<implicitReturnType>;
    sapiGetAssetConvertTransferQueryByPage (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginLoan (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginRepay (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginInterestHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginForceLiquidationRec (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginOrder (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginOpenOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginAllOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginMyTrades (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginMaxBorrowable (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginMaxTransferable (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginTradeCoeff (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginIsolatedTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginIsolatedAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginIsolatedPair (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginIsolatedAllPairs (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginIsolatedAccountLimit (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginInterestRateHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginOrderList (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginAllOrderList (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginOpenOrderList (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginCrossMarginData (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginIsolatedMarginData (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginIsolatedMarginTier (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginRateLimitOrder (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginDribblet (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginCrossMarginCollateralRatio (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginExchangeSmallLiability (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginExchangeSmallLiabilityHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetMarginNextHourlyInterestRate (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanIncome (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanOngoingOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanLtvAdjustmentHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanBorrowHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanRepayHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanLoanableData (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanCollateralData (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanRepayCollateralRate (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanVipOngoingOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanVipRepayHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetLoanVipCollateralAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetFiatOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetFiatPayments (params?: {}): Promise<implicitReturnType>;
    sapiGetFuturesTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetFuturesLoanBorrowHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetFuturesLoanRepayHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetFuturesLoanWallet (params?: {}): Promise<implicitReturnType>;
    sapiGetFuturesLoanAdjustCollateralHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetFuturesLoanLiquidationHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetRebateTaxQuery (params?: {}): Promise<implicitReturnType>;
    sapiGetCapitalConfigGetall (params?: {}): Promise<implicitReturnType>;
    sapiGetCapitalDepositAddress (params?: {}): Promise<implicitReturnType>;
    sapiGetCapitalDepositHisrec (params?: {}): Promise<implicitReturnType>;
    sapiGetCapitalDepositSubAddress (params?: {}): Promise<implicitReturnType>;
    sapiGetCapitalDepositSubHisrec (params?: {}): Promise<implicitReturnType>;
    sapiGetCapitalWithdrawHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetCapitalContractConvertibleCoins (params?: {}): Promise<implicitReturnType>;
    sapiGetConvertTradeFlow (params?: {}): Promise<implicitReturnType>;
    sapiGetConvertExchangeInfo (params?: {}): Promise<implicitReturnType>;
    sapiGetConvertAssetInfo (params?: {}): Promise<implicitReturnType>;
    sapiGetConvertOrderStatus (params?: {}): Promise<implicitReturnType>;
    sapiGetAccountStatus (params?: {}): Promise<implicitReturnType>;
    sapiGetAccountApiTradingStatus (params?: {}): Promise<implicitReturnType>;
    sapiGetAccountApiRestrictionsIpRestriction (params?: {}): Promise<implicitReturnType>;
    sapiGetBnbBurn (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountFuturesAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountFuturesAccountSummary (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountFuturesPositionRisk (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountFuturesInternalTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountList (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountMarginAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountMarginAccountSummary (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountSpotSummary (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountStatus (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountSubTransferHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountTransferSubUserHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountUniversalTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountApiRestrictionsIpRestrictionThirdPartyList (params?: {}): Promise<implicitReturnType>;
    sapiGetSubAccountTransactionTatistics (params?: {}): Promise<implicitReturnType>;
    sapiGetManagedSubaccountAsset (params?: {}): Promise<implicitReturnType>;
    sapiGetManagedSubaccountAccountSnapshot (params?: {}): Promise<implicitReturnType>;
    sapiGetManagedSubaccountQueryTransLogForInvestor (params?: {}): Promise<implicitReturnType>;
    sapiGetManagedSubaccountQueryTransLogForTradeParent (params?: {}): Promise<implicitReturnType>;
    sapiGetManagedSubaccountFetchFutureAsset (params?: {}): Promise<implicitReturnType>;
    sapiGetManagedSubaccountMarginAsset (params?: {}): Promise<implicitReturnType>;
    sapiGetManagedSubaccountInfo (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingDailyProductList (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingDailyUserLeftQuota (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingDailyUserRedemptionQuota (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingDailyTokenPosition (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingUnionAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingUnionPurchaseRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingUnionRedemptionRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingUnionInterestHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingProjectList (params?: {}): Promise<implicitReturnType>;
    sapiGetLendingProjectPositionList (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningPubAlgoList (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningPubCoinList (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningWorkerDetail (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningWorkerList (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningPaymentList (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningStatisticsUserStatus (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningStatisticsUserList (params?: {}): Promise<implicitReturnType>;
    sapiGetMiningPaymentUid (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapPools (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapLiquidity (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapLiquidityOps (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapQuote (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapSwap (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapPoolConfigure (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapAddLiquidityPreview (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapRemoveLiquidityPreview (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapUnclaimedRewards (params?: {}): Promise<implicitReturnType>;
    sapiGetBswapClaimedHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetBlvtTokenInfo (params?: {}): Promise<implicitReturnType>;
    sapiGetBlvtSubscribeRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetBlvtRedeemRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetBlvtUserLimit (params?: {}): Promise<implicitReturnType>;
    sapiGetApiReferralIfNewUser (params?: {}): Promise<implicitReturnType>;
    sapiGetApiReferralCustomization (params?: {}): Promise<implicitReturnType>;
    sapiGetApiReferralUserCustomization (params?: {}): Promise<implicitReturnType>;
    sapiGetApiReferralRebateRecentRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetApiReferralRebateHistoricalRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetApiReferralKickbackRecentRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetApiReferralKickbackHistoricalRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountApi (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountApiCommissionFutures (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountApiCommissionCoinFutures (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerInfo (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerTransferFutures (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerRebateRecentRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerRebateHistoricalRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountBnbBurnStatus (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountDepositHist (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountSpotSummary (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountMarginSummary (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountFuturesSummary (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerRebateFuturesRecentRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerSubAccountApiIpRestriction (params?: {}): Promise<implicitReturnType>;
    sapiGetBrokerUniversalTransfer (params?: {}): Promise<implicitReturnType>;
    sapiGetAccountApiRestrictions (params?: {}): Promise<implicitReturnType>;
    sapiGetC2cOrderMatchListUserOrderHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetNftHistoryTransactions (params?: {}): Promise<implicitReturnType>;
    sapiGetNftHistoryDeposit (params?: {}): Promise<implicitReturnType>;
    sapiGetNftHistoryWithdraw (params?: {}): Promise<implicitReturnType>;
    sapiGetNftUserGetAsset (params?: {}): Promise<implicitReturnType>;
    sapiGetPayTransactions (params?: {}): Promise<implicitReturnType>;
    sapiGetGiftcardVerify (params?: {}): Promise<implicitReturnType>;
    sapiGetGiftcardCryptographyRsaPublicKey (params?: {}): Promise<implicitReturnType>;
    sapiGetGiftcardBuyCodeTokenLimit (params?: {}): Promise<implicitReturnType>;
    sapiGetAlgoFuturesOpenOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetAlgoFuturesHistoricalOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetAlgoFuturesSubOrders (params?: {}): Promise<implicitReturnType>;
    sapiGetPortfolioAccount (params?: {}): Promise<implicitReturnType>;
    sapiGetPortfolioCollateralRate (params?: {}): Promise<implicitReturnType>;
    sapiGetPortfolioPmLoan (params?: {}): Promise<implicitReturnType>;
    sapiGetPortfolioInterestHistory (params?: {}): Promise<implicitReturnType>;
    sapiGetPortfolioInterestRate (params?: {}): Promise<implicitReturnType>;
    sapiGetStakingProductList (params?: {}): Promise<implicitReturnType>;
    sapiGetStakingPosition (params?: {}): Promise<implicitReturnType>;
    sapiGetStakingStakingRecord (params?: {}): Promise<implicitReturnType>;
    sapiGetStakingPersonalLeftQuota (params?: {}): Promise<implicitReturnType>;
    sapiPostAssetDust (params?: {}): Promise<implicitReturnType>;
    sapiPostAssetDustBtc (params?: {}): Promise<implicitReturnType>;
    sapiPostAssetTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostAssetGetFundingAsset (params?: {}): Promise<implicitReturnType>;
    sapiPostAssetConvertTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostAccountDisableFastWithdrawSwitch (params?: {}): Promise<implicitReturnType>;
    sapiPostAccountEnableFastWithdrawSwitch (params?: {}): Promise<implicitReturnType>;
    sapiPostCapitalWithdrawApply (params?: {}): Promise<implicitReturnType>;
    sapiPostCapitalContractConvertibleCoins (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginLoan (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginRepay (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginOrder (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginOrderOco (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginExchangeSmallLiability (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginIsolatedTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostMarginIsolatedAccount (params?: {}): Promise<implicitReturnType>;
    sapiPostBnbBurn (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountVirtualSubAccount (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountMarginTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountMarginEnable (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountFuturesEnable (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountFuturesTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountFuturesInternalTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountTransferSubToSub (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountTransferSubToMaster (params?: {}): Promise<implicitReturnType>;
    sapiPostSubAccountUniversalTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostManagedSubaccountDeposit (params?: {}): Promise<implicitReturnType>;
    sapiPostManagedSubaccountWithdraw (params?: {}): Promise<implicitReturnType>;
    sapiPostUserDataStream (params?: {}): Promise<implicitReturnType>;
    sapiPostUserDataStreamIsolated (params?: {}): Promise<implicitReturnType>;
    sapiPostFuturesTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostLendingCustomizedFixedPurchase (params?: {}): Promise<implicitReturnType>;
    sapiPostLendingDailyPurchase (params?: {}): Promise<implicitReturnType>;
    sapiPostLendingDailyRedeem (params?: {}): Promise<implicitReturnType>;
    sapiPostBswapLiquidityAdd (params?: {}): Promise<implicitReturnType>;
    sapiPostBswapLiquidityRemove (params?: {}): Promise<implicitReturnType>;
    sapiPostBswapSwap (params?: {}): Promise<implicitReturnType>;
    sapiPostBswapClaimRewards (params?: {}): Promise<implicitReturnType>;
    sapiPostBlvtSubscribe (params?: {}): Promise<implicitReturnType>;
    sapiPostBlvtRedeem (params?: {}): Promise<implicitReturnType>;
    sapiPostApiReferralCustomization (params?: {}): Promise<implicitReturnType>;
    sapiPostApiReferralUserCustomization (params?: {}): Promise<implicitReturnType>;
    sapiPostApiReferralRebateHistoricalRecord (params?: {}): Promise<implicitReturnType>;
    sapiPostApiReferralKickbackHistoricalRecord (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccount (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountMargin (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountFutures (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApi (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiPermission (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiCommission (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiCommissionFutures (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiCommissionCoinFutures (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerTransferFutures (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerRebateHistoricalRecord (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountBnbBurnSpot (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountBnbBurnMarginInterest (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountBlvt (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiIpRestriction (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiIpRestrictionIpList (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerUniversalTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiPermissionUniversalTransfer (params?: {}): Promise<implicitReturnType>;
    sapiPostBrokerSubAccountApiPermissionVanillaOptions (params?: {}): Promise<implicitReturnType>;
    sapiPostGiftcardCreateCode (params?: {}): Promise<implicitReturnType>;
    sapiPostGiftcardRedeemCode (params?: {}): Promise<implicitReturnType>;
    sapiPostGiftcardBuyCode (params?: {}): Promise<implicitReturnType>;
    sapiPostAlgoFuturesNewOrderVp (params?: {}): Promise<implicitReturnType>;
    sapiPostAlgoFuturesNewOrderTwap (params?: {}): Promise<implicitReturnType>;
    sapiPostStakingPurchase (params?: {}): Promise<implicitReturnType>;
    sapiPostStakingRedeem (params?: {}): Promise<implicitReturnType>;
    sapiPostStakingSetAutoStaking (params?: {}): Promise<implicitReturnType>;
    sapiPostPortfolioRepay (params?: {}): Promise<implicitReturnType>;
    sapiPostLoanBorrow (params?: {}): Promise<implicitReturnType>;
    sapiPostLoanRepay (params?: {}): Promise<implicitReturnType>;
    sapiPostLoanAdjustLtv (params?: {}): Promise<implicitReturnType>;
    sapiPostLoanCustomizeMarginCall (params?: {}): Promise<implicitReturnType>;
    sapiPostLoanVipRepay (params?: {}): Promise<implicitReturnType>;
    sapiPostConvertGetQuote (params?: {}): Promise<implicitReturnType>;
    sapiPostConvertAcceptQuote (params?: {}): Promise<implicitReturnType>;
    sapiPutUserDataStream (params?: {}): Promise<implicitReturnType>;
    sapiPutUserDataStreamIsolated (params?: {}): Promise<implicitReturnType>;
    sapiDeleteMarginOpenOrders (params?: {}): Promise<implicitReturnType>;
    sapiDeleteMarginOrder (params?: {}): Promise<implicitReturnType>;
    sapiDeleteMarginOrderList (params?: {}): Promise<implicitReturnType>;
    sapiDeleteMarginIsolatedAccount (params?: {}): Promise<implicitReturnType>;
    sapiDeleteUserDataStream (params?: {}): Promise<implicitReturnType>;
    sapiDeleteUserDataStreamIsolated (params?: {}): Promise<implicitReturnType>;
    sapiDeleteBrokerSubAccountApi (params?: {}): Promise<implicitReturnType>;
    sapiDeleteBrokerSubAccountApiIpRestrictionIpList (params?: {}): Promise<implicitReturnType>;
    sapiDeleteAlgoFuturesOrder (params?: {}): Promise<implicitReturnType>;
    sapiV2GetSubAccountFuturesAccount (params?: {}): Promise<implicitReturnType>;
    sapiV2GetSubAccountFuturesPositionRisk (params?: {}): Promise<implicitReturnType>;
    sapiV3GetSubAccountAssets (params?: {}): Promise<implicitReturnType>;
    sapiV3PostAssetGetUserAsset (params?: {}): Promise<implicitReturnType>;
    sapiV4GetSubAccountAssets (params?: {}): Promise<implicitReturnType>;
    wapiPostWithdraw (params?: {}): Promise<implicitReturnType>;
    wapiPostSubAccountTransfer (params?: {}): Promise<implicitReturnType>;
    wapiGetDepositHistory (params?: {}): Promise<implicitReturnType>;
    wapiGetWithdrawHistory (params?: {}): Promise<implicitReturnType>;
    wapiGetDepositAddress (params?: {}): Promise<implicitReturnType>;
    wapiGetAccountStatus (params?: {}): Promise<implicitReturnType>;
    wapiGetSystemStatus (params?: {}): Promise<implicitReturnType>;
    wapiGetApiTradingStatus (params?: {}): Promise<implicitReturnType>;
    wapiGetUserAssetDribbletLog (params?: {}): Promise<implicitReturnType>;
    wapiGetTradeFee (params?: {}): Promise<implicitReturnType>;
    wapiGetAssetDetail (params?: {}): Promise<implicitReturnType>;
    wapiGetSubAccountList (params?: {}): Promise<implicitReturnType>;
    wapiGetSubAccountTransferHistory (params?: {}): Promise<implicitReturnType>;
    wapiGetSubAccountAssets (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetPing (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetTime (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetExchangeInfo (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetDepth (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetTrades (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetHistoricalTrades (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetAggTrades (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetPremiumIndex (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetFundingRate (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetKlines (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetContinuousKlines (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetIndexPriceKlines (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetMarkPriceKlines (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetTicker24hr (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetTickerPrice (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetTickerBookTicker (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetOpenInterest (params?: {}): Promise<implicitReturnType>;
    dapiPublicGetPmExchangeInfo (params?: {}): Promise<implicitReturnType>;
    dapiDataGetOpenInterestHist (params?: {}): Promise<implicitReturnType>;
    dapiDataGetTopLongShortAccountRatio (params?: {}): Promise<implicitReturnType>;
    dapiDataGetTopLongShortPositionRatio (params?: {}): Promise<implicitReturnType>;
    dapiDataGetGlobalLongShortAccountRatio (params?: {}): Promise<implicitReturnType>;
    dapiDataGetTakerBuySellVol (params?: {}): Promise<implicitReturnType>;
    dapiDataGetBasis (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetPositionSideDual (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetOrder (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetOpenOrder (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetOpenOrders (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetAllOrders (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetBalance (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetAccount (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetPositionMarginHistory (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetPositionRisk (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetUserTrades (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetIncome (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetLeverageBracket (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetForceOrders (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetAdlQuantile (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetOrderAmendment (params?: {}): Promise<implicitReturnType>;
    dapiPrivateGetPmAccountInfo (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostPositionSideDual (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostOrder (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostBatchOrders (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostCountdownCancelAll (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostLeverage (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostMarginType (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostPositionMargin (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePostListenKey (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePutListenKey (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePutOrder (params?: {}): Promise<implicitReturnType>;
    dapiPrivatePutBatchOrders (params?: {}): Promise<implicitReturnType>;
    dapiPrivateDeleteOrder (params?: {}): Promise<implicitReturnType>;
    dapiPrivateDeleteAllOpenOrders (params?: {}): Promise<implicitReturnType>;
    dapiPrivateDeleteBatchOrders (params?: {}): Promise<implicitReturnType>;
    dapiPrivateDeleteListenKey (params?: {}): Promise<implicitReturnType>;
    dapiPrivateV2GetLeverageBracket (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetPing (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetTime (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetExchangeInfo (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetDepth (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetTrades (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetHistoricalTrades (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetAggTrades (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetKlines (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetContinuousKlines (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetMarkPriceKlines (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetIndexPriceKlines (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetFundingRate (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetPremiumIndex (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetTicker24hr (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetTickerPrice (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetTickerBookTicker (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetOpenInterest (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetIndexInfo (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetApiTradingStatus (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetLvtKlines (params?: {}): Promise<implicitReturnType>;
    fapiPublicGetPmExchangeInfo (params?: {}): Promise<implicitReturnType>;
    fapiDataGetOpenInterestHist (params?: {}): Promise<implicitReturnType>;
    fapiDataGetTopLongShortAccountRatio (params?: {}): Promise<implicitReturnType>;
    fapiDataGetTopLongShortPositionRatio (params?: {}): Promise<implicitReturnType>;
    fapiDataGetGlobalLongShortAccountRatio (params?: {}): Promise<implicitReturnType>;
    fapiDataGetTakerlongshortRatio (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetForceOrders (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetAllOrders (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetOpenOrder (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetOpenOrders (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetOrder (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetAccount (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetBalance (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetLeverageBracket (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetPositionMarginHistory (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetPositionRisk (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetPositionSideDual (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetUserTrades (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetIncome (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetCommissionRate (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiTradingStatus (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetMultiAssetsMargin (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralIfNewUser (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralCustomization (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralUserCustomization (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralTraderNum (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralOverview (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralTradeVol (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralRebateVol (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetApiReferralTraderSummary (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetAdlQuantile (params?: {}): Promise<implicitReturnType>;
    fapiPrivateGetPmAccountInfo (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostBatchOrders (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostPositionSideDual (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostPositionMargin (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostMarginType (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostOrder (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostLeverage (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostListenKey (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostCountdownCancelAll (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostMultiAssetsMargin (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostApiReferralCustomization (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePostApiReferralUserCustomization (params?: {}): Promise<implicitReturnType>;
    fapiPrivatePutListenKey (params?: {}): Promise<implicitReturnType>;
    fapiPrivateDeleteBatchOrders (params?: {}): Promise<implicitReturnType>;
    fapiPrivateDeleteOrder (params?: {}): Promise<implicitReturnType>;
    fapiPrivateDeleteAllOpenOrders (params?: {}): Promise<implicitReturnType>;
    fapiPrivateDeleteListenKey (params?: {}): Promise<implicitReturnType>;
    fapiPrivateV2GetAccount (params?: {}): Promise<implicitReturnType>;
    fapiPrivateV2GetBalance (params?: {}): Promise<implicitReturnType>;
    fapiPrivateV2GetPositionRisk (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetPing (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetTime (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetExchangeInfo (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetIndex (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetTicker (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetMark (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetDepth (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetKlines (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetTrades (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetHistoricalTrades (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetExerciseHistory (params?: {}): Promise<implicitReturnType>;
    eapiPublicGetOpenInterest (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetAccount (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetPosition (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetOpenOrders (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetHistoryOrders (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetUserTrades (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetExerciseRecord (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetBill (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetMarginAccount (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetMmp (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetCountdownCancelAll (params?: {}): Promise<implicitReturnType>;
    eapiPrivateGetOrder (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePostOrder (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePostBatchOrders (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePostListenKey (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePostMmpSet (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePostMmpReset (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePostCountdownCancelAll (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePostCountdownCancelAllHeartBeat (params?: {}): Promise<implicitReturnType>;
    eapiPrivatePutListenKey (params?: {}): Promise<implicitReturnType>;
    eapiPrivateDeleteOrder (params?: {}): Promise<implicitReturnType>;
    eapiPrivateDeleteBatchOrders (params?: {}): Promise<implicitReturnType>;
    eapiPrivateDeleteAllOpenOrders (params?: {}): Promise<implicitReturnType>;
    eapiPrivateDeleteAllOpenOrdersByUnderlying (params?: {}): Promise<implicitReturnType>;
    eapiPrivateDeleteListenKey (params?: {}): Promise<implicitReturnType>;
    publicGetPing (params?: {}): Promise<implicitReturnType>;
    publicGetTime (params?: {}): Promise<implicitReturnType>;
    publicGetDepth (params?: {}): Promise<implicitReturnType>;
    publicGetTrades (params?: {}): Promise<implicitReturnType>;
    publicGetAggTrades (params?: {}): Promise<implicitReturnType>;
    publicGetHistoricalTrades (params?: {}): Promise<implicitReturnType>;
    publicGetKlines (params?: {}): Promise<implicitReturnType>;
    publicGetTicker24hr (params?: {}): Promise<implicitReturnType>;
    publicGetTickerPrice (params?: {}): Promise<implicitReturnType>;
    publicGetTickerBookTicker (params?: {}): Promise<implicitReturnType>;
    publicGetExchangeInfo (params?: {}): Promise<implicitReturnType>;
    publicPutUserDataStream (params?: {}): Promise<implicitReturnType>;
    publicPostUserDataStream (params?: {}): Promise<implicitReturnType>;
    publicDeleteUserDataStream (params?: {}): Promise<implicitReturnType>;
    privateGetAllOrderList (params?: {}): Promise<implicitReturnType>;
    privateGetOpenOrderList (params?: {}): Promise<implicitReturnType>;
    privateGetOrderList (params?: {}): Promise<implicitReturnType>;
    privateGetOrder (params?: {}): Promise<implicitReturnType>;
    privateGetOpenOrders (params?: {}): Promise<implicitReturnType>;
    privateGetAllOrders (params?: {}): Promise<implicitReturnType>;
    privateGetAccount (params?: {}): Promise<implicitReturnType>;
    privateGetMyTrades (params?: {}): Promise<implicitReturnType>;
    privateGetRateLimitOrder (params?: {}): Promise<implicitReturnType>;
    privateGetMyPreventedMatches (params?: {}): Promise<implicitReturnType>;
    privatePostOrderOco (params?: {}): Promise<implicitReturnType>;
    privatePostOrder (params?: {}): Promise<implicitReturnType>;
    privatePostOrderCancelReplace (params?: {}): Promise<implicitReturnType>;
    privatePostOrderTest (params?: {}): Promise<implicitReturnType>;
    privateDeleteOpenOrders (params?: {}): Promise<implicitReturnType>;
    privateDeleteOrderList (params?: {}): Promise<implicitReturnType>;
    privateDeleteOrder (params?: {}): Promise<implicitReturnType>;
}
abstract class binance extends _binance {}

export default binance