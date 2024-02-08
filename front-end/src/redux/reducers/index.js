import {applyMiddleware, combineReducers, createStore} from "redux";
import {loaderReducer} from "./loaderReducer";
import {thunk} from "redux-thunk";
import {cartReducer} from "./cartReducer";

const rootReducer = combineReducers({
    loader: loaderReducer,
    cart: cartReducer
});

export const store = createStore(rootReducer, applyMiddleware(thunk));