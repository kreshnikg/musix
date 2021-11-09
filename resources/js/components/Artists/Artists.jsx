import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import Spinner from "../Includes/Spinner"

export default function Artists(props) {

    const [state, setState] = useState({
        artists: [],
        loader: true
    });

    useEffect(() => {
        getData()
    }, []);

    const getData = () => {
        axios.get('/api/artists')
        .then((response) => {
            setState({
                artists: response.data.artists,
                loader: false
            })
        })
        .catch((error) => {

        });
    }

    return (
        <div className="container-fluid">
            <h2 className="mb-3 ml-3">Artistët</h2>
            <div className="w-100 text-center">
                <Spinner loading={state.loader}/>
            </div>
            <div className="row">
                {state.artists.map((artist) => {
                    return (
                        <div className="col-md-3 mb-3">
                            <div className="d-flex justify-content-center">
                                <Link to={"#"}>
                                    <img className="featured-products" src="/storage/img/dua-lipa.jpg" alt="new-products"/>
                                    <span className="text-center-image">{artist.full_name}</span>
                                </Link>
                            </div>
                        </div>
                    )
                })}
            </div>
        </div>
    )
}
