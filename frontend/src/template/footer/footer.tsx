import React from 'react';

const Footer: React.FC = () =>
    <footer className="main-footer">
        <strong>
            Copyright © 2019 <a href="/" onClick={e => e.preventDefault()}>Giovane Santos Silva</a>.
        </strong>
        <div className="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>;

export default Footer;