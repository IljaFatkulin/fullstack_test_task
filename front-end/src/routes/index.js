import Category from "../pages/Category/Category";
import ProductDetails from "../pages/ProductDetails/ProductDetails";
import NotFound from "../pages/NotFound/NotFound";

export const routes = [
    {path: "/categories/:category", element: <Category/>},
    {path: "/products/:id", element: <ProductDetails/>},
    {path: "/notfound", element: <NotFound/>}
];