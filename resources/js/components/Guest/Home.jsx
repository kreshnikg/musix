import React, {Fragment} from 'react';
import {Link} from "react-router-dom";

const Home = (props) => {
    return (
        <Fragment>
            <div className="container-fluid pt-5" style={{backgroundColor: "#f4f3f0"}}>
                <div className="container">
                    <div className="row">
                        <div className="col-md-5">
                            <img className="banner" src="/storage/img/banner.svg" alt="banner"/>
                        </div>
                        <div className="col-md-7 pt-5">
                            <h1>Degjo muzikë në çdo kohë</h1>
                            <a href="/register" className="btn my-btn-primary-color mt-3 btn-rounded">Abonohu tani</a>
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
                            <i className="fas fa-credit-card feature-icon"/>
                            <div className="d-flex flex-column ml-3">
                                <span className="font-weight-bold">PAGESA ONLINE</span>
                                <span>Pagesa 100% të sigurta.</span>
                            </div>
                        </div>
                        <div className="col-md-4 my-5 d-flex flex-row align-items-center justify-content-center">
                            <i className="fas fa-undo-alt feature-icon"/>
                            <div className="d-flex flex-column ml-3">
                                <span className="font-weight-bold">KTHIM BRENDA 30 DITËSH</span>
                                <span>Garancion për të gjitha produktet.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Fragment>
    )
};

export default Home;
