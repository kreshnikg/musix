import * as actionTypes from "../actionTypes/user";

const initialState = {
    user: null,
    playingSong: null,
    playlists: []
}

const user = (state = initialState, action) => {
    switch (action.type) {
        case actionTypes.PLAY_NEW_SONG:
            return {
                ...state,
                playingSong: action.song
            }
        case actionTypes.SET_PLAYLISTS:
            return {
                ...state,
                playlists: action.playlists
            }
    }
    return state;
};

export default user;
