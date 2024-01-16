import React from 'react';
import {Route, Routes} from "react-router-dom";
import {routes} from "../routes";

const AppRouter = () => {
    return (
        <Routes>
            {routes.map(route =>
                <Route
                    element={route.element}
                    path={route.path}
                    key={route.path}
                />
            )}
        </Routes>
    );
};

export default AppRouter;