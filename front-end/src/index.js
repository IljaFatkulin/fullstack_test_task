import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import {ApolloClient, ApolloProvider, InMemoryCache} from "@apollo/client";
import {Provider} from "react-redux";
import {store} from "./redux/reducers";

import './styles/main.css';

const client = new ApolloClient({
    uri: "http://localhost/fullstack_test_task/back-end/public/",
    cache: new InMemoryCache()

});

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  // <React.StrictMode>
    <Provider store={store}>
        <ApolloProvider client={client}>
            <App />
        </ApolloProvider>
    </Provider>
  // </React.StrictMode>
);
