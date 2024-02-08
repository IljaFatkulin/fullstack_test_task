import React, {useEffect, useState} from 'react';
import {useDispatch} from "react-redux";
import {setLoading} from "../../redux/actions/loaderActions";

import './Header.css';
import {useNavigate} from "react-router-dom";
import categoryService from "../../api/categoryService";

const Header = ({handleCartClick}) => {
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const [categories, setCategories] = useState([]);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        categoryService.getCategories()
            .then(response => {
                if(window.location.pathname === '/') {
                    handleCategoryChange(response[0].name)
                }
                setCategories(response);
                setIsLoading(false);
        });
    }, []);


    const [selectedCategory, setSelectedCategory] = useState(null);

    useEffect(() => {
        const currentPath = window.location.pathname;
        if(currentPath.includes('/categories/')) {
            setSelectedCategory(currentPath.replace('/categories/', ''));
        }
    }, [window.location.href]);

    useEffect(() => {
        setLoading(isLoading)(dispatch);
    }, [isLoading]);

    const handleCategoryChange = (category) => {
        setSelectedCategory(category);
        navigate('/categories/' + category);
    };

    if(isLoading) return <></>;

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

            <div
                className="Header-cart"
                onClick={handleCartClick}
            >
                <div className="Header-cart-img">
                    <img src="/images/cart-black.svg" alt="Cart"/>
                </div>
            </div>
        </div>
    );
};

export default Header;