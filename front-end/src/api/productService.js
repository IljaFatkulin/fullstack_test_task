import axios from 'axios';
const url = process.env.REACT_APP_API_URL;

const productService = {
    getProducts: (category) => {
        return axios.post(url, {
            query: `
                query { 
                    products(categoryName: "${category}") {
                      id,
                      name,
                      inStock,
                      gallery,
                      prices {
                       amount,
                       currency {
                        label,
                        symbol
                       }
                      }
                     }
                }
            `,
        }).then(response => {
            return response.data.data.products;
        });
    },

    getProduct: (id) => {
        return axios.post(url, {
            query: `
                query {
                    products(id: "${id}") {
                      id,
                      name,
                      inStock,
                      gallery,
                      description,
                      category,
                      attributes {
                       id,
                       items {
                        displayValue,
                        value,
                        id
                       },
                       name,
                       type
                      }
                      brand,
                      prices {
                       amount,
                       currency {
                        label,
                        symbol
                       }
                      }
                     }
                }
            `,
        }).then(response => {
            return response.data.data.products[0];
        });
    }
}

export default productService;
