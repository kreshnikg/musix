import React, {useState, useEffect} from 'react';
import {Howl, Howler} from 'howler';
import {useDispatch, useSelector} from "react-redux";
import {playNewSongRequest} from "../../actions/user"

export default function Player(props) {

    const dispatch = useDispatch();
    const playingSong = useSelector(state => state.playingSong)
    const pausedAt = useSelector(state => state.pausedAt)

    const [howlerState, setHowlerState] = useState(new Howl({
        src: ['https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3'],
        // autoplay: true,
        // loop: true,
        volume: 0.5
    }))

    const [state, setState] = useState({
        playing: false
    })

    useEffect(() => {
        howlerState.on('end', () => {
            // TODO play next song
        })
    }, []);

    const togglePause = () => {
        if(state.playing) howlerState.pause()
        else howlerState.play()
        setState({
            ...state,
            playing: !state.playing
        })
    }

    return (
        <div className="player align-content-center">
            <div className="control-buttons">
                <i className="fas fa-step-backward control-buttons-item"/>
                <i onClick={togglePause} className={`far fa-${state.playing ? "pause" : "play"}-circle control-buttons-item`}/>
                <i className="fas fa-step-forward control-buttons-item"/>
            </div>
        </div>
    )
}
