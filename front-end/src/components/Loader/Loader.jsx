import React from 'react';
import {MutatingDots} from "react-loader-spinner";

import './Loader.css';

const Loader = ({isLoading}) => {
    if(!isLoading) return <></>;

    return (
        <div className="Loader">
            <MutatingDots
            />
        </div>
    );
};

export default Loader;