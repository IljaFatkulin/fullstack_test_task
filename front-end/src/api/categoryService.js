import axios from 'axios';
const url = process.env.REACT_APP_API_URL;

const categoryService = {
    getCategories: () => {
        return axios.post(url, {
            query: `
                query { 
                    categories {
                      name
                    },
                }
            `,
        }).then(response => {
            return response.data.data.categories;
        });
    }
}

export default categoryService;
