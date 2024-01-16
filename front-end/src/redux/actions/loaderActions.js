
export const setLoading = (status) => {
    return (dispatch) => {
        dispatch({type: "SET_LOADING", payload: status});
    }
};