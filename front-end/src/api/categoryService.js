import axios from 'axios';
// const url = process.env.REACT_APP_API_URL;
// const url = "http://localhost/fullstack_test_task/back-end/public/";
const url = "http://ilfat.fhost.lv/backend/public/";

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
