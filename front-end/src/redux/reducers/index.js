import {applyMiddleware, combineReducers, createStore} from "redux";
import {loaderReducer} from "./loaderReducer";
import {thunk} from "redux-thunk";

const rootReducer = combineReducers({
    loader: loaderReducer,
});

export const store = createStore(rootReducer, applyMiddleware(thunk));