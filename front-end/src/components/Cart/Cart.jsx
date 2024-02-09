import React from 'react';

import './Cart.css';
import {useDispatch, useSelector} from "react-redux";
import {clearCart, decreaseItemCount, increaseItemCount} from "../../redux/actions/cartActions";
import orderService from "../../api/orderService";

const Cart = ({setIsCartVisible}) => {
    const cart = useSelector(state => state.cart.items);
    const totalAmount = useSelector(state => state.cart.totalAmount);

    const dispatch = useDispatch();
    const totalCount = useSelector(state => state.cart.totalCount);

    const closeCart = () => {
        setIsCartVisible(false);
    };

    const stopPropagation = (e) => {
        e.stopPropagation();
    };

    const handleIncreaseCount = (id) => {
        increaseItemCount(id)(dispatch);
    };

    const handleDecreaseCount = (id) => {
        decreaseItemCount(id)(dispatch);
    };

    const renderTotal = () => {
        return (
            <div className="Cart-Content-Total">
                <p>Total</p>
                <p>{cart && cart.length ? cart[0].currency : ''}{totalAmount}</p>
            </div>
        );
    };

    const renderPlaceOrderButton = () => {
        return (
            <button
                disabled={totalCount < 1}
                className={`Cart-Content-PlaceOrder ${totalCount < 1 ? 'Cart-Content-PlaceOrder_disabled' : ''}`}
                onClick={handlePlaceOrder}
            >
                PLACE ORDER
            </button>
        );
    }

    const handlePlaceOrder = () => {
        const products = cart.map((item) => {
            const attributes = item.attributes.map((attribute) => {
                return {
                    attribute_code: attribute.id,
                    value_code: attribute.selectedValue.id
                }
            })
           return {
               product_id: item.sku,
               quantity: item.count,
               attributes: attributes
           }
        });

        const customerEmail = "ilja@gmail.com";

        orderService.createOrder(customerEmail, products)
            .then(() => {
                clearCart()(dispatch);
            });
    }

    return (
        <div
            className="Cart"
            onClick={closeCart}
        >
            <div
                className="Cart-Content"
                onClick={stopPropagation}
            >
                <div className="Cart-Content-MyBag">
                    <p className="Cart-Content-MyBag-Label">
                        My Bag,
                    </p>
                    <p className="Cart-Content-MyBag-Count">
                        {totalCount} items
                    </p>
                </div>

                <div className="Cart-Content-Items">
                    {cart.map(product => (
                        <div
                            key={product.id}
                            className="Cart-Content-Items-item"
                        >
                            <div className="Cart-Content-Items-item-info">
                                <div className="Cart-Content-Items-item-info-main">
                                    <p className="Cart-Content-Items-item-info-main-name">{product.name}</p>
                                    <p className="Cart-Content-Items-item-info-main-price">{product.currency}{product.price}</p>
                                    {product.attributes.map(attribute => (
                                        <div
                                            key={attribute.id}
                                           className="Cart-Content-Items-item-info-attribute"
                                        >
                                            <p className="Cart-Content-Items-item-info-attribute-label">{attribute.name}</p>
                                            <div className="Cart-Content-Items-item-info-attribute-items">
                                                {attribute.type === 'swatch'
                                                    ?
                                                    attribute.items.map(item =>
                                                        <div
                                                            className={`
                                                                Cart-Content-Items-item-info-attribute-items-item 
                                                                Cart-Content-Items-item-info-attribute-items-item_swatch
                                                                ${attribute.selectedValue.id === item.id && 'Cart-Content-Items-item-info-attribute-items-item_swatch_selected'}
                                                            `}
                                                            key={item.id}
                                                            style={{
                                                                background: item.value
                                                            }}
                                                        />
                                                    )
                                                    :
                                                    attribute.items.map(item =>
                                                        <div
                                                            className={`
                                                                Cart-Content-Items-item-info-attribute-items-item 
                                                                Cart-Content-Items-item-info-attribute-items-item_text
                                                                ${attribute.selectedValue.id === item.id && 'Cart-Content-Items-item-info-attribute-items-item_text_selected'}
                                                            `}
                                                            key={item.id}
                                                        >
                                                            {item.value}
                                                        </div>
                                                    )
                                                }
                                            </div>
                                        </div>
                                    ))}

                                </div>

                                <div className="Cart-Content-Items-item-info-count">
                                    <div
                                        className="Cart-Content-Items-item-info-count-change"
                                        onClick={() => handleIncreaseCount(product.id)}
                                    >
                                        +
                                    </div>
                                    <p>{product.count}</p>
                                    <div
                                        className="Cart-Content-Items-item-info-count-change"
                                        onClick={() => handleDecreaseCount(product.id)}
                                    >
                                        -
                                    </div>
                                </div>
                            </div>
                            <div className="Cart-Content-Items-item-photo">
                                <img src={product.photo} alt="Product"/>
                            </div>
                        </div>
                    ))}
                </div>

                { renderTotal() }
                { renderPlaceOrderButton() }
            </div>
        </div>
    );
};

export default Cart;