<?php
declare(strict_types=1);

namespace Envisage\NextDayDelivery\RefactoredClasses;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartItemRepositoryInterface;
use Magento\Quote\Api\Data\CartItemInterface;

class Cart
{
    /**
     * Cart Constructor.
     *
     * @param CartItemRepositoryInterface $cartItemRepository
     */
    public function __construct(
        private readonly CartItemRepositoryInterface $cartItemRepository,
    ) {
    }

    /**
     * @param $item
     * @return CartItemInterface
     * @throws CouldNotSaveException
     * @throws InputException
     * @throws NoSuchEntityException
     */
    public function addProduct($item): CartItemInterface
    {
        return $this->cartItemRepository->save($item);
    }

    /**
     * @param $cartId
     * @param $itemId
     * @return bool
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function removeProduct($cartId, $itemId): bool
    {
        return $this->cartItemRepository->deleteById($cartId, $itemId);
    }

    /**
     * @param $cartId
     * @return float|int
     * @throws NoSuchEntityException
     */
    public function getTotal($cartId): float|int
    {
        $cartItems = $this->cartItemRepository->getList($cartId);

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->getPrice() * $item->getQty();
        }

        return $total;
    }
}
