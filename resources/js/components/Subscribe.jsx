import React, {useState, useEffect, useRef} from 'react';
import axios from 'axios';
import moment from "moment";

export default function Subscribe(props) {

    let cardNumber = useRef(null);
    let cardSecurityCode = useRef(null);

    const [state, setState] = useState({
        months: [],
        selectedMonth: "",
        years: [],
        selectedYear: ""
    })

    const subscribeHandler = () => {
        let data = new FormData();
        data.append("card_number", cardNumber.current.value);
        data.append("card_expiry_month", state.selectedMonth);
        data.append("card_expiry_year", state.selectedYear);
        data.append("card_security_code", cardSecurityCode.current.value);
        axios.post('/api/subscribe', data).then((response) => {
            window.location.href = '/'
        }).catch((error) => {

        })
    }

    const changeMonth = (e) => {
        setState({
            ...state,
            selectedMonth: e.target.value
        })
    }
    const changeYear = (e) => {
        setState({
            ...state,
            selectedYear: e.target.value
        })
    }

    return (
        <div className="container">
            <div className="row">
                <div className="card border-0 shadow-sm w-25 my-5 mx-auto">
                    <div className="card-body">
                        <div className="form-group">
                            <label htmlFor="card_number">Numri i kartelës</label>
                            <input className="form-control"
                                   ref={cardNumber}
                                   type="text"
                                   id="card_number"
                                   placeholder="1111 2222 3333 4444"/>
                        </div>
                        <div className="form-group">
                            <label htmlFor="card_expiry_date">Data e skadimit</label>
                            <div className="row">
                                <div className="col-md-6">
                                    <select className="form-control" onChange={changeMonth} value={state.selectedMonth}>
                                        <option disabled value="">Muaji</option>
                                        {_.range(1, 13).map((month) => {
                                            return <option key={month} value={month}>{month}</option>
                                        } )}
                                    </select>
                                </div>
                                <div className="col-md-6">
                                    <select className="form-control" onChange={changeYear} value={state.selectedYear}>
                                        <option disabled value="">Viti</option>
                                        {_.range(moment().year(), moment().year() + 30).map((year) => {
                                            return <option key={year} value={year}>{year}</option>
                                        })}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label htmlFor="card_security_code">Kodi i sigurisë</label>
                            <div className="row">
                                <div className="col-md-6">
                                    <input className="form-control"
                                           ref={cardSecurityCode}
                                           type="text"
                                           id="card_security_code"/>
                                </div>
                            </div>
                        </div>
                        <button className="btn btn-success w-100 mx-10" onClick={subscribeHandler}>Abonohu</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

// if (document.getElementById('subscribe')) {
//     ReactDOM.render(<Subscribe/>, document.getElementById('subscribe'));
// }

