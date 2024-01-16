import React from 'react';
import {useParams} from "react-router-dom";
import {gql, useQuery} from "@apollo/client";

import './Category.css';
import ProductCard from "../../components/ProductCard/ProductCard";

const Category = () => {
    const params = useParams();
    const {category} = params;
    const capitalizedCategory = category.charAt(0).toUpperCase() + category.slice(1);

    const PRODUCTS_QUERY = gql`
  {
    products(categoryName: "${category}") {
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
    const { data, loading, error } = useQuery(PRODUCTS_QUERY);
    if(loading) return <></>;
    if(error) console.log(error);

    const { products } = data;
    console.log(products);

    return (
        <div className="Category">
            <div className="Category-title">
                <p>{capitalizedCategory}</p>
            </div>

            <div className="Category-products">
                {products.map(product =>
                    <ProductCard
                        key={product.id}
                        product={product}
                    />
                )}
            </div>
        </div>
    );
};

export default Category;