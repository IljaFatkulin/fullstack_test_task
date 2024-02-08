import React, {useEffect, useState} from 'react';
import {useParams} from "react-router-dom";

import './Category.css';
import ProductCard from "../../components/ProductCard/ProductCard";
import {useDispatch} from "react-redux";
import {setLoading} from "../../redux/actions/loaderActions";
import productService from "../../api/productService";

const Category = () => {
    const params = useParams();
    const dispatch = useDispatch();
    const {category} = params;
    const capitalizedCategory = category.charAt(0).toUpperCase() + category.slice(1);
    const [products, setProducts] = useState([]);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        productService.getProducts(category)
            .then(response => {
                setProducts(response);
                setIsLoading(false);
            })
    }, []);

    useEffect(() => {
        setLoading(isLoading)(dispatch);
    }, [isLoading])

    if(isLoading) return <></>;

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