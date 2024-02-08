import React, {useState} from 'react';

import './ProductDetails.css';
import {useParams} from "react-router-dom";
import {gql, useQuery} from "@apollo/client";

const ProductDetails = () => {
    const params = useParams();
    const { id } = params;
    const [selectedImage, setSelectedImage] = useState({id: 0, url: ''});
    const [attributeValues, setAttributeValues] = useState([]);

    const PRODUCTS_QUERY = gql`
      {
        products(id: "${id}") {
          id,
          name,
          inStock,
          gallery,
          description,
          category,
          attributes {
           id,
           items {
            displayValue,
            value,
            id
           },
           name,
           type
          }
          brand,
          prices {
           amount,
           currency {
            label,
            symbol
           }
          }
         }
      }
    `;

    const { data, loading, error } = useQuery(PRODUCTS_QUERY, {
        onCompleted: data => {
            setSelectedImage({id: 0, url: data.products[0].gallery[0]});
            // console.log(data.products[0].attributes);

            const modifiedAttributes = data.products[0].attributes.map(attribute => {
                return {id: attribute.id, name: attribute.name, type: attribute.type, selectedValue: {}}
            });

            setAttributeValues(modifiedAttributes);
        }
    });
    if(loading) return <></>;
    if(error) console.log(error);
    const product = data.products[0];
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
        // console.log(attributeId);
        // console.log(item);
        const modifiedAttributes = attributeValues.map(attribute => {
            if(attribute.id === attributeId) {
                return {...attribute, selectedValue: item};
            }

            return attribute;
        });

        setAttributeValues(modifiedAttributes);
        console.log(modifiedAttributes);
    };

    return (
        <div className="ProductDetails">
            <div className="ProductDetails-gallery">
                <div className="ProductDetails-gallery-images">
                    {gallery.slice(0, 5).map(image =>
                        <img key={image} src={image} alt="Product"/>
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
                                                ${attributeValues.find(item => item.id === attribute.id)?.selectedValue?.id === item.id && 'ProductDetails-info-attributes-attribute-items-item_swatch_selected'}
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
                                                ${attributeValues.find(item => item.id === attribute.id)?.selectedValue?.id === item.id && 'ProductDetails-info-attributes-attribute-items-item_text_selected'}
                                            `}
                                            // className="ProductDetails-info-attributes-attribute-items-item ProductDetails-info-attributes-attribute-items-item_text"
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

                <div className="ProductDetails-info-button">
                    ADD TO CART
                </div>

                <div
                    className="ProductDetails-info-description"
                    dangerouslySetInnerHTML={{
                        __html: product.description.replace(/(\\n)/g, '<br/>')
                    }}
                />

            </div>
        </div>
    );
};

export default ProductDetails;