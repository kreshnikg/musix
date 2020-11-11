import React, {useState, useEffect} from 'react';
import Sidebar from "./Includes/Sidebar";
import Topbar from "./Includes/Topbar";

export default function Main(props) {

    useEffect(() => {

    }, []);

    return (
        <>
            <Sidebar />
            <Topbar />
            <div className="content">
                {props.children}
            </div>
        </>
    )
}
