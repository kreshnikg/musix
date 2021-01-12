import React, {useState, useEffect} from 'react';
import ReactDOM from "react-dom";
import {BrowserRouter, Switch, Route} from "react-router-dom";
import {Provider, useDispatch} from 'react-redux';
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
import Show from "../Playlists/Show";
import {getPlaylists} from "../../actions/user";

function App(props) {

    const dispatch = useDispatch();

    useEffect(() => {
        dispatch(getPlaylists());
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
                    <Route exact path='/playlists/:playlistId' component={Show}/>
                </Switch>
            </MainLayout>
        </BrowserRouter>
    )
}

if (document.getElementById('app')) {
    ReactDOM.render(<Provider store={storeUser}><App/></Provider>, document.getElementById('app'));
}
