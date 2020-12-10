import {createStore, applyMiddleware, compose} from 'redux';
import thunk from "redux-thunk";
import userReducer from "../reducers/user";


// Development
const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;
export const storeUser = createStore(userReducer, composeEnhancers(
    applyMiddleware(thunk)
));


// Production
// export const store = createStore(userReducer, applyMiddleware(thunk));

