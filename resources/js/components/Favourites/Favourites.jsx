import React, {useState, useEffect} from 'react';
import Spinner from "../Includes/Spinner";
import SongList from "../Includes/SongList";

export default function Favourites(props) {

    const [state, setState] = useState({
        songs: [],
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get('/api/favourites')
        .then((response) => {
            setState({
                songs: response.data.songs,
                loader: false
            })
        })
        .catch((error) => {

        });
    }

    return (
        <div className="container-fluid">
            <h2 className="mb-3">Këngët e preferuara</h2>
            <div className="w-100 text-center">
                <Spinner loading={state.loader}/>
            </div>
            <SongList songs={state.songs} getData={getData} favourites/>
        </div>
    )
}
