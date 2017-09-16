<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TransactionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get transaction list.
     *
     * @return \Turiknox\RewardPoints\Api\Data\TransactionInterface[]
     */
    public function getItems();

    /**
     * Set transaction list.
     *
     * @param \Turiknox\RewardPoints\Api\Data\TransactionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
