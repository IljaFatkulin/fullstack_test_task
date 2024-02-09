import {addItemToCart, increaseItemCount} from "../redux/actions/cartActions";

const generateUniqueId = (productId, selectedAttributes) => {
    return productId + JSON.stringify(selectedAttributes);
};

export const addProductToCart = (dispatch, cartItems, product, selectedAttributeValues) => {
    const updatedProduct = {
        id: generateUniqueId(product.id, selectedAttributeValues),
        sku: product.id,
        name: product.name,
        currency: product.prices[0].currency.symbol,
        price: product.prices[0].amount,
        photo: product.gallery[0],
        attributes: selectedAttributeValues
    };

    const existingProduct = cartItems.find((item) => {
        return item.id === updatedProduct.id
    })

    if(existingProduct) {
        increaseItemCount(updatedProduct.id)(dispatch);
    } else {
        addItemToCart(updatedProduct)(dispatch);
    }
};