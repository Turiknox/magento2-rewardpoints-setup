<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\NoSuchEntityException;
use Turiknox\RewardPoints\Api\RateRepositoryInterface;
use Turiknox\RewardPoints\Api\Data\RateInterface;
use Turiknox\RewardPoints\Api\Data\RateInterfaceFactory;
use Turiknox\RewardPoints\Api\Data\RateSearchResultsInterfaceFactory;
use Turiknox\RewardPoints\Model\ResourceModel\Rate as ResourceRate;
use Turiknox\RewardPoints\Model\ResourceModel\Rate\CollectionFactory as RateCollectionFactory;

class EntityRepository implements RateRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var ResourceRate
     */
    protected $resource;

    /**
     * @var RateCollectionFactory
     */
    protected $rateCollectionFactory;

    /**
     * @var RateSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var RateInterfaceFactory
     */
    protected $rateInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        ResourceRate $resource,
        RateCollectionFactory $rateCollectionFactory,
        RateSearchResultsInterfaceFactory $rateSearchResultsInterfaceFactory,
        RateInterfaceFactory $rateInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->resource = $resource;
        $this->rateCollectionFactory = $rateCollectionFactory;
        $this->searchResultsFactory = $rateSearchResultsInterfaceFactory;
        $this->rateInterfaceFactory = $rateInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param RateInterface $rate
     * @return RateInterface
     * @throws CouldNotSaveException
     */
    public function save(RateInterface $rate)
    {
        try {
            /** @var RateInterface|\Magento\Framework\Model\AbstractModel $rate */
            $this->resource->save($rate);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the rate: %1',
                $exception->getMessage()
            ));
        }
        return $rate;
    }

    /**
     * Get rate record
     *
     * @param $rateId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($rateId)
    {
        if (!isset($this->instances[$rateId])) {
            /** @var \Turiknox\RewardPoints\Api\Data\RateInterface|\Magento\Framework\Model\AbstractModel $rate */
            $rate = $this->rateInterfaceFactory->create();
            $this->resource->load($rate, $rateId);
            if (!$rate->getId()) {
                throw new NoSuchEntityException(__('Requested rate doesn\'t exist'));
            }
            $this->instances[$rateId] = $rate;
        }
        return $this->instances[$rateId];
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Turiknox\RewardPoints\Api\Data\RateSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Turiknox\RewardPoints\Api\Data\RateSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var \Turiknox\RewardPoints\Model\ResourceModel\Rate\Collection $collection */
        $collection = $this->rateCollectionFactory->create();

        //Add filters from root filter group to the collection
        /** @var FilterGroup $group */
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        $sortOrders = $searchCriteria->getSortOrders();
        /** @var SortOrder $sortOrder */
        if ($sortOrders) {
            foreach ($searchCriteria->getSortOrders() as $sortOrder) {
                $field = $sortOrder->getField();
                $collection->addOrder(
                    $field,
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        } else {
            $field = 'entity_id';
            $collection->addOrder($field, 'ASC');
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $data = [];
        foreach ($collection as $datum) {
            $dataDataObject = $this->rateInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray($dataDataObject, $datum->getData(), RateInterface::class);
            $data[] = $dataDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($data);
    }

    /**
     * @param RateInterface $rate
     * @return bool
     * @throws CouldNotSaveException
     * @throws StateException
     */
    public function delete(RateInterface $rate)
    {
        /** @var \Turiknox\RewardPoints\Api\Data\RateInterface|\Magento\Framework\Model\AbstractModel $rate */
        $id = $rate->getId();
        try {
            unset($this->instances[$id]);
            $this->resource->delete($rate);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove rate %1', $id)
            );
        }
        unset($this->instances[$id]);
        return true;
    }

    /**
     * @param $entityId
     * @return bool
     */
    public function deleteById($entityId)
    {
        $entity = $this->getById($entityId);
        return $this->delete($entity);
    }
}
