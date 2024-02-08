import Header from "./components/Header/Header";
import {useSelector} from "react-redux";
import Loader from "./components/Loader/Loader";
import {BrowserRouter} from "react-router-dom";
import AppRouter from "./components/AppRouter";
import Cart from "./components/Cart/Cart";
import {useState} from "react";

function App() {
    const isLoading = useSelector(state => state.loader.isLoading);
    const [isCartVisible, setIsCartVisible] = useState(false);

    const handleCartClick = () => {
        setIsCartVisible(!isCartVisible);
    };

    return (
        <BrowserRouter>
            <div className="App">
                <Loader isLoading={isLoading}/>
                <Header handleCartClick={handleCartClick}/>

                <div className="Container">
                    {isCartVisible &&
                        <Cart
                            setIsCartVisible={setIsCartVisible}
                        />
                    }
                    <div className="Content">
                        <AppRouter/>
                    </div>
                </div>
            </div>
        </BrowserRouter>
    );
}

export default App;
