import React, {useState, useEffect} from 'react';
import {playNewSongRequest} from "../../actions/user";
import {useDispatch, useSelector} from "react-redux";
import axios from "axios";

export default function SongList(props) {

    const dispatch = useDispatch();
    const playingSong = useSelector(state => state.playingSong)

    const isPlaying = (songId) => {
        if (playingSong === null) return undefined
        return playingSong.song_id === songId ? "song-row-playing" : undefined;
    }

    const toggleFavourite = (song) => {
        let data = {song_id: song.song_id}
        let apiUrl = '/api/favourites';
        axios.post(apiUrl, data).then((response) => {
            props.getData();
        })
    }

    const playSong = (song) => {
        dispatch(playNewSongRequest(song.song_id))
    }

    return (
        <table className="table table-dark song-list-table">
            <thead>
            <tr>
                <th scope="col" width="30px"/>
                <th scope="col" width="30px"/>
                <th scope="col">Titulli</th>
                <th scope="col">Artistët</th>
                <th scope="col">Data e publikimit</th>
                <th scope="col"><i className="far fa-clock"/></th>
                <th scope="col"/>
            </tr>
            </thead>
            <tbody>
            {props.songs.map((song, index) => {
                return (
                    <tr key={song.song_id}
                        className={`song-row-href ${isPlaying(song.song_id)}`}>
                        <td onClick={() => playSong(song)}>
                            <i className="far fa-play-circle song-play-button"/>
                        </td>
                        <td onClick={() => toggleFavourite(song)}>
                            <i className={`${song.is_favourited || props.favourites ? "fas" : "far"} fa-heart song-favourite-button`}/>
                        </td>
                        <td>{song.title}</td>
                        <td>{song.artists ? song.artists[0].full_name : "-"}</td>
                        <td>{song.release_date}</td>
                        <td>{fmtMSS(song.duration)}</td>
                        <td>
                            <div className="dropdown show">
                                <a className="btn btn-sm btn-link p-0" href="#" role="button"
                                   style={{fontSize: "16px", color: "white"}}
                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <i className="fas fa-ellipsis-h"/>
                                </a>

                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a className="dropdown-item" href="#">Action</a>
                                    <a className="dropdown-item" href="#">Another action</a>
                                    <a className="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                );
            })}
            </tbody>
        </table>
    )
}
