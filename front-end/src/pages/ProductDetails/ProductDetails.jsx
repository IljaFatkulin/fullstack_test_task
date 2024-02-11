import React, {useEffect, useState} from 'react';

import './ProductDetails.css';
import {useNavigate, useParams} from "react-router-dom";
import {useDispatch, useSelector} from "react-redux";
import productService from "../../api/productService";
import {addProductToCart} from "../../util/CartUtil";
import {Parser} from "html-to-react";

const ProductDetails = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const cartItems = useSelector(state => state.cart.items);
    const params = useParams();
    const { id } = params;
    const [selectedImage, setSelectedImage] = useState({id: 0, url: ''});
    const [selectedAttributeValues, setSelectedAttributeValues] = useState([]);
    const [product, setProduct] = useState({});
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        productService.getProduct(id)
            .then(response => {
                if (!response) {
                    navigate('/notfound');
                }

                setSelectedImage({id: 0, url: response.gallery[0]});

                const modifiedAttributes = response.attributes.map(attribute => {
                    return {id: attribute.id, name: attribute.name, type: attribute.type, selectedValue: {}, items: attribute.items}
                });

                setSelectedAttributeValues(modifiedAttributes);
                setProduct(response);
                setIsLoading(false);
            })
    }, []);

    if(isLoading) return <></>;

    const { gallery, attributes } = product;

    const handleClickArrowRight = () => {
        let id = selectedImage.id + 1;
        if(id < gallery.length) {
            setSelectedImage({id: id, url: gallery[id]});
        } else {
            setSelectedImage({id: 0, url: gallery[0]});
        }
    };

    const handleClickArrowLeft = () => {
        let id = selectedImage.id - 1;
        if(id >= 0) {
            setSelectedImage({id: id, url: gallery[id]});
        } else {
            setSelectedImage({id: gallery.length - 1, url: gallery[gallery.length - 1]});
        }
    };

    const handleAttributeClick = (attributeId, item) => {
        const modifiedAttributes = selectedAttributeValues.map(attribute => {
            if(attribute.id === attributeId) {
                return {...attribute, selectedValue: item};
            }

            return attribute;
        });

        setSelectedAttributeValues(modifiedAttributes);
    };

    const handleImageClick = (id, image) => {
        setSelectedImage({id: id, url: image});
    }

    const handleAddToCart = () => {
        addProductToCart(dispatch, cartItems, product, selectedAttributeValues);
    };

    const renderAddToCartButton = () => {
        let allAttributesAreSelected = true;
        for (const item of selectedAttributeValues) {
            if(Object.keys(item.selectedValue).length === 0) {
                allAttributesAreSelected = false;
                break;
            }
        }

        return (
            <button
                disabled={!product.inStock || !allAttributesAreSelected}
                className={`ProductDetails-info-button ${!product.inStock || !allAttributesAreSelected ? 'ProductDetails-info-button_disabled' : ''}`}
                onClick={handleAddToCart}
            >
                {product.inStock ? 'ADD TO CART' : 'OUT OF STOCK'}
            </button>
        );
    };

    return (
        <div className="ProductDetails">
            <div className="ProductDetails-gallery">
                <div className="ProductDetails-gallery-images">
                    {gallery.map((image, index) =>
                        <img onClick={() => handleImageClick(index, image)} key={image} src={image} alt="Product"/>
                    )}
                </div>

                <div className="ProductDetails-gallery-selectedImage">
                    <div
                        className="ProductDetails-gallery-selectedImage-arrow ProductDetails-gallery-selectedImage-arrow_left"
                        onClick={handleClickArrowLeft}
                    >
                        <img src="/images/arrowLeft.svg" alt="left"/>
                    </div>

                    <img src={selectedImage.url} alt="Product"/>

                    <div
                        className="ProductDetails-gallery-selectedImage-arrow ProductDetails-gallery-selectedImage-arrow_right"
                        onClick={handleClickArrowRight}
                    >
                        <img src="/images/arrowRight.svg" alt="right"/>
                    </div>
                </div>
            </div>

            <div className="ProductDetails-info">
                <div className="ProductDetails-info-name">
                    {product.name}
                </div>

                <div className="ProductDetails-info-attributes">
                    {attributes.map(attribute =>
                        <div
                            className="ProductDetails-info-attributes-attribute"
                            key={attribute.id}
                        >
                            <div className="ProductDetails-info-attributeTitle">
                                {attribute.name.toUpperCase()}:
                            </div>

                            <div className="ProductDetails-info-attributes-attribute-items">
                                {attribute.type === 'swatch'
                                    ?
                                    attribute.items.map(item =>
                                        <div
                                            className={`
                                                ProductDetails-info-attributes-attribute-items-item 
                                                ProductDetails-info-attributes-attribute-items-item_swatch
                                                ${selectedAttributeValues.find(item => item.id === attribute.id)?.selectedValue?.id === item.id && 'ProductDetails-info-attributes-attribute-items-item_swatch_selected'}
                                            `}
                                            key={item.id}
                                            style={{
                                                background: item.value
                                            }}
                                            onClick={() => {
                                                handleAttributeClick(attribute.id, item)
                                            }}
                                        />
                                    )
                                    :
                                    attribute.items.map(item =>
                                        <div
                                            className={`
                                                ProductDetails-info-attributes-attribute-items-item 
                                                ProductDetails-info-attributes-attribute-items-item_text
                                                ${selectedAttributeValues.find(item => item.id === attribute.id)?.selectedValue?.id === item.id && 'ProductDetails-info-attributes-attribute-items-item_text_selected'}
                                            `}
                                            key={item.id}
                                            onClick={() => {
                                                handleAttributeClick(attribute.id, item)
                                            }}
                                        >
                                            {item.value}
                                        </div>
                                    )
                                }
                            </div>
                        </div>
                    )}
                </div>

                <div className="ProductDetails-info-attributeTitle">PRICE:</div>
                <div className="ProductDetails-info-price">
                    <div className="ProductDetails-info-price-symbol">
                        {product.prices[0].currency.symbol}
                    </div>
                    <div className="ProductDetails-info-price-amount">
                        {product.prices[0].amount}
                    </div>
                </div>

                { renderAddToCartButton() }


                <div
                    className="ProductDetails-info-description"
                >
                    {Parser().parse(product.description.replace(/(\\n)/g, '<br/>'))}
                </div>

            </div>
        </div>
    );
};

export default ProductDetails;