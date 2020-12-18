<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_SaveCartGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

declare(strict_types=1);

namespace Mageplaza\SaveCartGraphQl\Model\Resolver\Mutation;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\SaveCart\Helper\Data;
use Mageplaza\SaveCartGraphQl\Model\Resolver\AbstractSaveCart;
use Mageplaza\SaveCart\Api\SaveCartRepositoryInterface;

/**
 * Class ShareCart
 * @package Mageplaza\SaveCartGraphQl\Model\Resolver\Mutation
 */
class ShareCart extends AbstractSaveCart
{
    /**
     * @var SaveCartRepositoryInterface
     */
    private $saveCartRepository;

    /**
     * ShareCart constructor.
     *
     * @param Data $helperData
     * @param SaveCartRepositoryInterface $saveCartRepository
     */
    public function __construct(
        Data $helperData,
        SaveCartRepositoryInterface $saveCartRepository
    ) {
        $this->saveCartRepository = $saveCartRepository;

        parent::__construct($helperData);
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        parent::resolve($field, $context, $info, $value, $args);
        if (!isset($args['token'])) {
            throw new GraphQlInputException(__('"token" value should be specified'));
        }

        return $this->saveCartRepository->share($args['token']);
    }
}
