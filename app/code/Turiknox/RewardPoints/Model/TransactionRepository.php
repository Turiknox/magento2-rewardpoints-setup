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
use Turiknox\RewardPoints\Api\TransactionRepositoryInterface;
use Turiknox\RewardPoints\Api\Data\TransactionInterface;
use Turiknox\RewardPoints\Api\Data\TransactionInterfaceFactory;
use Turiknox\RewardPoints\Api\Data\TransactionSearchResultsInterfaceFactory;
use Turiknox\RewardPoints\Model\ResourceModel\Transaction as ResourceTransaction;
use Turiknox\RewardPoints\Model\ResourceModel\Transaction\CollectionFactory as TransactionCollectionFactory;

class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var ResourceTransaction
     */
    protected $resource;

    /**
     * @var TransactionCollectionFactory
     */
    protected $transactionCollectionFactory;

    /**
     * @var TransactionSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var TransactionInterfaceFactory
     */
    protected $transactionInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        ResourceTransaction $resource,
        TransactionCollectionFactory $transactionCollectionFactory,
        TransactionSearchResultsInterfaceFactory $transactionSearchResultsInterfaceFactory,
        TransactionInterfaceFactory $transactionInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->resource = $resource;
        $this->transactionCollectionFactory = $transactionCollectionFactory;
        $this->searchResultsFactory = $transactionSearchResultsInterfaceFactory;
        $this->transactionInterfaceFactory = $transactionInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param TransactionInterface $transaction
     * @return TransactionInterface
     * @throws CouldNotSaveException
     */
    public function save(TransactionInterface $transaction)
    {
        try {
            /** @var TransactionInterface|\Magento\Framework\Model\AbstractModel $transaction */
            $this->resource->save($transaction);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the transaction: %1',
                $exception->getMessage()
            ));
        }
        return $transaction;
    }

    /**
     * Get transaction record
     *
     * @param $transactionId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($transactionId)
    {
        if (!isset($this->instances[$transactionId])) {
            /** @var \Turiknox\RewardPoints\Api\Data\TransactionInterface|\Magento\Framework\Model\AbstractModel $transaction */
            $transaction = $this->transactionInterfaceFactory->create();
            $this->resource->load($transaction, $transactionId);
            if (!$transaction->getId()) {
                throw new NoSuchEntityException(__('Requested transaction doesn\'t exist'));
            }
            $this->instances[$transactionId] = $transaction;
        }
        return $this->instances[$transactionId];
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Turiknox\RewardPoints\Api\Data\TransactionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Turiknox\RewardPoints\Api\Data\TransactionSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var \Turiknox\RewardPoints\Model\ResourceModel\Transaction\Collection $collection */
        $collection = $this->transactionCollectionFactory->create();

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
            $dataDataObject = $this->transactionInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray($dataDataObject, $datum->getData(), TransactionInterface::class);
            $data[] = $dataDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($data);
    }

    /**
     * @param TransactionInterface $transaction
     * @return bool
     * @throws CouldNotSaveException
     * @throws StateException
     */
    public function delete(TransactionInterface $transaction)
    {
        /** @var \Turiknox\RewardPoints\Api\Data\TransactionInterface|\Magento\Framework\Model\AbstractModel $transaction */
        $id = $transaction->getId();
        try {
            unset($this->instances[$id]);
            $this->resource->delete($transaction);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove transaction %1', $id)
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
