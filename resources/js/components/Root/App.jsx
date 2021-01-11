import React, {useState, useEffect} from 'react';
import ReactDOM from "react-dom";
import {BrowserRouter, Switch, Route} from "react-router-dom";
import {Provider} from 'react-redux';
import {storeUser} from "../../helpers/store";
import MainLayout from "../Layout/Main/MainLayout";
import ScrollToTop from "../Utils/ScrollToTop";
import Home from "../Home/Home";
import Favourites from "../Favourites/Favourites";
import Artists from "../Artists/Artists";
import ArtistProfile from "../Artists/Profile";
import TopSongs from "../TopSongs/TopSongs";
import Browse from "../Browse/Browse";
import Playlists from "../Playlists/Playlists";

function App(props) {

    useEffect(() => {

    }, []);

    return (
        <BrowserRouter>
            <MainLayout>
                <ScrollToTop />
                <Switch>
                    <Route exact path='/' component={Home}/>
                    <Route exact path='/favourites' component={Favourites}/>
                    <Route exact path='/top-songs' component={TopSongs}/>
                    <Route exact path='/artists' component={Artists}/>
                    <Route exact path='/artists/:artistUrl' component={ArtistProfile}/>
                    <Route exact path='/browse' component={Browse}/>
                    <Route exact path='/playlists' component={Playlists}/>
                </Switch>
            </MainLayout>
        </BrowserRouter>
    )
}

if (document.getElementById('app')) {
    ReactDOM.render(<Provider store={storeUser}><App/></Provider>, document.getElementById('app'));
}
