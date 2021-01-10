import axios from "axios";
import * as actionTypes from "../actionTypes/user";

export const playNewSongRequest = (songId) => {
    return dispatch => {
        axios.get(`/api/song/${songId}`).then((response) => {
            dispatch(playNewSong(response.data.song))
        }).catch((error) => {

        })
    }
}

export const playNextSongRequest = (songId) => {
    return dispatch => {
        axios.get(`/api/song/${songId}/next`).then((response) => {
            if(response.data.song)
                dispatch(playNewSong(response.data.song))
        }).catch((error) => {

        })
    }
}

export const playPreviousSongRequest = (songId) => {
    return dispatch => {
        axios.get(`/api/song/${songId}/previous`).then((response) => {
            if(response.data.song)
                dispatch(playNewSong(response.data.song))
        }).catch((error) => {

        })
    }
}

export const playNewSong = (song) => {
    return {
        type: actionTypes.PLAY_NEW_SONG,
        song: song
    }
}

