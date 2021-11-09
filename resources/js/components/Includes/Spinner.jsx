import React from 'react';

const spinner = (props) => {

    return (
        props.loading ?
            <div className={`${props.position ? `loading-${props.position}` : 'loading-center'}`}>
                <div className={`spinner-border
                ${props.textColor ? `text-${props.textColor}` : ''}
                ${props.size ? `spinner-border-${props.size}` : ''}
                `} role="status">
                    <span className="sr-only">Loading...</span>
                </div>
            </div> : null
    )
};

export default spinner;
