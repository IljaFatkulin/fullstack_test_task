import React, {useEffect, useState} from 'react';
import {gql, useQuery} from "@apollo/client";
import {useDispatch} from "react-redux";
import {setLoading} from "../../redux/actions/loaderActions";

import './Header.css';
import {useNavigate} from "react-router-dom";

const CATEGORY_QUERY = gql`
  {
    categories {
      name
    },
  }
`;

const Header = () => {
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { data, loading, error } = useQuery(CATEGORY_QUERY, {
        onCompleted: data => {
            if(window.location.href === 'http://localhost:3000/') {
                handleCategoryChange(data.categories[0].name)
            }
        }
    });
    const [selectedCategory, setSelectedCategory] = useState(null);

    useEffect(() => {
        const currentUrl = window.location.href.replace('http://localhost:3000/', '');
        if(currentUrl.includes('categories/')) {
            setSelectedCategory(currentUrl.replace('categories/', ''));
        }
    }, [window.location.href]);

    useEffect(() => {
        setLoading(loading)(dispatch);
    }, [loading]);

    const handleCategoryChange = (category) => {
        setSelectedCategory(category);
        navigate('/categories/' + category);
    };

    if(loading) return <></>;
    if(error) return <></>;

    const { categories } = data;

    return (
        <div className="Header">
            <div className="Header-nav">
                {categories.map(category =>
                    <div
                        className={`Header-nav-element ${selectedCategory === category.name ? 'Header-nav-element_selected' : ''}`}
                        key={category.name}
                        onClick={() => handleCategoryChange(category.name)}
                    >
                        {category.name.toUpperCase()}
                    </div>
                )}
            </div>

            <div className="Header-logo">
                <div className="Header-logo-img">
                    <img src="/images/logo.svg" alt="Logo"/>
                </div>
            </div>

            <div className="Header-cart">
                <div className="Header-cart-img">
                    <img src="/images/cart-black.svg" alt="Cart"/>
                </div>
            </div>
        </div>
    );
};

export default Header;