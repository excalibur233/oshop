<?php

namespace OShop\Core\Thirdparty\SharePlatform;

use OShop\Core\Shop\Order\Order;
use GuzzleHttp\Client;

class NotifyHandler
{
    public static function notifyOrderComplete($order_id)
    {
        
        $params = self::constructParams($order_id);

        return self::sendNotify($params);
    }

    protected static function sendNotify($params)
    {
        $client = new Client([
            'base_uri' => 'https://share.medsci-tech.com',
            'timeout' => 2.0
        ]);

        try {
            $r = $client->request('POST', '/external/purchaseRecord', [
                'json' => $params,
                'debug' => true
            ]);
        } catch (RequestException $e) {
            \Log::error('外部接口请求失败');
            // \Log::info($r);
            return false;
        }
        return true;
    }

    protected static function constructParams($order_id)
    {
        $order = Order::find($order_id);
        $params = [];

        $line_items = $order->lineItems()->with('sku', 'sku.spu')->get();//eager load.

        foreach ($line_items as $line_item) {
            $sku = $line_item->sku;
            $spu = $sku->spu;

            $params['productInfos'] []= [
                'categoryId' => $spu->statistic_category_id,
                'productId' => $spu->id,
                'productName' => $spu->name,
                'num' => $line_item->amount,
                'price' => $line_item->price,
                'commission' => $line_item->commission,
            ];
        }

        $params['orderId'] = $order->serial;
        $params['shareUserId'] = $order->user->introducer_unionid;
        $params['userId'] = $order->user->unionid;
        $params['userName'] = $order->user->wechatProfile->nickname;
        $params['headImgUrl'] = $order->user->wechatProfile->headimgurl;
        $params['totalCommission'] = $order->bill->commission;
        $params['signature'] = self::genSignature($params);
        $params['productInfos'] = json_encode($params['productInfos'], JSON_UNESCAPED_UNICODE);
        
        return $params;
    }

    
    protected static function genSignature(&$params){
        if(!isset($params['timestamp']) || empty($params['timestamp'])){
            $params['timestamp'] = strval(time() * 1000);
        }
        
        ksort($params);
        
        $signature_string = '';
        foreach($params as $key => $val){
            $signature_string.= $key.':'.json_encode($val,JSON_UNESCAPED_UNICODE).',';
        }
        
        // 私钥，这里只是示例文件，具体请依据项目配置  商城用的是
        $privateKey = 'medsci-tech-shop-server';
        $signature_string .= 'privateKey:'.$privateKey;
        return sha1($signature_string);
    }
}