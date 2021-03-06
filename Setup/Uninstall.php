<?php
/**
 * Copyright © Jyotiranjan Behera
 * See COPYING.txt for license details.
 */
namespace Helloworld\SalesSequence\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Uninstall sales sequence
 */
class Uninstall implements UninstallInterface
{
    /**
     * Uninstall DB schema
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->removeColumns($setup);
        $setup->endSetup();
    }

    /**
     * Remove columns
     *
     * @param SchemaSetupInterface $setup
     * @return void
     */
    protected function removeColumns(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_sequence_profile'),
            'pattern'
        );
    }
}
