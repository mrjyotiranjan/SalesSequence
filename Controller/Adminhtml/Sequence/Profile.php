<?php
/**
 * Copyright © Jyotiranjan Behera
 * See COPYING.txt for license details.
 */
namespace Helloworld\SalesSequence\Controller\Adminhtml\Sequence;

use Magento\Framework\Registry;
use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\SalesSequence\Model\ProfileFactory;
use Magento\SalesSequence\Model\MetaFactory;
use Psr\Log\LoggerInterface;

/**
 * Sequence profile controller
 */
abstract class Profile extends Action
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Sequence profile
     *
     * @var ProfileFactory
     */
    protected $profileFactory;

    /**
     * Sequence meta
     *
     * @var MetaFactory
     */
    protected $metaFactory;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ProfileFactory $profileFactory
     * @param MetaFactory $metaFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProfileFactory $profileFactory,
        MetaFactory $metaFactory,
        LoggerInterface $logger
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->profileFactory = $profileFactory;
        $this->metaFactory = $metaFactory;
        $this->logger = $logger;

        parent::__construct(
            $context
        );
    }

    /**
     * Initialize profile model based on profile id in request
     *
     * @return \Magento\SalesSequence\Model\Profile
     * @throws LocalizedException
     */
    protected function initProfile()
    {
        $profileId = $this->getRequest()->getParam('profile_id');
        if ($profileId) {
            $profile = $this->profileFactory->create()->load($profileId);
            if ($profile) {
                $meta = $this->metaFactory->create()->load(
                    $profile->getMetaId()
                );
                $profile->setData('entity_type', $meta->getEntityType());
                $profile->setData('store_id', $meta->getStoreId());

                /* register current region */
                $this->coreRegistry->register(
                    'current_sequence_profile',
                    $profile
                );
                return $profile;
            }
        }

        throw new LocalizedException(
            __('Please correct the profile you requested.')
        );
    }

    /**
     * Check current user permission on resource and privilege
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(
            'Helloworld_Sequence::profile'
        );
    }
}
