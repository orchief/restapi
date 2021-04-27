<?php

/*
 * 阿里云OSS
 */

namespace SDK\Oss\Ali;

use SDK\Kernel\BaseClient;
use OSS\Core\OssException;
use OSS\OssClient;
use SDK\Kernel\Exceptions\Exception;

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    /**
     * 上传文件
     * @param array $file 文件信息
     */
    public function uploadFile($file){
        $configs = $this->app->getConfig();
        if(strpos($file['name'],".apk") || strpos($file['name'],"ipa")){
            $filename = $file['name'];
        }else{
            $ext = explode("/",$file['type']);
            $filename = md5(date("YmdHis").rand(0,9)).".".$ext[1];
        }
        $accessKeyId = $configs['accessKeyId'];
        $accessKeySecret = $configs['accessKeySecret'];
        $endpoint = $configs['endpoint'];
        $bucket = $configs['bucket'];
        $object = 'uploads/'.date("Y").'/'.date("m").'/'.date('d').'/'.str_replace('\\', '/', $filename);
        try{
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ossClient->uploadFile($bucket, $object, $file["tmp_name"]);
        } catch(OssException $e) {
            throw $e;
        }
        $url = $endpoint.$object;
        return $url;
    }

    /**
     * 上传内容
     * @param string   $name 文件名(需要保持唯一)
     * @param string   $content 具体内容
     * @param string   $ext   文件后缀名
     */
    public function uploadContent($name="",$content,$ext="html"){
        $configs = $this->app->getConfig();
       
        $accessKeyId = $configs['accessKeyId'];
        $accessKeySecret = $configs['accessKeySecret'];
        $endpoint = $configs['endpoint'];
        $bucket = $configs['bucket'];
        
        if(!$name){
            //系统分配文件名
            $object = 'text/'.date("Y").'/'.date("m").'/'.date('d').'/';
            $name = md5(time().rand(0,9));
            $object = $object.$name.".".$ext;
        }else{
            //自定义文件名
            if($ext){
                $object = $name.".".$ext;
            }else{
                $object = $name;
            }
            
        }
        
        try{
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ossClient->putObject($bucket, $object, $content);
        } catch(OssException $e) {
            throw $e;
        }
        return $endpoint.$object;
    }
}
