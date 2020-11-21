import React, {useState, useEffect} from 'react';
import ReactDOM from "react-dom";
import {BrowserRouter, Switch, Route} from "react-router-dom";
import MainLayout from "../Layout/Main/MainLayout";
import ScrollToTop from "../Utils/ScrollToTop";
import Home from "../Home/Home";

function App(props) {

    useEffect(() => {

    }, []);

    return (
        <BrowserRouter>
            <MainLayout>
                <ScrollToTop />
                <Switch>
                    <Route exact path='/' component={Home}/>
                </Switch>
            </MainLayout>
        </BrowserRouter>
    )
}

if (document.getElementById('app')) {
    ReactDOM.render(<App/>, document.getElementById('app'));
}
