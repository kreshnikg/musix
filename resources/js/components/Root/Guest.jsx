import React, {useState, useEffect} from 'react';
import ReactDOM from "react-dom";
import GuestLayout from "../Layout/Guest/GuestLayout";
import ScrollToTop from "../Utils/ScrollToTop";
import {BrowserRouter, Route, Switch, Redirect} from "react-router-dom";
import Home from "../Guest/Home";
import Login from "../Auth/Login";
import Register from "../Auth/Register";
import Subscribe from "../Subscribe";
import NotFound from "../Guest/NotFound";

function Guest(props) {

    useEffect(() => {

    }, []);

    return (
        <BrowserRouter>
            <GuestLayout>
                <ScrollToTop />
                <Switch>
                    <Route exact path='/' component={Home}/>
                    {/*<Route exact path='/login' component={Login}/>*/}
                    {/*<Route exact path='/register' component={Register}/>*/}
                    {/*<Route exact path='/subscribe' component={Subscribe}/>*/}
                    <Route path="/not-found" component={NotFound} />
                    <Redirect to="/not-found" />
                </Switch>
            </GuestLayout>
        </BrowserRouter>
    )
}

if (document.getElementById('guest')) {
    ReactDOM.render(<Guest/>, document.getElementById('guest'));
}
