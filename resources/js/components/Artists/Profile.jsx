import React, {useState, useEffect} from 'react';
import {useParams} from "react-router-dom";
import axios from "axios";

export default function Profile(props) {
    let {artistUrl} = useParams();
    const [state, setState] = useState({
        artist: null,
        loader: true
    })

    useEffect(() => {
        getData();
    }, []);

    const getData = () => {
        axios.get(`/api/artists/${artistUrl}`)
        .then((response) => {
            setState({
                artist: response.data.artist,
                loader: false
            })
        })
        .catch((error) => {

        });
    }

    return (
        <div>Profile</div>
    )
}
