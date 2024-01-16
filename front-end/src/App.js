import Header from "./components/Header/Header";
import {useSelector} from "react-redux";
import Loader from "./components/Loader/Loader";
import {BrowserRouter} from "react-router-dom";
import AppRouter from "./components/AppRouter";

function App() {
    const isLoading = useSelector(state => state.loader.isLoading);

    return (
        <BrowserRouter>
            <div className="App">
                <Loader isLoading={isLoading}/>
                <Header/>

                <div className="Container">
                        <AppRouter/>
                </div>
            </div>
        </BrowserRouter>
    );
}

export default App;
