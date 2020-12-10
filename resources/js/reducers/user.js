import * as actionTypes from "../actionTypes/user";

const initialState = {
    user: null,
    playingSong: null,
    pausedAt: null
}

const user = (state = initialState, action) => {
    switch (action.type) {
        case actionTypes.PLAY_NEW_SONG:
            return {
                ...state,
                playingSong: action.song
            }
    }
    return state;
};

export default user;
