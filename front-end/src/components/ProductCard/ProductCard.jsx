import React from 'react';

import './ProductCard.css';

const ProductCard = ({product}) => {
    return (
        <div className="ProductCard">
            <div className="ProductCard-imageContainer">
                <img src={product.gallery[0]} alt="Product"/>
            </div>
            <div className="ProductCard-info">
                <p>{product.name}</p>
                <p>{product.prices[0].amount}</p>
            </div>
        </div>
    );
};

export default ProductCard;