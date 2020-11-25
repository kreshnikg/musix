import React from 'react';
import {Link} from "react-router-dom";

const Footer = (props) => {
    return (
        <div className="container-fluid" style={{backgroundColor: "#f4f3f0"}}>
            <div className="container">
                <div className="row">
                    <div className="col-md-3 pt-4">
                        <img className="mb-2" src="/storage/img/full-logo.svg" height="100" alt="logo"/>
                    </div>
                    <div className="col-md-3 pt-4">
                        <h4>Kontakti</h4>
                        <div className="d-flex flex-column pt-2">
                            <a className="my-link" href="https://goo.gl/maps/kmsiaiFNfe2oeUsVA" target="_blank"
                               rel="noopener noreferrer"><i
                                className="fas fa-fw fa-map-marker-alt mr-1 my-2"/> Prizren, Kosovë</a>
                            <a className="my-link" href="tel:+38340000000"><i
                                className="fas fa-fw fa-phone mr-1 my-2"/> +38340000000</a>
                            <a className="my-link" href="mailto:musix@example.com"><i
                                className="fas fa-fw fa-envelope mr-1 my-2"/> musix@example.com</a>
                            <a className="my-link" href="skype:musix"><i
                                className="fab fa-fw fa-skype mr-1 my-2"/> musix</a>
                        </div>
                    </div>
                    <div className="col-md-3 pt-4">
                        <h4>Kompania</h4>
                        <div className="d-flex flex-column pt-2">
                            <Link className="my-link my-1" to="#">Rreth nesh</Link>
                            <Link className="my-link my-1" to="#">Politikat e privatësisë</Link>
                            {/*<Link className="my-link my-1" to="/televizore">Televizorë</Link>*/}
                            {/*<Link className="my-link my-1" to="/celulare">Celularë</Link>*/}
                            {/*<Link className="my-link my-1" to="/aksesore">Aksesorë</Link>*/}
                        </div>
                    </div>
                    {/*<div className="col-md-3 pt-4">*/}
                    {/*    <h3>Brendet</h3>*/}
                    {/*    <div className="d-flex flex-column pt-2">*/}
                    {/*        <a className="my-link my-1" href="#">Dell</a>*/}
                    {/*        <a className="my-link my-1" href="#">Logitech</a>*/}
                    {/*        <a className="my-link my-1" href="#">HyperX</a>*/}
                    {/*        <a className="my-link my-1" href="#">Msi</a>*/}
                    {/*        <a className="my-link my-1" href="#">Sony</a>*/}
                    {/*    </div>*/}
                    {/*</div>*/}
                </div>
                <div className="py-3">
                    <hr/>
                    <div className="d-flex align-items-center">
                        <span className="">Copyright © 2020 Musix. Të gjitha të drejtat e rezervuara.</span>
                        <div className="ml-auto">
                            <a href="#" className="my-link"><i className="fab fa-instagram mx-2"/></a>
                            <a href="#" className="my-link"><i className="fab fa-facebook mx-2"/></a>
                            <a href="#" className="my-link"><i className="fab fa-twitter mx-2"/></a>
                            <a href="#" className="my-link"><i className="fab fa-linkedin mx-2"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
};

export default Footer;
