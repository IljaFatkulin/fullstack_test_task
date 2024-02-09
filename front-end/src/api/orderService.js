import axios from 'axios';
const url = process.env.REACT_APP_API_URL;

const orderService = {
    createOrder: (customerEmail, products) => {
        const productString = JSON.stringify(products)
            .replace(/"([^"]+)":/g, '$1:');

        return axios.post(url, {
            query: `
                mutation { 
                  createOrder(customer_email: "${customerEmail}", products: ${productString}) {
                        id
                  }
                }
            `,
        });
    }
}

export default orderService;
