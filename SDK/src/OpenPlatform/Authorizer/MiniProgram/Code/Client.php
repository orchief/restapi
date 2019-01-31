<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OpenPlatform\Authorizer\MiniProgram\Code;

use SDK\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param int    $templateId
     * @param string $extJson
     * @param string $version
     * @param string $description
     *
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function commit(int $templateId, string $extJson, string $version, string $description)
    {
        return $this->httpPostJson('wxa/commit', [
            'template_id' => $templateId,
            'ext_json' => $extJson,
            'user_version' => $version,
            'user_desc' => $description,
        ]);
    }

    /**
     * @return \SDK\Kernel\Http\Response
     */
    public function getQrCode()
    {
        return $this->requestRaw('wxa/get_qrcode', 'GET');
    }

    /**
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function getCategory()
    {
        return $this->httpGet('wxa/get_category');
    }

    /**
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function getPage()
    {
        return $this->httpGet('wxa/get_page');
    }

    /**
     * @param array $itemList
     *
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function submitAudit(array $itemList)
    {
        return $this->httpPostJson('wxa/submit_audit', [
            'item_list' => $itemList,
        ]);
    }

    /**
     * @param int $auditId
     *
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function getAuditStatus(int $auditId)
    {
        return $this->httpPostJson('wxa/get_auditstatus', [
            'auditid' => $auditId,
        ]);
    }

    /**
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function getLatestAuditStatus()
    {
        return $this->httpGet('wxa/get_latest_auditstatus');
    }

    /**
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function release()
    {
        return $this->httpPostJson('wxa/release');
    }

    /**
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function withdrawAudit()
    {
        return $this->httpGet('wxa/undocodeaudit');
    }

    /**
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function rollbackRelease()
    {
        return $this->httpGet('wxa/revertcoderelease');
    }

    /**
     * @param string $action
     *
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function changeVisitStatus(string $action)
    {
        return $this->httpPostJson('wxa/change_visitstatus', [
            'action' => $action,
        ]);
    }
}