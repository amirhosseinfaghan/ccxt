<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitmex extends \ccxt\Exchange {
    public function public_get_announcement($params = array()) {
        return $this->request('announcement', 'public', 'GET', $params);
    }
    public function public_get_announcement_urgent($params = array()) {
        return $this->request('announcement/urgent', 'public', 'GET', $params);
    }
    public function public_get_funding($params = array()) {
        return $this->request('funding', 'public', 'GET', $params);
    }
    public function public_get_instrument($params = array()) {
        return $this->request('instrument', 'public', 'GET', $params);
    }
    public function public_get_instrument_active($params = array()) {
        return $this->request('instrument/active', 'public', 'GET', $params);
    }
    public function public_get_instrument_activeandindices($params = array()) {
        return $this->request('instrument/activeAndIndices', 'public', 'GET', $params);
    }
    public function public_get_instrument_activeintervals($params = array()) {
        return $this->request('instrument/activeIntervals', 'public', 'GET', $params);
    }
    public function public_get_instrument_compositeindex($params = array()) {
        return $this->request('instrument/compositeIndex', 'public', 'GET', $params);
    }
    public function public_get_instrument_indices($params = array()) {
        return $this->request('instrument/indices', 'public', 'GET', $params);
    }
    public function public_get_insurance($params = array()) {
        return $this->request('insurance', 'public', 'GET', $params);
    }
    public function public_get_leaderboard($params = array()) {
        return $this->request('leaderboard', 'public', 'GET', $params);
    }
    public function public_get_liquidation($params = array()) {
        return $this->request('liquidation', 'public', 'GET', $params);
    }
    public function public_get_orderbook($params = array()) {
        return $this->request('orderBook', 'public', 'GET', $params);
    }
    public function public_get_orderbook_l2($params = array()) {
        return $this->request('orderBook/L2', 'public', 'GET', $params);
    }
    public function public_get_quote($params = array()) {
        return $this->request('quote', 'public', 'GET', $params);
    }
    public function public_get_quote_bucketed($params = array()) {
        return $this->request('quote/bucketed', 'public', 'GET', $params);
    }
    public function public_get_schema($params = array()) {
        return $this->request('schema', 'public', 'GET', $params);
    }
    public function public_get_schema_websockethelp($params = array()) {
        return $this->request('schema/websocketHelp', 'public', 'GET', $params);
    }
    public function public_get_settlement($params = array()) {
        return $this->request('settlement', 'public', 'GET', $params);
    }
    public function public_get_stats($params = array()) {
        return $this->request('stats', 'public', 'GET', $params);
    }
    public function public_get_stats_history($params = array()) {
        return $this->request('stats/history', 'public', 'GET', $params);
    }
    public function public_get_trade($params = array()) {
        return $this->request('trade', 'public', 'GET', $params);
    }
    public function public_get_trade_bucketed($params = array()) {
        return $this->request('trade/bucketed', 'public', 'GET', $params);
    }
    public function public_get_wallet_assets($params = array()) {
        return $this->request('wallet/assets', 'public', 'GET', $params);
    }
    public function public_get_wallet_networks($params = array()) {
        return $this->request('wallet/networks', 'public', 'GET', $params);
    }
    public function private_get_apikey($params = array()) {
        return $this->request('apiKey', 'private', 'GET', $params);
    }
    public function private_get_chat($params = array()) {
        return $this->request('chat', 'private', 'GET', $params);
    }
    public function private_get_chat_channels($params = array()) {
        return $this->request('chat/channels', 'private', 'GET', $params);
    }
    public function private_get_chat_connected($params = array()) {
        return $this->request('chat/connected', 'private', 'GET', $params);
    }
    public function private_get_execution($params = array()) {
        return $this->request('execution', 'private', 'GET', $params);
    }
    public function private_get_execution_tradehistory($params = array()) {
        return $this->request('execution/tradeHistory', 'private', 'GET', $params);
    }
    public function private_get_notification($params = array()) {
        return $this->request('notification', 'private', 'GET', $params);
    }
    public function private_get_order($params = array()) {
        return $this->request('order', 'private', 'GET', $params);
    }
    public function private_get_position($params = array()) {
        return $this->request('position', 'private', 'GET', $params);
    }
    public function private_get_user($params = array()) {
        return $this->request('user', 'private', 'GET', $params);
    }
    public function private_get_user_affiliatestatus($params = array()) {
        return $this->request('user/affiliateStatus', 'private', 'GET', $params);
    }
    public function private_get_user_checkreferralcode($params = array()) {
        return $this->request('user/checkReferralCode', 'private', 'GET', $params);
    }
    public function private_get_user_commission($params = array()) {
        return $this->request('user/commission', 'private', 'GET', $params);
    }
    public function private_get_user_depositaddress($params = array()) {
        return $this->request('user/depositAddress', 'private', 'GET', $params);
    }
    public function private_get_user_executionhistory($params = array()) {
        return $this->request('user/executionHistory', 'private', 'GET', $params);
    }
    public function private_get_user_margin($params = array()) {
        return $this->request('user/margin', 'private', 'GET', $params);
    }
    public function private_get_user_minwithdrawalfee($params = array()) {
        return $this->request('user/minWithdrawalFee', 'private', 'GET', $params);
    }
    public function private_get_user_wallet($params = array()) {
        return $this->request('user/wallet', 'private', 'GET', $params);
    }
    public function private_get_user_wallethistory($params = array()) {
        return $this->request('user/walletHistory', 'private', 'GET', $params);
    }
    public function private_get_user_walletsummary($params = array()) {
        return $this->request('user/walletSummary', 'private', 'GET', $params);
    }
    public function private_get_wallet_assets($params = array()) {
        return $this->request('wallet/assets', 'private', 'GET', $params);
    }
    public function private_get_wallet_networks($params = array()) {
        return $this->request('wallet/networks', 'private', 'GET', $params);
    }
    public function private_get_userevent($params = array()) {
        return $this->request('userEvent', 'private', 'GET', $params);
    }
    public function private_post_apikey($params = array()) {
        return $this->request('apiKey', 'private', 'POST', $params);
    }
    public function private_post_apikey_disable($params = array()) {
        return $this->request('apiKey/disable', 'private', 'POST', $params);
    }
    public function private_post_apikey_enable($params = array()) {
        return $this->request('apiKey/enable', 'private', 'POST', $params);
    }
    public function private_post_chat($params = array()) {
        return $this->request('chat', 'private', 'POST', $params);
    }
    public function private_post_order($params = array()) {
        return $this->request('order', 'private', 'POST', $params);
    }
    public function private_post_order_bulk($params = array()) {
        return $this->request('order/bulk', 'private', 'POST', $params);
    }
    public function private_post_order_cancelallafter($params = array()) {
        return $this->request('order/cancelAllAfter', 'private', 'POST', $params);
    }
    public function private_post_order_closeposition($params = array()) {
        return $this->request('order/closePosition', 'private', 'POST', $params);
    }
    public function private_post_position_isolate($params = array()) {
        return $this->request('position/isolate', 'private', 'POST', $params);
    }
    public function private_post_position_leverage($params = array()) {
        return $this->request('position/leverage', 'private', 'POST', $params);
    }
    public function private_post_position_risklimit($params = array()) {
        return $this->request('position/riskLimit', 'private', 'POST', $params);
    }
    public function private_post_position_transfermargin($params = array()) {
        return $this->request('position/transferMargin', 'private', 'POST', $params);
    }
    public function private_post_user_cancelwithdrawal($params = array()) {
        return $this->request('user/cancelWithdrawal', 'private', 'POST', $params);
    }
    public function private_post_user_confirmemail($params = array()) {
        return $this->request('user/confirmEmail', 'private', 'POST', $params);
    }
    public function private_post_user_confirmenabletfa($params = array()) {
        return $this->request('user/confirmEnableTFA', 'private', 'POST', $params);
    }
    public function private_post_user_confirmwithdrawal($params = array()) {
        return $this->request('user/confirmWithdrawal', 'private', 'POST', $params);
    }
    public function private_post_user_disabletfa($params = array()) {
        return $this->request('user/disableTFA', 'private', 'POST', $params);
    }
    public function private_post_user_logout($params = array()) {
        return $this->request('user/logout', 'private', 'POST', $params);
    }
    public function private_post_user_logoutall($params = array()) {
        return $this->request('user/logoutAll', 'private', 'POST', $params);
    }
    public function private_post_user_preferences($params = array()) {
        return $this->request('user/preferences', 'private', 'POST', $params);
    }
    public function private_post_user_requestenabletfa($params = array()) {
        return $this->request('user/requestEnableTFA', 'private', 'POST', $params);
    }
    public function private_post_user_requestwithdrawal($params = array()) {
        return $this->request('user/requestWithdrawal', 'private', 'POST', $params);
    }
    public function private_put_order($params = array()) {
        return $this->request('order', 'private', 'PUT', $params);
    }
    public function private_put_order_bulk($params = array()) {
        return $this->request('order/bulk', 'private', 'PUT', $params);
    }
    public function private_put_user($params = array()) {
        return $this->request('user', 'private', 'PUT', $params);
    }
    public function private_delete_apikey($params = array()) {
        return $this->request('apiKey', 'private', 'DELETE', $params);
    }
    public function private_delete_order($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params);
    }
    public function private_delete_order_all($params = array()) {
        return $this->request('order/all', 'private', 'DELETE', $params);
    }
    public function publicGetAnnouncement($params = array()) {
        return $this->request('announcement', 'public', 'GET', $params);
    }
    public function publicGetAnnouncementUrgent($params = array()) {
        return $this->request('announcement/urgent', 'public', 'GET', $params);
    }
    public function publicGetFunding($params = array()) {
        return $this->request('funding', 'public', 'GET', $params);
    }
    public function publicGetInstrument($params = array()) {
        return $this->request('instrument', 'public', 'GET', $params);
    }
    public function publicGetInstrumentActive($params = array()) {
        return $this->request('instrument/active', 'public', 'GET', $params);
    }
    public function publicGetInstrumentActiveAndIndices($params = array()) {
        return $this->request('instrument/activeAndIndices', 'public', 'GET', $params);
    }
    public function publicGetInstrumentActiveIntervals($params = array()) {
        return $this->request('instrument/activeIntervals', 'public', 'GET', $params);
    }
    public function publicGetInstrumentCompositeIndex($params = array()) {
        return $this->request('instrument/compositeIndex', 'public', 'GET', $params);
    }
    public function publicGetInstrumentIndices($params = array()) {
        return $this->request('instrument/indices', 'public', 'GET', $params);
    }
    public function publicGetInsurance($params = array()) {
        return $this->request('insurance', 'public', 'GET', $params);
    }
    public function publicGetLeaderboard($params = array()) {
        return $this->request('leaderboard', 'public', 'GET', $params);
    }
    public function publicGetLiquidation($params = array()) {
        return $this->request('liquidation', 'public', 'GET', $params);
    }
    public function publicGetOrderBook($params = array()) {
        return $this->request('orderBook', 'public', 'GET', $params);
    }
    public function publicGetOrderBookL2($params = array()) {
        return $this->request('orderBook/L2', 'public', 'GET', $params);
    }
    public function publicGetQuote($params = array()) {
        return $this->request('quote', 'public', 'GET', $params);
    }
    public function publicGetQuoteBucketed($params = array()) {
        return $this->request('quote/bucketed', 'public', 'GET', $params);
    }
    public function publicGetSchema($params = array()) {
        return $this->request('schema', 'public', 'GET', $params);
    }
    public function publicGetSchemaWebsocketHelp($params = array()) {
        return $this->request('schema/websocketHelp', 'public', 'GET', $params);
    }
    public function publicGetSettlement($params = array()) {
        return $this->request('settlement', 'public', 'GET', $params);
    }
    public function publicGetStats($params = array()) {
        return $this->request('stats', 'public', 'GET', $params);
    }
    public function publicGetStatsHistory($params = array()) {
        return $this->request('stats/history', 'public', 'GET', $params);
    }
    public function publicGetTrade($params = array()) {
        return $this->request('trade', 'public', 'GET', $params);
    }
    public function publicGetTradeBucketed($params = array()) {
        return $this->request('trade/bucketed', 'public', 'GET', $params);
    }
    public function publicGetWalletAssets($params = array()) {
        return $this->request('wallet/assets', 'public', 'GET', $params);
    }
    public function publicGetWalletNetworks($params = array()) {
        return $this->request('wallet/networks', 'public', 'GET', $params);
    }
    public function privateGetApiKey($params = array()) {
        return $this->request('apiKey', 'private', 'GET', $params);
    }
    public function privateGetChat($params = array()) {
        return $this->request('chat', 'private', 'GET', $params);
    }
    public function privateGetChatChannels($params = array()) {
        return $this->request('chat/channels', 'private', 'GET', $params);
    }
    public function privateGetChatConnected($params = array()) {
        return $this->request('chat/connected', 'private', 'GET', $params);
    }
    public function privateGetExecution($params = array()) {
        return $this->request('execution', 'private', 'GET', $params);
    }
    public function privateGetExecutionTradeHistory($params = array()) {
        return $this->request('execution/tradeHistory', 'private', 'GET', $params);
    }
    public function privateGetNotification($params = array()) {
        return $this->request('notification', 'private', 'GET', $params);
    }
    public function privateGetOrder($params = array()) {
        return $this->request('order', 'private', 'GET', $params);
    }
    public function privateGetPosition($params = array()) {
        return $this->request('position', 'private', 'GET', $params);
    }
    public function privateGetUser($params = array()) {
        return $this->request('user', 'private', 'GET', $params);
    }
    public function privateGetUserAffiliateStatus($params = array()) {
        return $this->request('user/affiliateStatus', 'private', 'GET', $params);
    }
    public function privateGetUserCheckReferralCode($params = array()) {
        return $this->request('user/checkReferralCode', 'private', 'GET', $params);
    }
    public function privateGetUserCommission($params = array()) {
        return $this->request('user/commission', 'private', 'GET', $params);
    }
    public function privateGetUserDepositAddress($params = array()) {
        return $this->request('user/depositAddress', 'private', 'GET', $params);
    }
    public function privateGetUserExecutionHistory($params = array()) {
        return $this->request('user/executionHistory', 'private', 'GET', $params);
    }
    public function privateGetUserMargin($params = array()) {
        return $this->request('user/margin', 'private', 'GET', $params);
    }
    public function privateGetUserMinWithdrawalFee($params = array()) {
        return $this->request('user/minWithdrawalFee', 'private', 'GET', $params);
    }
    public function privateGetUserWallet($params = array()) {
        return $this->request('user/wallet', 'private', 'GET', $params);
    }
    public function privateGetUserWalletHistory($params = array()) {
        return $this->request('user/walletHistory', 'private', 'GET', $params);
    }
    public function privateGetUserWalletSummary($params = array()) {
        return $this->request('user/walletSummary', 'private', 'GET', $params);
    }
    public function privateGetWalletAssets($params = array()) {
        return $this->request('wallet/assets', 'private', 'GET', $params);
    }
    public function privateGetWalletNetworks($params = array()) {
        return $this->request('wallet/networks', 'private', 'GET', $params);
    }
    public function privateGetUserEvent($params = array()) {
        return $this->request('userEvent', 'private', 'GET', $params);
    }
    public function privatePostApiKey($params = array()) {
        return $this->request('apiKey', 'private', 'POST', $params);
    }
    public function privatePostApiKeyDisable($params = array()) {
        return $this->request('apiKey/disable', 'private', 'POST', $params);
    }
    public function privatePostApiKeyEnable($params = array()) {
        return $this->request('apiKey/enable', 'private', 'POST', $params);
    }
    public function privatePostChat($params = array()) {
        return $this->request('chat', 'private', 'POST', $params);
    }
    public function privatePostOrder($params = array()) {
        return $this->request('order', 'private', 'POST', $params);
    }
    public function privatePostOrderBulk($params = array()) {
        return $this->request('order/bulk', 'private', 'POST', $params);
    }
    public function privatePostOrderCancelAllAfter($params = array()) {
        return $this->request('order/cancelAllAfter', 'private', 'POST', $params);
    }
    public function privatePostOrderClosePosition($params = array()) {
        return $this->request('order/closePosition', 'private', 'POST', $params);
    }
    public function privatePostPositionIsolate($params = array()) {
        return $this->request('position/isolate', 'private', 'POST', $params);
    }
    public function privatePostPositionLeverage($params = array()) {
        return $this->request('position/leverage', 'private', 'POST', $params);
    }
    public function privatePostPositionRiskLimit($params = array()) {
        return $this->request('position/riskLimit', 'private', 'POST', $params);
    }
    public function privatePostPositionTransferMargin($params = array()) {
        return $this->request('position/transferMargin', 'private', 'POST', $params);
    }
    public function privatePostUserCancelWithdrawal($params = array()) {
        return $this->request('user/cancelWithdrawal', 'private', 'POST', $params);
    }
    public function privatePostUserConfirmEmail($params = array()) {
        return $this->request('user/confirmEmail', 'private', 'POST', $params);
    }
    public function privatePostUserConfirmEnableTFA($params = array()) {
        return $this->request('user/confirmEnableTFA', 'private', 'POST', $params);
    }
    public function privatePostUserConfirmWithdrawal($params = array()) {
        return $this->request('user/confirmWithdrawal', 'private', 'POST', $params);
    }
    public function privatePostUserDisableTFA($params = array()) {
        return $this->request('user/disableTFA', 'private', 'POST', $params);
    }
    public function privatePostUserLogout($params = array()) {
        return $this->request('user/logout', 'private', 'POST', $params);
    }
    public function privatePostUserLogoutAll($params = array()) {
        return $this->request('user/logoutAll', 'private', 'POST', $params);
    }
    public function privatePostUserPreferences($params = array()) {
        return $this->request('user/preferences', 'private', 'POST', $params);
    }
    public function privatePostUserRequestEnableTFA($params = array()) {
        return $this->request('user/requestEnableTFA', 'private', 'POST', $params);
    }
    public function privatePostUserRequestWithdrawal($params = array()) {
        return $this->request('user/requestWithdrawal', 'private', 'POST', $params);
    }
    public function privatePutOrder($params = array()) {
        return $this->request('order', 'private', 'PUT', $params);
    }
    public function privatePutOrderBulk($params = array()) {
        return $this->request('order/bulk', 'private', 'PUT', $params);
    }
    public function privatePutUser($params = array()) {
        return $this->request('user', 'private', 'PUT', $params);
    }
    public function privateDeleteApiKey($params = array()) {
        return $this->request('apiKey', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrder($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params);
    }
    public function privateDeleteOrderAll($params = array()) {
        return $this->request('order/all', 'private', 'DELETE', $params);
    }
}