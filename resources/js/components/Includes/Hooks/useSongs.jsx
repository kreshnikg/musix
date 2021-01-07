import React, {useState, useEffect} from 'react';

export default function useSongs(props) {

    const [state, setState] = useState({
        loader: true,
        songs: []
    })

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

    return state
}
