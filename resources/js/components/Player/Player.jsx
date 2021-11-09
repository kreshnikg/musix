import React, {useState, useEffect} from 'react';
import {Howl, Howler} from 'howler';
import {useDispatch, useSelector} from "react-redux";
import {playNewSongRequest, playNextSongRequest, playPreviousSongRequest} from "../../actions/user"

export default function Player(props) {

    const dispatch = useDispatch();
    const [currentTime, setCurrentTime] = useState(0);
    const [duration, setDuration] = useState(0);

    const [state, setState] = useState({
        playing: false
    })

    const [howlerState, setHowlerState] = useState(null)
    const playingSong = useSelector(state => state.playingSong)

    useEffect(() => {
        if (playingSong) {
            if (!_.isEmpty(howlerState)) {
                howlerState.stop();
            }
            setHowlerState(new Howl({
                src: [`http://musix.test/storage/${playingSong.audio_file}`],
                // autoplay: true,
                // loop: true,
                volume: 0.5
            }));
            setDuration(playingSong.duration)
            setCurrentTime(0)
        }
    }, [playingSong])

    useEffect(() => {
        if (!_.isEmpty(howlerState)) {
            togglePause()
            howlerState.on('end', () => {
                // TODO play next song
            })

            let interval = setInterval(() => {
                setCurrentTime(howlerState.seek())
                console.log("interval")
            }, 1000)

            return () => {
                clearInterval(interval)
            }
        }
    }, [howlerState]);

    const togglePause = () => {
        if (_.isEmpty(howlerState)) return
        if (state.playing) howlerState.pause()
        else howlerState.play()
        setState({
            ...state,
            playing: !state.playing
        })
    }

    const getProgress = () => {
        return Math.floor((currentTime * 100) / duration)
    }

    const playNextSong = () => {
        if(playingSong)
            dispatch(playNextSongRequest(playingSong.song_id))
    }

    const playPreviousSong = () => {
        if(playingSong)
            dispatch(playPreviousSongRequest(playingSong.song_id))
    }

    return (
        <>
            <div className="player-container">
                {playingSong &&
                <div className="player-song-details ml-3">
                    <i className="fas fa-music mr-3" />
                    <div>
                        <p className="font-weight-bold mb-0">{playingSong.title}</p>
                        <span className="text-white-50">{playingSong.artists[0].full_name}</span>
                    </div>
                </div> }
                <div className="player align-items-center">
                    <div className="control-buttons">
                        <i className="fas fa-step-backward control-buttons-item"
                           onClick={playPreviousSong} style={{fontSize: "15px"}}/>
                        <i onClick={togglePause}
                           style={{fontSize: "30px"}}
                           className={`far fa-${state.playing ? "pause" : "play"}-circle control-buttons-item`}/>
                        <i className="fas fa-step-forward control-buttons-item"
                           onClick={playNextSong} style={{fontSize: "15px"}}/>
                    </div>
                    <div className="d-flex align-items-center justify-content-center mt-3">
                        <span className="mr-3">{fmtMSS(currentTime)}</span>
                        <div className="progress" style={{height: "5px", width: "300px"}}>
                            <div className="progress-bar" role="progressbar" style={{width: `${getProgress()}%`}}
                                 aria-valuenow="25"
                                 aria-valuemin="-1" aria-valuemax="100"/>
                        </div>
                        <span className="ml-3">{fmtMSS(duration)}</span>
                    </div>
                </div>
            </div>
        </>
    )
}
