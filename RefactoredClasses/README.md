These classes are not needed.

Magento provides service contracts to handle the Cart Items and Products in the Cart.

Nonetheless, I did the refactoring by using the Cart and Product repositories, it's redundant though!

Also, the custom class Product isn't needed in the Cart class because we can get the items in the 
cart by using the service contract `CartItemRepositoryInterface::getList($cartId)`. 
