<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={
 *          @ORM\Index(name="name", columns={"name"}),
 *          @ORM\Index(name="updated_at", columns={"updated_at"}),
 *     })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="balance", type="decimal", precision=10, scale=2)
     */
    private $balance;

    /**
     * @var int
     *
     * @ORM\Column(name="updated_at", type="integer", nullable=true)
     *
     */
    private $updatedAt;

    /**
     * @var ArrayCollection|UserTransaction[]
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\UserTransaction", mappedBy="user", cascade={"persist"})
     */
    private $transactions;


    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return User
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set updatedAt
     *
     * @param integer $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return ArrayCollection|UserTransaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param User $transactions
     *
     * @return User
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;

        return $this;
    }

    /**
     * @param UserTransaction $transaction
     */
    public function addTransaction(UserTransaction $transaction)
    {
        $this->transactions->add($transaction);
        $this->replenishBalance($transaction->getAmount());
    }

    /**
     * @param float $replenishAmount
     *
     * @return $this
     */
    public function replenishBalance(float $replenishAmount)
    {
        $this->balance += $replenishAmount;

        return $this;
    }

    /**
     * @ORM\PreUpdate()
     *
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(time());
    }
}

