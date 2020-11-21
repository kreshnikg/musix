import React, {useState} from 'react';
import {Link} from "react-router-dom";
import axios from "axios";

const Register = (props) => {

    let name = React.createRef();
    let email = React.createRef();
    let password = React.createRef();

    const registerRequest = () => {
        axios.post('/api/register', {
            name: name.current.value,
            email: email.current.value,
            password: password.current.value
        }).then(response => {
            if (response.data === "success")
                window.location.href = "/";
        }).catch(error => {

        })
    };

    return (
        <div className="container">
            <div className="row">
                <div className="card overflow-hidden my-card-shadow mx-auto my-5 w-75">
                    <div className="card-body p-0">
                        <div className="row">
                            <div className="col-lg-6 d-none d-lg-block bg-login-image"/>
                            <div className="col-lg-6">
                                <div className="p-5">
                                    <div className="text-center">
                                        <h4 className="h4 mb-4">Mirë se erdhët!</h4>
                                    </div>
                                    <div className="row">
                                        <div className="col-6">
                                            <input ref={name} type="text" className="form-control mb-3 login-input"
                                                   placeholder="Emri" required/>
                                        </div>
                                    </div>
                                    <input ref={email} type="text" className="form-control mb-3 login-input"
                                           placeholder="Email"
                                           required/>
                                    <div className="row">
                                        <div className="col-6">
                                            <input ref={password} type="password"
                                                   className="form-control mb-3 login-input"
                                                   placeholder="Fjalkalimi" required/>
                                        </div>
                                        <div className="col-6">
                                            <input type="password" className="form-control mb-3 login-input"
                                                   placeholder="Konfirmo fjalkalimin" required/>
                                        </div>
                                    </div>
                                    <div className="form-group form-check">
                                        <input type="checkbox" id="check" className="form-check-input"/>
                                        <label className="form-check-label" htmlFor="check">* Termat dhe kushtet e
                                            përdorimit</label>
                                    </div>
                                    <button type="button" onClick={registerRequest}
                                            className="btn btn-block login-btn my-btn-primary-color">Regjistrohu
                                    </button>
                                    <hr/>
                                    <div className="text-center">
                                        <Link className="small" style={{textDecoration: "none", color: "#9c68aa"}}
                                              to="login">Keni llogari? Identifikohu këtu!</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
};

export default Register;
