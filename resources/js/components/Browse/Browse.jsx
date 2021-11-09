import React, {useState, useEffect, useRef} from 'react';
import axios from "axios";
import Spinner from "../Includes/Spinner";
import SongList from "../Includes/SongList";

export default function Browse(props) {

    let searchInput = useRef(null);

    const [state, setState] = useState({
        songs: [],
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        let searchValue = searchInput.current ? searchInput.current.value : null;
        setState({
            ...state,
            loader: true
        })
        axios.get('/api/songs/search', {
            params: {
                search: searchValue
            }
        })
            .then((response) => {
                setState({
                    songs: response.data.songs,
                    loader: false
                })
            })
            .catch((error) => {
                setState({
                    ...state,
                    loader: false
                })
            });
    }

    return (
        <div className="container-fluid">
            <div className="input-group mb-3" style={{width: "500px"}}>
                <input ref={searchInput} onKeyUp={(e) => e.key === "Enter" ? getData() : undefined} type="text" className="form-control search-input" placeholder="Kërko..."/>
                <div className="input-group-btn" style={{marginLeft: "-45px"}}>
                    <button onClick={getData} className="btn" style={{color: "white"}} type="submit">
                        <i className="fas fa-search"/>
                    </button>
                </div>
            </div>
            <div className="w-100 text-center">
                <Spinner loading={state.loader}/>
            </div>
            <SongList songs={state.songs} getData={getData}/>
        </div>
    )
}
