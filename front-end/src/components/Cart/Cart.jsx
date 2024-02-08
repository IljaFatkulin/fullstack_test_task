import React from 'react';

import './Cart.css';

const Cart = ({setIsCartVisible}) => {

    const closeCart = () => {
        setIsCartVisible(false);
    }

    const stopPropagation = (e) => {
        e.stopPropagation();
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
                        3 items
                    </p>
                </div>

                <div className="Cart-Content-Items">

                </div>
            </div>
        </div>
    );
};

export default Cart;