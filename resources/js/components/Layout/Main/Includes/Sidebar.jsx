import React, {useState, useEffect, useRef} from 'react';
import SidebarItem from "./SidebarItem";

export default function Sidebar(props) {

    let logoutForm = useRef(null);

    useEffect(() => {

    }, []);

    return (
        <div id="sidebar" className="sidebar border-0">
            <ul className="p-0">
                <li className="d-flex justify-content-center my-4">
                    {/*<h4>MUSIX</h4>*/}
                    <img alt="logo" src="/storage/img/logo.svg" className="my-1" width="100"/>
                </li>

                <SidebarItem title="Të fundit"
                             link="/"
                             icon="fas fa-music"/>

                <SidebarItem title="Shfleto"
                             link="/browse"
                             icon="fas fa-search"/>

                <SidebarItem title="Të preferuara"
                             link="/favourites"
                             icon="far fa-heart"/>

                {/*<SidebarItem title="Artistët"*/}
                {/*             link="/artists"*/}
                {/*             icon="far fa-user"/>*/}

                <SidebarItem title="Top lista"
                             link="/top-songs"
                             icon="fas fa-list-ol"/>

                <li className="sidebar-item position-absolute w-100 text-center" style={{bottom: "20px"}}>
                    <form method="POST" action="/logout" id="logout-form" ref={logoutForm}>
                        <input type="hidden" name="_token" value={getCSRFToken()}/>
                        <a className="sidebar-link" onClick={() => logoutForm.current.submit()}>
                            <i className="fas fa-sign-out-alt fa-fw"/>
                            <span className="ml-2">Çkyçu</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    )
}
