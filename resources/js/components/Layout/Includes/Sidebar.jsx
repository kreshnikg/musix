import React, {useState, useEffect} from 'react';
import SidebarItem from "./SidebarItem";

export default function Sidebar(props) {

    useEffect(() => {

    }, []);

    return (
        <div id="sidebar" className="sidebar border-0">
            <ul className="p-0">
                <li className="d-flex justify-content-center my-4">
                    <h4>MUSIX</h4>
                    {/*<img alt="logo" src="/storage/img/ciaoberto-logo-black.svg" className="my-2" width="150"/>*/}
                </li>

                <SidebarItem title="Këngët"
                             link="/"
                             active
                             icon="fas fa-music"/>

                <SidebarItem title="Shfleto"
                             link="/browse"
                             icon="fas fa-search"/>

                <SidebarItem title="Këngët e preferuara"
                             link="/favourites"
                             icon="far fa-heart"/>

                <SidebarItem title="Artistët"
                             link="/artists"
                             icon="far fa-user"/>
            </ul>
        </div>
    )
}
