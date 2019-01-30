<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OfficialAccount\Card;

use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \SDK\OfficialAccount\Card\CodeClient $code
 * @property \SDK\OfficialAccount\Card\MeetingTicketClient $meeting_ticket
 * @property \SDK\OfficialAccount\Card\MemberCardClient $member_card
 * @property \SDK\OfficialAccount\Card\GeneralCardClient $general_card
 * @property \SDK\OfficialAccount\Card\MovieTicketClient $movie_ticket
 * @property \SDK\OfficialAccount\Card\CoinClient $coin
 * @property \SDK\OfficialAccount\Card\SubMerchantClient $sub_merchant
 * @property \SDK\OfficialAccount\Card\BoardingPassClient $boarding_pass
 * @property \SDK\OfficialAccount\Card\JssdkClient $jssdk
 */
class Card extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \SDK\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["card.{$property}"])) {
            return $this->app["card.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No card service named "%s".', $property));
    }
}
