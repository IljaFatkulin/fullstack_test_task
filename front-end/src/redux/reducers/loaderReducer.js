const defaultStore = {
    isLoading: false,
};

export const loaderReducer = (state = defaultStore, action) => {
    switch (action.type) {
        case "SET_LOADING":
            return {...state, isLoading: action.payload}
        default:
            return state;
    }
}