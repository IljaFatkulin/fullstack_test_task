export const addItemToCart = (item) => {
    return (dispatch) => {
        const updatedItem = { ...item, count: 1};
        dispatch({type: "ADD_ITEM", payload: updatedItem});
    };
};

export const increaseItemCount = (itemId) => {
    return (dispatch) => {
        dispatch({type: "INCREASE_ITEM_COUNT", payload: itemId});
    };
};

export const decreaseItemCount = (itemId) => {
    return (dispatch) => {
        dispatch({type: "DECREASE_ITEM_COUNT", payload: itemId});
    };
};

export const clearCart = () => {
    return (dispatch) => {
        dispatch({type: "CLEAR_CART"});
    };
};