import React, {useState, useEffect, useRef} from 'react';
import axios from 'axios';
import {Link} from "react-router-dom";
import Spinner from "../Includes/Spinner";
import SongList from "../Includes/SongList";
import swal from "@sweetalert/with-react";

export default function Playlists(props) {

    let titleInput = useRef(null);

    const [state, setState] = useState({
        playlists: [],
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get('/api/playlists')
            .then((response) => {
                setState({
                    playlists: response.data.playlists,
                    loader: false
                })
            })
            .catch((error) => {

            });
    }

    const createPlaylist = () => {
        swal({
            content: {
                element: "input",
                attributes: {
                    placeholder: "Titulli i listës",
                    type: "text",
                },
            },
            button: {
                text: "Krijo listën",
                closeModal: false
            },
        }).then(title => {
            if (!title) throw null;
            axios.post('/api/playlists', {
                title: title
            }).then((response) => {
                getData();
                swal("Sukses!", "Lista u krijua me sukses!", "success",{ buttons: false,timer: 1500});
            });
        })
    }

    return (
        <>
            <div className="container-fluid">
                <div className="d-flex align-items-center mb-4">
                    <h2 className="mb-0">Listat e mia</h2>
                    <button className="btn btn-primary btn-purple-color ml-auto my-shadow"
                            onClick={createPlaylist}>
                        Krijo listë
                    </button>
                </div>
                <div className="w-100 text-center">
                    <Spinner loading={state.loader}/>
                </div>
                <ul>
                    {state.playlists.map((playlist) => {
                        return (
                            <li>
                                <Link to={`/playlists/${playlist.playlist_id}`}>
                                    {playlist.title}
                                </Link>
                            </li>
                        )
                    })}
                </ul>
            </div>
            <div className="modal fade" style={{color: "black !important"}} id="exampleModal" tabIndex="-1"
                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="exampleModalLabel">Listë e re</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <input ref={titleInput} className="form-control" placeholder="Titulli i listës"/>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-dismiss="modal">Anulo</button>
                            <button type="button"
                                    onClick={createPlaylist}
                                    className="btn btn-purple-color">Krijo listën
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}
