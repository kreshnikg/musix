import React, {useState, useEffect} from 'react';
import {Link, useParams} from "react-router-dom";
import axios from 'axios';
import Spinner from "../Includes/Spinner";
import SongList from "../Includes/SongList";

export default function Show(props) {

    const {playlistId} = useParams();

    const [state, setState] = useState({
        playlist: null,
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get('/api/playlists/' + playlistId)
        .then((response) => {
            setState({
                playlist: response.data.playlist,
                loader: false
            })
        })
        .catch((error) => {

        });
    }

    const {playlist, loader} = state;

    return (
        <div className="container-fluid">
            <h2 className="mb-3">#{playlist ? playlist.title : ""}</h2>
            <div className="w-100 text-center">
                <Spinner loading={loader}/>
            </div>
            <SongList songs={playlist ? playlist.songs : []} getData={getData}/>
        </div>
    )
}
