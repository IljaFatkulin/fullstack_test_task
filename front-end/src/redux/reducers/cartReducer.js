const defaultStore = {
    items: [],
    totalCount: 0,
    totalAmount: 0.00
}

export const cartReducer = (state = defaultStore, action) => {
    switch (action.type) {
        case "ADD_ITEM":
            const priceToAdd = parseFloat(action.payload.price.replace(',', ''));
            return {
                ...state,
                items: [...state.items, action.payload],
                totalCount: state.totalCount + 1,
                totalAmount: formatTotalAmount(state.totalAmount + priceToAdd)
            }
        case "INCREASE_ITEM_COUNT":
            const priceToIncrease = parseFloat(state.items.find(item => item.id === action.payload).price.replace(',', ''));
            return {
                ...state,
                items: state.items.map(item => {
                    if (item.id === action.payload) {
                        return {
                            ...item,
                            count: item.count + 1
                        };
                    }
                    return item;
                }),
                totalCount: state.totalCount + 1,
                totalAmount: formatTotalAmount(state.totalAmount + priceToIncrease)
            }
        case "DECREASE_ITEM_COUNT":
            const priceToDecrease = parseFloat(state.items.find(item => item.id === action.payload).price.replace(',', ''));
            return {
                ...state,
                items: state.items.map(item => {
                    if (item.id === action.payload) {
                        return {
                            ...item,
                            count: item.count - 1
                        };
                    }
                    return item;
                })
                .filter(item => item.count > 0),
                totalCount: state.totalCount - 1,
                totalAmount: formatTotalAmount(state.totalAmount - priceToDecrease)
            }
        case "CLEAR_CART":
            return {
                ...state,
                items: [],
                totalCount: 0,
                totalAmount: 0.00
            }
        default:
            return state;
    }
};

const formatTotalAmount = (value) => {
    return Math.round((value + Number.EPSILON) * 100) / 100;
};