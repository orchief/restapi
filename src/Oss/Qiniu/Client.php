<?php

/*
 * 七牛云OSS
 */

namespace SDK\Oss\Qiniu;

use SDK\Kernel\BaseClient;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
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
     * @return string 
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
        $domain = $configs['domain'];
        $bucket = $configs['bucket'];
        $object = 'uploads/'.date("Y").'/'.date("m").'/'.date('d').'/'.str_replace('\\', '/', $filename);


        // 构建鉴权对象
        $auth = new Auth($accessKeyId,$accessKeySecret);

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);


        $uploadMgr = new UploadManager();

        list($ret, $err) = $uploadMgr->putFile($token, $object, $file["tmp_name"]);
        if ($err !== null) {
            throw new Exception("上传失败");
        }else{
            $url = $domain.$object;
            return $url;
        }
    }

    /**
     * 上传内容
     * @param string   $name 文件名(需要保持唯一)
     * @param string   $content 具体内容
     * @param string   $ext   文件后缀名
     * @return string
     */
    public function uploadContent($name="",$content,$ext="html"){
        $configs = $this->app->getConfig();
       
        $accessKeyId = $configs['accessKeyId'];
        $accessKeySecret = $configs['accessKeySecret'];
        $domain = $configs['domain'];
        $bucket = $configs['bucket'];

        // 构建鉴权对象
        $auth = new Auth($accessKeyId,$accessKeySecret);

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);


        $uploadMgr = new UploadManager();

        
        if(!$name){
            //系统分配文件名
            $object = 'text/'.date("Y").'/'.date("m").'/'.date('d').'/';
            $name = md5(time().rand(0,9));
            $fileName = $object.$name.".".$ext;
        }else{
            //自定义文件名
            if($ext){
                $fileName = $name.".".$ext;
            }else{
                $fileName = $name;
            }
            
        }
        
        list($ret, $err) = $uploadMgr->put($token, $fileName, $content);
        
        if ($err !== null) {
            throw new Exception("上传失败");
        } else {
            return $domain.$ret['key'];
        }
    }
}
