import React, {useState, useEffect} from 'react';
import {Link, useLocation} from "react-router-dom";

export default function SidebarItem(props) {
    const location = useLocation();
    const [active, setActive] = useState(false);

    useEffect(() => {
        if(location.pathname == props.link)
            setActive(true)
        else{
            if(active)
                setActive(false);
        }
    }, [location]);

    return (
        <li className={`sidebar-item ${active ? "active" : ""}`}>
            <Link className="sidebar-link" to={props.link}>
                <i className={`${props.icon} fa-fw`}/>
                <span className="ml-2">{props.title}</span>
            </Link>
        </li>
    )
}
