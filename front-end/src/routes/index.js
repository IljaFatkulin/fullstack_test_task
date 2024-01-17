import Category from "../pages/Category/Category";
import ProductDetails from "../pages/ProductDetails/ProductDetails";

export const routes = [
    {path: "/categories/:category", element: <Category/>},
    {path: "/products/:id", element: <ProductDetails/>},
];