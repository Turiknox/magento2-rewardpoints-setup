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
use Turiknox\RewardPoints\Api\Data\RateInterface;

interface RateRepositoryInterface
{
    /**
     * @param RateInterface $rate
     * @return mixed
     */
    public function save(RateInterface $rate);

    /**
     * @param $rateId
     * @return mixed
     */
    public function getById($rateId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Turiknox\RewardPoints\Api\Data\RateSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param RateInterface $rate
     * @return mixed
     */
    public function delete(RateInterface $rate);

    /**
     * @param $rateId
     * @return mixed
     */
    public function deleteById($rateId);
}
