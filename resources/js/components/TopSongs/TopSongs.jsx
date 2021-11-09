import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import Spinner from "../Includes/Spinner";
import {useDispatch, useSelector} from "react-redux";
import {playNewSongRequest} from "../../actions/user"

export default function TopSongs(props) {

    const dispatch = useDispatch();
    const playingSong = useSelector(state => state.playingSong)

    const [state, setState] = useState({
        songs: [],
        loader: true
    });

    useEffect(() => {
        getData()
    }, []);

    const getData = () => {
        axios.get('/api/top-songs')
            .then((response) => {
                setState({
                    songs: response.data.songs,
                    loader: false
                })
            })
            .catch((error) => {

            });
    }

    const playSong = (song) => {
        dispatch(playNewSongRequest(song.song_id))
    }

    const toggleFavourite = (song) => {
        let data = {song_id: song.song_id}
        let apiUrl = '/api/favourites';
        axios.post(apiUrl, data).then((response) => {
            getData();
        })
    }

    const isPlaying = (songId) => {
        if (playingSong === null) return undefined
        return playingSong.song_id === songId ? "song-row-playing" : undefined;
    }

    return (
        <div className="container-fluid">
            <h2 className="mb-3">Këngët më të dëgjuara</h2>
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
                    <th scope="col">Nr. klikimeve</th>
                    <th scope="col"><i className="far fa-clock"/></th>
                </tr>
                </thead>
                <tbody>
                {state.songs.map((song, index) => {
                    return (
                        <tr key={song.song_id}
                            className={`song-row-href ${isPlaying(song.song_id)}`}>
                            <td onClick={() => playSong(song)}>
                                <i className="far fa-play-circle song-play-button"/>
                            </td>
                            <td onClick={() => toggleFavourite(song)}>
                                <i className={`${song.is_favourited ? "fas" : "far"} fa-heart song-favourite-button`}/>
                            </td>
                            <td>{song.title}</td>
                            <td>{song.artists ? song.artists[0].full_name : "-"}</td>
                            <td>{song.release_date}</td>
                            <td>{song.total_play_count}</td>
                            <td>{fmtMSS(song.duration)}</td>
                        </tr>
                    )
                })}
                </tbody>
            </table>
        </div>
    )
}
