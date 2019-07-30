<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\Bank\Nong;

use SDK\Kernel\BaseClient;
require_once (__DIR__ . './ebusclient/PaymentRequest.php');

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    /**
     * 农行支付
     *
     * @var string
     */
    protected $api = '';
    protected $error = '';

    /**
     * 统一下单
     *
     * @param [type] $apiname 模块名称
     * @param [type] $data    数据
     */
    public function pay($data)
    {
        $configs = $this->app->getConfig();

        // todo 农行支付业务逻辑
        // $a = __FILE__;
 
        $tRequest = new PaymentRequest();
        $tRequest->order["PayTypeID"] = ($data['PayTypeID']); //设定交易类型
        $tRequest->order["OrderDate"] = ($data['OrderDate']); //设定订单日期 （必要信息 - YYYY/MM/DD）
        $tRequest->order["OrderTime"] = ($data['OrderTime']); //设定订单时间 （必要信息 - HH:MM:SS）
        $tRequest->order["orderTimeoutDate"] = ($data['orderTimeoutDate']); //设定订单有效期
        $tRequest->order["OrderNo"] = ($data['OrderNo']); //设定订单编号
        $tRequest->order["CurrencyCode"] = ($data['CurrencyCode']); //设定交易币种
        $tRequest->order["OrderAmount"] = ($data['PaymentRequestAmount']); //设定交易金额
        $tRequest->order["Fee"] = ($data['Fee']); //设定手续费金额
        $tRequest->order["AccountNo"] = ($data['AccountNo']); //设定支付账户
        $tRequest->order["OrderDesc"] = ($data['OrderDesc']); //设定订单说明
        $tRequest->order["OrderURL"] = ($data['OrderURL']); //设定订单地址
        $tRequest->order["ReceiverAddress"] = ($data['ReceiverAddress']); //收货地址
        $tRequest->order["InstallmentMark"] = ($data['InstallmentMark']); //分期标识
        $installmentMerk = $data['InstallmentMark'];
        $paytypeID = $data['PayTypeID'];
        if (strcmp($installmentMerk, "1") == 0 && strcmp($paytypeID, "DividedPay") == 0) {
            $tRequest->order["InstallmentCode"] = ($data['InstallmentCode']); //设定分期代码
            $tRequest->order["InstallmentNum"] = ($data['InstallmentNum']); //设定分期期数
        }

        $tRequest->order["CommodityType"] = ($data['CommodityType']); //设置商品种类
        $tRequest->order["BuyIP"] = ($data['BuyIP']); //IP
        $tRequest->order["ExpiredDate"] = ($data['ExpiredDate']); //设定订单保存时间

        //2、订单明细
        $orderitem = array ();
        $orderitem["SubMerName"] = "测试二级商户1"; //设定二级商户名称
        $orderitem["SubMerId"] = "12345"; //设定二级商户代码
        $orderitem["SubMerMCC"] = "0000"; //设定二级商户MCC码 
        $orderitem["SubMerchantRemarks"] = "测试"; //二级商户备注项
        $orderitem["ProductID"] = "IP000001"; //商品代码，预留字段
        $orderitem["ProductName"] = "中国移动IP卡"; //商品名称
        $orderitem["UnitPrice"] = "1.00"; //商品总价
        $orderitem["Qty"] = "1"; //商品数量
        $orderitem["ProductRemarks"] = "测试商品"; //商品备注项
        $orderitem["ProductType"] = "充值类"; //商品类型
        $orderitem["ProductDiscount"] = "0.9"; //商品折扣
        $orderitem["ProductExpiredDate"] = "10"; //商品有效期
        $tRequest->orderitems[0] = $orderitem;

        $orderitem = array ();
        $orderitem["SubMerName"] = "测试二级商户2"; //设定二级商户名称
        $orderitem["SubMerId"] = "12345"; //设定二级商户代码
        $orderitem["SubMerMCC"] = "0000"; //设定二级商户MCC码 
        $orderitem["SubMerchantRemarks"] = "测试2"; //二级商户备注项
        $orderitem["ProductID"] = "IP000001"; //商品代码，预留字段
        $orderitem["ProductName"] = "中国移动IP卡2"; //商品名称
        $orderitem["UnitPrice"] = "1.00"; //商品总价
        $orderitem["Qty"] = "1"; //商品数量
        $orderitem["ProductRemarks"] = "测试商品2"; //商品备注项
        $orderitem["ProductType"] = "充值类2"; //商品类型
        $orderitem["ProductDiscount"] = "0.9"; //商品折扣
        $orderitem["ProductExpiredDate"] = "10"; //商品有效期
        $tRequest->orderitems[1] = $orderitem;

        //3、生成支付请求对象
        $tRequest->request["PaymentType"] = ($data['PaymentType']); //设定支付类型
        $tRequest->request["PaymentLinkType"] = ($data['PaymentLinkType']); //设定支付接入方式
        if ($data['PaymentType'] === "6" && $data['PaymentLinkType'] === "2") {
            $tRequest->request["UnionPayLinkType"] = ($data['UnionPayLinkType']); //当支付类型为6，支付接入方式为2的条件满足时，需要设置银联跨行移动支付接入方式
        }
        $tRequest->request["ReceiveAccount"] = ($data['ReceiveAccount']); //设定收款方账号
        $tRequest->request["ReceiveAccName"] = ($data['ReceiveAccName']); //设定收款方户名
        $tRequest->request["NotifyType"] = ($data['NotifyType']); //设定通知方式
        $tRequest->request["ResultNotifyURL"] = ($data['ResultNotifyURL']); //设定通知URL地址
        $tRequest->request["MerchantRemarks"] = ($data['MerchantRemarks']); //设定附言
        $tRequest->request["ReceiveMark"] = ($data['ReceiveMark']); //交易是否直接入二级商户账户
        $tRequest->request["ReceiveMerchantType"] = ($data['ReceiveMerchantType']); //设定收款方账户类型
        $tRequest->request["IsBreakAccount"] = ($data['IsBreakAccount']); //设定交易是否分账
        $tRequest->request["SplitAccTemplate"] = ($data['SplitAccTemplate']); //分账模版编号        

        //4、添加分账信息
        $splitmerchantid_arr = $_REQUEST['SplitMerchantID'];
        $splitamount_arr = $_REQUEST['SplitAmount'];
        $item = array ();
        for ($i = 0; $i < count($splitmerchantid_arr, COUNT_NORMAL); $i++) 
        {
            $item["SplitMerchantID"]=$splitmerchantid_arr[$i];
            $item["SplitAmount"]=$splitamount_arr[$i];
            $tRequest->splitaccinfos[$i]=$item;
            $item = array ();
        }  

        $tResponse = $tRequest->postRequest();
        //支持多商户配置
        //$tResponse = $tRequest->extendPostRequest(2);

        if ($tResponse->isSuccess()) {
            print ("<br>Success!!!" . "</br>");
            print ("ReturnCode   = [" . $tResponse->getReturnCode() . "]</br>");
            print ("ReturnMsg   = [" . $tResponse->getErrorMessage() . "]</br>");
            $PaymentURL = $tResponse->GetValue("PaymentURL");
            print ("<br>PaymentURL=$PaymentURL" . "</br>");
            echo "<script language='javascript'>";
            echo "window.location.href='$PaymentURL'";
            echo "</script>";
        } else {
            print ("<br>Failed!!!" . "</br>");
            print ("ReturnCode   = [" . $tResponse->getReturnCode() . "]</br>");
            print ("ReturnMsg   = [" . $tResponse->getErrorMessage() . "]</br>");
        }
    }

    /**
     * 获取错误消息.
     */
    public function getError()
    {
        return $this->error;
    }
}
