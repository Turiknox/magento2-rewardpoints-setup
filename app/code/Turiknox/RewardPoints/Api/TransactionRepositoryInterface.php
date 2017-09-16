<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Turiknox\RewardPoints\Api\Data\TransactionInterface;

interface TransactionRepositoryInterface
{
    /**
     * @param TransactionInterface $transaction
     * @return mixed
     */
    public function save(TransactionInterface $transaction);

    /**
     * @param $transactionId
     * @return mixed
     */
    public function getById($transactionId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Turiknox\RewardPoints\Api\Data\TransactionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param TransactionInterface $transaction
     * @return mixed
     */
    public function delete(TransactionInterface $transaction);

    /**
     * @param $transactionId
     * @return mixed
     */
    public function deleteById($transactionId);
}
