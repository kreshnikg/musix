import React, {Fragment} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";
import NavItem from "./NavItem";

const Navbar = ({loggedIn}) => {

    const logout = () => {
        axios.post('/logout')
            .then((response) => {
                window.location.href = "/";
            })
    };

    return (
        <nav className="navbar navbar-expand-md navbar-light bg-white fixed-top">
            <div className="container">
                <Link className="navbar-brand" to="/"><img src="/storage/img/logo.svg" height="35" alt="MUSIX"/></Link>
                <button className="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"/>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav">
                        <NavItem to="/">Ballina</NavItem>
                        <NavItem to="/">Rreth nesh</NavItem>
                    </ul>
                    <div className="d-flex align-items-center ml-auto">
                        {
                            loggedIn ?
                                <Fragment>
                                    <div className="dropdown show">
                                        <a className="btn btn-no-focus dropdown-toggle" href="#" role="button"
                                           id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            Emri Mbiemri
                                        </a>

                                        <div className="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            {/*<Link to="/cart" className="dropdown-item">Shporta</Link>*/}
                                            {/*<div className="dropdown-divider"/>*/}
                                            <a onClick={logout} className="dropdown-item" href="#">Çkyçu</a>
                                        </div>
                                    </div>
                                </Fragment>
                                :
                                <Fragment>
                                    <Link className="nav-link mr-2" style={{color: "#707070"}} to="/login">Kyçu</Link>
                                    <Link className="btn my-btn-primary-color btn-rounded" to="/register">Regjistrohu</Link>
                                </Fragment>
                        }
                    </div>
                </div>
            </div>
        </nav>
    )
};

export default Navbar;
