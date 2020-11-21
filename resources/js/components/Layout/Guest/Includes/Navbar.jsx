import React, {Fragment} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
// import Cookies from "js-cookie";
import NavItem from "./NavItem";

const Navbar = ({loggedIn}) => {

    // const userCookie = Cookies.get("user");
    const user = null;
    let username = "";

    const logout = () => {
        axios.get('/api/logout')
            .then((response) => {
                if (response.data === "success") {
                    window.location.href = "/";
                }
            })
    };

    return (
        <nav className="navbar navbar-expand-md navbar-light bg-white fixed-top">
            <div className="container">
                <Link className="navbar-brand" to="/"><img src="/src/img/logo.png" height="50" alt="MUSIX"/></Link>
                <button className="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"/>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav">
                        {/*<NavItem to="/">Ballina</NavItem>*/}
                        {/*<NavItem to="/kompjutere">Kompjuterë</NavItem>*/}
                        {/*<NavItem to="/laptope">Laptopë</NavItem>*/}
                        {/*<NavItem to="/televizore">Televizorë</NavItem>*/}
                        {/*<NavItem to="/celulare">Celularë</NavItem>*/}
                        {/*<NavItem to="/akesore">Aksesorë</NavItem>*/}
                    </ul>
                    <div className="d-flex align-items-center ml-auto">
                        {
                            loggedIn ?
                                <Fragment>
                                    <div className="dropdown show">
                                        <a className="btn btn-no-focus dropdown-toggle" href="#" role="button"
                                           id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            {username}
                                        </a>

                                        <div className="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <Link to="/profile" className="dropdown-item">Profili</Link>
                                            <Link to="/orders" className="dropdown-item">Porositë</Link>
                                            <Link to="/cart" className="dropdown-item">Shporta</Link>
                                            <div className="dropdown-divider"/>
                                            <a onClick={logout} className="dropdown-item" href="#">Çkyçu</a>
                                        </div>
                                    </div>
                                </Fragment>
                                :
                                <Fragment>
                                    <a className="nav-link mr-2" style={{color: "#707070"}} href="/login">Kyçu</a>
                                    <Link className="btn my-btn-primary-color" to="/register">Regjistrohu</Link>
                                </Fragment>
                        }
                    </div>
                </div>
            </div>
        </nav>
    )
};

export default Navbar;
