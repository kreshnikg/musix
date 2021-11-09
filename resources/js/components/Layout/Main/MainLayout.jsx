import React, {useState, useEffect} from 'react';
import Sidebar from "./Includes/Sidebar";
import Topbar from "./Includes/Topbar";
import Player from "../../Player/Player";

export default function MainLayout(props) {

    useEffect(() => {

    }, []);

    return (
        <>
            <Sidebar />
            <Topbar />
            <div className="content">
                {props.children}
            </div>
            <Player />
        </>
    )
}
