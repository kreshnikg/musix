import React, {Fragment} from 'react';
import {Link} from "react-router-dom";

const Home = (props) => {
    let urlLoggedIn = props.loggedIn ? "/subscribe" : "/register";

    return (
        <Fragment>
            <div className="container-fluid pt-5">
                <div className="container">
                    <div className="row">
                        <div className="col-md-5">
                            <img className="banner" src="/storage/img/banner.svg" alt="banner"/>
                        </div>
                        <div className="col-md-7 pt-5">
                            <h1>Dëgjo muzikë në çdo kohë</h1>
                            <h5>Për vetëm 4.99 € në muaj</h5>
                            <Link to={urlLoggedIn} className="btn my-btn-primary-color mt-3 btn-rounded">Abonohu tani</Link>
                        </div>
                    </div>
                </div>
            </div>
            <div className="container-fluid" style={{backgroundColor: "#f4f3f0"}}>
                <div className="container">
                    <div className="row">
                        <div className="col-md-4 my-5 d-flex flex-row align-items-center justify-content-center">
                            <i className="fas fa-music feature-icon"/>
                            <div className="d-flex flex-column ml-3">
                                <span className="font-weight-bold">KËNGË PA KUFI</span>
                                <span>Nga artistë nga e gjithë bota.</span>
                            </div>
                        </div>
                        <div className="col-md-4 my-5 d-flex flex-row align-items-center justify-content-center">
                            <i className="fas fa-list-ul feature-icon"/>
                            <div className="d-flex flex-column ml-3">
                                <span className="font-weight-bold">TOP LISTA</span>
                                <span>Me këngët më të dëgjuara.</span>
                            </div>
                        </div>
                        <div className="col-md-4 my-5 d-flex flex-row align-items-center justify-content-center">
                            <i className="fas fa-desktop feature-icon"/>
                            <div className="d-flex flex-column ml-3">
                                <span className="font-weight-bold">NË ÇDO PAJISJE</span>
                                <span>Dëgjo në kompjuter, tablet apo telefon.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="container my-5">
                <h2 className="mb-4 text-center">Publikimet e fundit</h2>
                <div className="row">
                    <div className="col-md-4">
                        <div className="d-flex justify-content-center">
                            <Link to={urlLoggedIn}>
                                <img className="featured-products" src="/storage/img/dua-lipa.jpg" alt="new-products"/>
                                <span className="text-center-image">Dua Lipa</span>
                            </Link>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="d-flex justify-content-center">
                            <Link to={urlLoggedIn}>
                                <img className="featured-products" src="/storage/img/rita-ora.webp" alt="best-seller"/>
                                <span className="text-center-image">Rita Ora</span>
                            </Link>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="d-flex justify-content-center">
                            <Link to={urlLoggedIn}>
                                <img className="featured-products" src="/storage/img/bebe-rexha.jpg" alt="zbritje"/>
                                <span className="text-center-image">Bebe Rexha</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </Fragment>
    )
};

export default Home;
