<?php
/**
 * Created by PhpStorm.
 * User: astronom
 * Date: 29.05.17
 * Time: 18:18
 */

namespace AppBundle\Model;


class Payment
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $md5;

    private $valid = false;

    public function __construct($userId, $amount, $md5)
    {
        $this->userId = $userId;
        $this->amount = $amount;
        $this->md5 = $md5;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getMd5(): string
    {
        return $this->md5;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     *
     * @return Payment
     */
    public function setValid(bool $valid): Payment
    {
        $this->valid = $valid;

        return $this;
    }
}