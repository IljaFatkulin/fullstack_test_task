const defaultStore = {
    items: [],
    totalCount: 0,
    totalAmount: 0.00
}

export const cartReducer = (state = defaultStore, action) => {
    switch (action.type) {
        case "ADD_ITEM":
            const price1 = Math.round((parseFloat(action.payload.price.replace(',', '')) + Number.EPSILON) * 100) / 100;
            return {...state, items: [...state.items, action.payload], totalCount: state.totalCount + 1, totalAmount: state.totalAmount + price1}
        case "INCREASE_ITEM_COUNT":
            const price2 = state.items.find(item => item.id === action.payload).price;
            const formattedPrice2 = Math.round((parseFloat(price2.replace(',', '')) + Number.EPSILON) * 100) / 100;
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
                totalAmount: state.totalAmount + formattedPrice2
            }
        case "DECREASE_ITEM_COUNT":
            const price3 = state.items.find(item => item.id === action.payload).price;
            const formattedPrice3 = Math.round((parseFloat(price3.replace(',', '')) + Number.EPSILON) * 100) / 100;
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
                totalAmount: state.totalAmount - formattedPrice3
            }
        case "CHANGE_ITEM_ATTRIBUTE_VALUE":
            return {
                ...state,
                items: state.items.map(item => {
                    if (item.id === action.payload.productId) {
                        return {
                            ...item,
                            attributes: item.attributes.map(attribute => {
                                 if (attribute.id === action.payload.attributeId) {
                                     return {
                                         ...attribute,
                                         selectedValue: action.payload.item
                                     }
                                 }
                                 return attribute;
                            })
                        }
                    }
                    return item;
                })
            }
        default:
            return state;
    }
}