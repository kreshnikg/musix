import axios from "axios";
import * as actionTypes from "../actionTypes/user";

export const playNewSongRequest = (songId) => {
    return dispatch => {
        axios.get().then((response) => {
            dispatch(playSong(response.data.song))
        }).catch((error) => {

        })
    }
}

const playNewSong = (song) => {
    return {
        type: actionTypes.PLAY_NEW_SONG,
        song: song
    }
}

export const playSong = () => {
    return {
        type: actionTypes.PLAY_SONG
    }
}

export const pauseSong = () => {
    return {
        type: actionTypes.PAUSE_SONG
    }
}
