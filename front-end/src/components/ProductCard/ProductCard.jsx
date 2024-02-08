import React from 'react';

import './ProductCard.css';
import {useNavigate} from "react-router-dom";

const ProductCard = ({product}) => {
    const navigate = useNavigate();
    const isInStock = product.inStock;

    const handleClick = () => {
        navigate('/products/' + product.id);
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
                <div className="ProductCard-cart">
                    <img src="/images/cart-white.svg" alt="Cart"/>
                </div>
            }
        </div>
    );
};

export default ProductCard;