import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";

export default function SidebarItem(props) {

    useEffect(() => {

    }, []);

    return (
        <li className={`sidebar-item ${props.active ? "active" : ""}`}>
            <Link className="sidebar-link" to={props.link}>
                <i className={`${props.icon} fa-fw`}/>
                <span className="ml-2">{props.title}</span>
            </Link>
        </li>
    )
}
