import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import Spinner from "../Includes/Spinner";

export default function Home(props) {

    const [state, setState] = useState({
        songs: [],
        loader: true
    });

    useEffect(() => {
        getData()
    }, []);

    const getData = () => {
        axios.get('/api/home')
        .then((response) => {
            setState({
                songs: response.data.songs,
                loader: false
            })
        })
        .catch((error) => {

        });
    }

    const goToSong = (href) => {
        props.history.push(`song`)
    }

    const toggleFavourite = (song) => {
        let data = {song_id: song.song_id}
        let apiUrl = '/api/favourites';
        apiUrl += song.is_favourited ? "/remove" : ""
        axios.post(apiUrl, data).then((response) => {
            getData();
        })
    }

    return (
        <div className="container-fluid">
            <h2 className="mb-3">Këngët e fundit</h2>
            <div className="w-100 text-center">
                <Spinner loading={state.loader}/>
            </div>
            <table className="table table-dark song-list-table">
                <thead>
                <tr>
                    <th scope="col" width="30px"/>
                    <th scope="col" width="30px"/>
                    <th scope="col">Titulli</th>
                    <th scope="col">Artistët</th>
                    <th scope="col">Data e publikimit</th>
                    <th scope="col"><i className="far fa-clock"/></th>
                </tr>
                </thead>
                <tbody>
                {state.songs.map((song, index) => {
                    return (
                        <tr key={song.song_id} className="song-row-href">
                            <td>
                                <i className="far fa-play-circle song-play-button"/>
                            </td>
                            <td onClick={() => toggleFavourite(song)}>
                                <i className={`${song.is_favourited ? "fas" : "far"} fa-heart song-favourite-button`}/>
                            </td>
                            <td>{song.title}</td>
                            <td>{song.artists ? song.artists[0].full_name : "-"}</td>
                            <td>{song.release_date}</td>
                            <td>{fmtMSS(song.duration)}</td>
                        </tr>
                    )
                })}
                </tbody>
            </table>
        </div>
    )
}
