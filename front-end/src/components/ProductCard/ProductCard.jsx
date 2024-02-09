import React from 'react';

import './ProductCard.css';
import {useNavigate} from "react-router-dom";
import productService from "../../api/productService";
import {addProductToCart} from "../../util/CartUtil";
import {useDispatch, useSelector} from "react-redux";

const ProductCard = ({product}) => {
    const navigate = useNavigate();
    const isInStock = product.inStock;
    const dispatch = useDispatch();
    const cartItems = useSelector(state => state.cart.items);

    const handleClick = () => {
        navigate('/products/' + product.id);
    }

    const handleAddToCartClick = (e) => {
        e.stopPropagation();
        productService.getProduct(product.id)
            .then(response => {
                const selectedAttributes = response.attributes.map(attribute => {
                    return {
                        ...attribute,
                        selectedValue: attribute.items[0]
                    }
                });
                addProductToCart(dispatch, cartItems, response, selectedAttributes);
            });
    }

    return (
        <div
            className="ProductCard"
            onClick={handleClick}
        >
            <div className="ProductCard-imageContainer">
                {!isInStock &&
                    <div className="ProductCard-imageContainer_outOfStock">
                        <p>OUT OF STOCK</p>
                    </div>
                }
                <img src={product.gallery[0]} alt="Product"/>
            </div>
            <div className="ProductCard-info">
                <p className="ProductCard-info-title">
                    {product.name}
                </p>

                <p className="ProductCard-info-price">
                    {product.prices[0].amount} {product.prices[0].currency.symbol}
                </p>

            </div>

            {isInStock &&
                <button
                    className="ProductCard-cart"
                    onClick={handleAddToCartClick}
                >
                    <img src="/images/cart-white.svg" alt="Cart"/>
                </button>
            }
        </div>
    );
};

export default ProductCard;